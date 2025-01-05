<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'taskId',
        'projectId',
        'roleId',
        'userId',
        'TaskName',
        'TaskDescription',
        'TaskDate',
    ];

    public $timestamps = false;
}
