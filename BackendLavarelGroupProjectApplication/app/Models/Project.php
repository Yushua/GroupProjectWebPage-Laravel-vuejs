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
        'public',
    ];

    protected $casts = [
        'users' => 'array',
        'public' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(JWTUserProfile::class, 'project_id', 'projectId');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'projectid', 'projectId');
    }
}
