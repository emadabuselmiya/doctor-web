<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address', 'postal_code', 'phone', 'email', 'ftime', 'ltime',
        'facebook', 'instagram', 'twitter', 'logo', 'background'
    ];

    public function getLogoUrlAttribute($value)
    {
        if ($this->logo) {
            return asset('images/' . $this->logo);
        }
        return 'assets/images/logo.png';
    }

    public function getBackgroundUrlAttribute($value)
    {
        if ($this->background) {
            return asset('images/' . $this->background);
        }
        return '';
    }
}
