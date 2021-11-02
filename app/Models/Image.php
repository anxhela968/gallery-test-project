<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'image_id');
    }
}
