<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewPhoto extends Model
{
    use softDeletes;

    protected $table = "review_photos";
    protected $fillable = [
        'photo',
        'review_id',
    ];
}
