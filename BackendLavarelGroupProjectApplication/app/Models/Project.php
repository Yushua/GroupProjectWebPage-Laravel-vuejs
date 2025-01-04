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
        return $this->hasMany(JWTUserProfile::class);
    }

    public function roles()
    {
        return $this->hasMany(JWTUserProfile::class);
    }
}
