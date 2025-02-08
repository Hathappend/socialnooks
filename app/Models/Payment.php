<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use softDeletes;

    protected $table = 'payments';

    protected $fillable = ['name', 'icon'];

    public function places(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
