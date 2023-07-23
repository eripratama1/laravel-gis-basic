<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAsset()
    {
        // if ($this->image) {
        //     return asset('storage/ImageSpots/'.$this->image);
        // }

        if ($this->image) {
            return asset('/upload/spots/'.$this->image);
        }

        return 'https://placehold.co/150x200?text=No+Image';
    }
}
