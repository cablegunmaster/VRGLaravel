<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['incident_id', 'team_id', 'task_type_id','title', 'description', 'data',
        'dest_lat','dest_lon','dest_text','created_at','updated_at'];

}
