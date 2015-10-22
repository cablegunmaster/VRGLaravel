<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','created_at','updated_at'];
}
