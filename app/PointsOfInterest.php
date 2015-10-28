<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointsOfInterest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pointsOfInterest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['incident_id', 'task_id','lat','lon','poi_type','created_at','updated_at'];

}
