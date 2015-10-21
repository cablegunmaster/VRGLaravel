<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident_User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'incident_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['incident_id', 'user_id','created_at','updated_at'];

}
