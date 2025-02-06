<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use softDeletes;

    protected $table = 'services';
    protected $fillable = ['name'];

    public function places(): belongsToMany
    {
        return $this->belongsToMany(Place::class, 'place_services', 'service_id', 'place_id');
    }
}
