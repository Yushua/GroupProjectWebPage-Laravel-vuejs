<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JWTUserProfile extends Authenticatable
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
}
