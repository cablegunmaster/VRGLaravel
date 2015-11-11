<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'incident';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'information', 'lat','lon', 'weather', 'end_date','created_at','updated_at'];
}
