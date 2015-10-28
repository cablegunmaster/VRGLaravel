<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Measurement;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Input;
use DateTime;

class ApiController extends Controller
{


    public function show_all(){
        $measurement = Measurement::all();
        return view('api.showAllImages')->with('measurements', $measurement);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function observation_upload(Response $request)
    {
        if (Input::has('observation')) //check to see if its a image.
        {
            $file = NULL;
            $result = array('success' => 'true');
            if(Input::has('image')) {
                $path = 'upload/';
                if(!file_exists($path)) {
                    mkdir($path);
                }
                $file = $path.time().'.jpg';
                $ifp = fopen($file, "wb");
                fwrite($ifp, base64_decode(Input::get('image')));
                fclose($ifp);
            }

            // TODO: location_id, created_at, updated_at
            $measurement = new Measurement();
            $measurement->message = Input::get('observation');
            $measurement->file = $file;
            $measurement->save();
            $result['id'] = $measurement->id;
            return json_encode($result);
        }else{
            return \Response::make('Bad request happened', 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function CreateUpload_image()
    {
        return View('api.uploadFile');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $picture = Measurement::findOrFail($id);
        }catch(ModelNotFoundException $e){
            dd("No pictures found");
        }


        if($picture->image == null){
            return response()->json(array(
                'error' => true,
                'msg' => 'No images found'
            ), 400);
        }
        return View('api.showImage')->with('image', $picture->image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
