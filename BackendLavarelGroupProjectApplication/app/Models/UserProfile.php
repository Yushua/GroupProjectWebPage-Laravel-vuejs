<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'user_profiles';

    // Allow mass assignment on the following fields
    protected $fillable = [
        'username',       // The username
        'userId',         // The unique userId
        'password',       // The hashed password
        'LoginCode',      // The login code (nullable)
        'user_list',      // The user list (nullable)
    ];

    // Cast the 'user_list' field to an array
    protected $casts = [
        'user_list' => 'array', // Ensure the user_list is treated as an array
    ];

    // Optional: You can define hidden attributes to not expose them in JSON responses
    protected $hidden = [
        'password',    // Don't expose the password in the response
        'LoginCode',   // Don't expose the LoginCode in the response
    ];
}
