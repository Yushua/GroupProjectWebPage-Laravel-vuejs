<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'TaskID',
        'ProjectID',
        'RoleID',
        'UserID',
        'TaskName',
        'TaskDescription',
        'TaskDate',
    ];

    public $incrementing = false; // Because TaskID is a string (e.g., uniqid)
}
