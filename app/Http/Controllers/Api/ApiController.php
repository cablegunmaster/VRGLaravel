<?php

namespace App\Http\Controllers\Api;

use App\Api\Pictures;
use App\Http\Controllers\Controller;
use App\Measurement;
use Illuminate\Support\Facades\App;
use Zend\Diactoros\Request;
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
    public function store(Response $request)
    {
        if (Input::hasFile('image') && Input::has('observation') &&
            (Input::file('image')->getClientOriginalExtension() == 'jpg' || Input::file('file')->getClientOriginalExtension() == 'png')) //check to see if its a image.
        {

            if(Input::hasFile('image')){

                $file = Input::file('image');

                //rename the picture to unix timestamp.
                $imageName =  time() . '.' .
                    Input::file('file')->getClientOriginalExtension(); //front name and last name.

                Input::file('image')->move(
                    base_path() . '/public/upload/', $imageName
                ); //replace the picture to new spot
            }

            //create db Picture.
            $mmeasurement = new Measurement();
            //$pic->filename = $imageName;
            $mmeasurement->save(); //actually create the picture object.

            return "Succesfull file uploaded";
            //return View('api.showImage')->with('image', $imageName); //show the image.
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
