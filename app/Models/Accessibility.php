<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessibility extends Model
{
    use softDeletes;

    protected $table = 'accessibilities';

    protected $fillable = ['name'];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'place_accessibilities', 'accessibility_id', 'place_id');
    }
}
