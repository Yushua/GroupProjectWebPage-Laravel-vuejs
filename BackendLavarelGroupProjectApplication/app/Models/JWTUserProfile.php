<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JWTUserProfile extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'username',
        'userId',
        'password',
        'LoginCode',
        'user_list',
        'project_id',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'LoginCode',
    ];

    protected $casts = [
        'user_list' => 'array',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['userId' => $this->userId];
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'projectId');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'roleId');
    }
}
