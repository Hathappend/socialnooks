<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationalTime extends Model
{
    use softDeletes;

    protected $table = 'operational_times';

    protected $fillable = [
        'day',
        'start',
        'end',
        'place_id'
    ];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'place_operational_times', 'operational_time_id', 'place_id')
            ->withTimestamps();
    }
}
