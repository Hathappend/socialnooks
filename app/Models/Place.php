<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'places';

    protected $fillable = [
        'place_unique_code',
        'name',
        'slug',
        'description',
        'address',
        'latitude',
        'longitude',
        'thumbnail',
        'start_price',
        'end_price',
        'phone_number',
        'status',
        'category_id',
        'user_id'
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'place_editors', 'place_id', 'user_id')
            ->withTimestamps();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'place_id');
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'place_facilities', 'place_id', 'facility_id')
            ->withTimestamps();
    }

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class, 'place_payments', 'place_id', 'payment_id')
            ->withTimestamps();
    }

    public function accessibilities(): BelongsToMany
    {
        return $this->belongsToMany(Accessibility::class, 'place_accessibilities', 'place_id', 'accessibility_id')
            ->withTimestamps();
    }

    public function operationalTimes(): HasMany
    {
        return $this->hasMany(OperationalTime::class, 'place_id');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'place_services', 'place_id', 'service_id')
            ->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PlacePhoto::class, 'place_id');
    }
}
