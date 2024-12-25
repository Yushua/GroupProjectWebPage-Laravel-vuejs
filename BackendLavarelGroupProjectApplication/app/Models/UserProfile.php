<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles'; // Specify the table name

    protected $fillable = [
        'name',
        'password',
        'LoginCode',
        'user_list',
    ];

    // Cast the 'user_list' field to an array
    protected $casts = [
        'user_list' => 'array',
    ];
}
