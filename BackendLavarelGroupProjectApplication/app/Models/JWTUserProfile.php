<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class JWTUserProfile extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'user_profiles'; // Specify the table name

    protected $fillable = [
        'username',
        'userId',
        'password',
        'LoginCode',
        'user_list',
    ];

    protected $hidden = [
        'password',    // Hide password in responses
        'LoginCode',   // Hide LoginCode in responses
    ];

    protected $casts = [
        'user_list' => 'array',
    ];

    // JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['userId' => $this->userId];
    }

    public function descriptionProfile()
    {
        return $this->hasOne(DescriptionProfile::class, 'userId', 'id');
    }
}
