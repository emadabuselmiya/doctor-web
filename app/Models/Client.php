<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'description', 'image'];

    public function getImageUrlAttribute($value)
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return '';
    }
}
