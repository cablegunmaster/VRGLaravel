<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Status extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_id', 'user_id', 'receive_date','created_at','updated_at'];

}
