<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'projectId',
        'name',
        'invite_code',
        'status',
        'users',
        'description',
        'owner_id',
        'public', // Add this to the fillable attributes
    ];

    protected $casts = [
        'users' => 'array',
        'public' => 'boolean', // Ensure this is treated as a boolean
    ];
}
