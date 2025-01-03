<?php

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
        'description',  // Add description here to allow mass assignment
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

    // Relationship to the owner
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');  // Assuming `owner_id` is the field that holds the owner reference
    }
}
