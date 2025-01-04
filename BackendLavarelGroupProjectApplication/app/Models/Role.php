<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'RoleName',
        'roleId',
        'projectid',
        'description',
        'userID'];

    public function user()
    {
        return $this->belongsTo(JWTUserProfile::class, 'userId', 'userId');
    }
}
