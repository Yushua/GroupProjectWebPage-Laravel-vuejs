<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionProfile extends Model
{
    use HasFactory;

    protected $table = 'description_profiles';

    protected $fillable = [
        'descriptionId',
        'userId',
        'description',
        'roled',
    ];

    protected $casts = [
        'roled' => 'string',
    ];
}
