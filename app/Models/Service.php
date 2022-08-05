<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description', 'user_id'];

    public function users()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function getImageUrlAttribute($value)
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return asset('images/default-image.jpg');
    }
}
