<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poi_Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'poi_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','properties'];

}
