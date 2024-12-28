<?php

// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectId',
        'name',
        'status',
        'invite_code',
        'users',
    ];

    // Relations
    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}

