<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'address', 'postal_code', 'phone', 'email', 'ftime', 'ltime',
        'facebook', 'instagram', 'twitter', 'logo', 'background'
    ];

    public function getLogoUrlAttribute($value)
    {
        if ($this->logo) {
            return asset('images/' . $this->logo);
        }
        return asset('images/default-image.jpg');
    }

    public function getBackgroundUrlAttribute($value)
    {
        if ($this->background) {
            return asset('images/' . $this->background);
        }
        return asset('images/default-image.jpg');
    }
}
