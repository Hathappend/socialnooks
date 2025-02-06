<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlacePhoto extends Model
{
    use softDeletes;

    protected $table = "place_photos";
    protected $fillable = [
        'photo',
        'place_id',
    ];
}
