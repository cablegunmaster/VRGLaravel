<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'weather';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','created_at','updated_at'];
}
