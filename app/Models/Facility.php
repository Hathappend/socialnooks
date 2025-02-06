<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use softDeletes;

    protected $table = 'facilities';

    protected $fillable = ['name'];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'facility_place', 'facility_id', 'place_id');
    }
}
