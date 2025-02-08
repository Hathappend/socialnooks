<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;

class FormatedHelper
{
    public static function priceWithoutZeros(int $price): String
    {
        $price = floatval($price);

        if ($price >= 1000000) {
            $formattedPrice = ($price / 1000000) . 'M';
        } elseif ($price >= 1000) {
            $formattedPrice = ($price / 1000) . 'K';
        } else {
            $formattedPrice = $price;
        }

         return $formattedPrice;
    }

    public static function priceRangeFormating(array $places): array
    {

        if(isset($places['priceRange'])){
            return self::createPriceDisplay($places, $places['priceRange']);
        }

        if(isset($places['places']['priceRange'])){
            return self::createPriceDisplay($places['places'], $places['places']['priceRange']);
        }

        return self::createPriceDisplay($places);
    }

    private static function createPriceDisplay(array $place, ?array $priceRange = []): array
    {
        if (!$priceRange) {
            $place['priceDisplay'] = '<span>No Available Price Range</span>';
        } elseif (!isset($priceRange['startPrice'])) {
            $place['priceDisplay'] = self::priceWithoutZeros($priceRange['endPrice']['units'] ?? 0) . ' average';
        } elseif (!isset($priceRange['endPrice'])) {
            $place['priceDisplay'] = self::priceWithoutZeros($priceRange['startPrice']['units'] ?? 0) . ' average';
        } else {
            $place['priceDisplay'] = self::priceWithoutZeros($priceRange['startPrice']['units'] ?? 0) . ' - ' . self::priceWithoutZeros($priceRange['endPrice']['units'] ?? 0);
        }

        return $place;

    }

    public static function ratingFormating(array $places): array|float
    {

        if (!isset($places['rating'])) {
            $places['ratingDisplay'] = "Null";
            return $places;
        }

        if($places['rating'] > 4.0){
            $places['ratingDisplay'] = "Excellent";
        }elseif($places['rating'] > 3.0){
            $places['ratingDisplay'] = "Good";
        }elseif($places['rating'] > 2.0){
            $places['ratingDisplay'] = "Average";
        }elseif($places['rating'] > 1.0){
            $places['ratingDisplay'] = "Poor";
        }else{
            $places['ratingDisplay'] = "Null";
        }

        return $places;
    }

    public static function placeKeysFormatting(array $places): array
    {
        if (isset($places['paymentOptions'])) {
            $places['paymentOptions'] = collect($places['paymentOptions'])
                ->filter(function ($value) {
                    return $value === true;
                })
                ->mapWithKeys(function ($value, $key) {
                    return [$key => Str::of($key)->snake(' ')->ucfirst()];
                })
                ->toArray();
        }

        $places = self::getFacilityKeysByTrueValue($places);
        $places = self::getServiceKeysByTrueValue($places);
        $places = self::getAccessibilityKeysByTrueValue($places);

        return $places;
    }

    public static function starsFormating(?float $stars): ?string
    {
        if (isset($stars)){
            if ($stars >= 1 && $stars < 2) {
                return "★ ☆ ☆ ☆ ☆";
            }elseif ($stars >= 2 && $stars < 3 ) {
                return "★ ★ ☆ ☆ ☆";
            }elseif ($stars >= 3 && $stars < 4 ) {
                return "★ ★ ★ ☆ ☆";
            }elseif ($stars >= 4 && $stars < 5) {
                return "★ ★ ★ ★ ☆";
            }elseif ($stars == 5) {
                return "★ ★ ★ ★ ★";
            }else{
                return "☆ ☆ ☆ ☆ ☆";
            }
        }

        return null;
    }

    public static function getPercentFromUserRating(array|Collection $rating): array
    {

        $ratings = collect($rating)->pluck('rating') ?? $rating->pluck('rating');

        $totalRatings = $ratings->count();

        $ratingPercentages = collect(range(5, 1))->mapWithKeys(function ($rating) use ($ratings, $totalRatings) {
            $labels = [
                5 => 'excellent',
                4 => 'good',
                3 => 'average',
                2 => 'below_avg',
                1 => 'poor'
            ];
            $count = $ratings->filter(fn($value) => $value === $rating)->count();
            return [$labels[$rating] => $totalRatings > 0 ? round(($count / $totalRatings) * 100, 2) : 0];
        });

        return $ratingPercentages->toArray();

    }

    private static function getFacilityKeysByTrueValue(array $places): array
    {
        $facilityKeys = [
            'allowsDogs',
            'liveMusic',
            'outdoorSeating',
            'restroom',
            'goodForChildren',
            'goodForGroups'
        ];

        foreach ($facilityKeys as $key) {
            if (isset($places[$key]) && $places[$key]) {
                $places['facilities'][$key] = Str::of($key)->snake(' ')->ucfirst();
            }
        }

        return $places;
    }

    private static function getServiceKeysByTrueValue(array $places): array
    {
        $serviceKeys = [
            'takeout',
            'delivery',
            'dineIn',
            'Reservable',
            'servesBreakFast',
            'servesLunch',
            'servesDinner',
            'servesBeer',
            'servesWine',
            'servesBrunch',
            'servesCocktails',
            'servesCoffee',
            'servesDessert',
            'servesVegetarianFood'
        ];

        foreach ($serviceKeys as $key) {
            if (isset($places[$key]) && $places[$key]) {
                $places['services'][$key] = Str::of($key)->snake(' ')->ucfirst();
            }
        }

        return $places;
    }

    private static function getAccessibilityKeysByTrueValue(array $places): array
    {
        if (isset($places['accessibilityOptions'])) {
            $places['accessibilityOptions'] = collect($places['accessibilityOptions'])
                ->filter(function ($value) {
                    return $value === true;
                })
                ->mapWithKeys(function ($value, $key) {
                    return [$key => Str::of($key)->snake(' ')->ucfirst()];
                })
                ->toArray();
        }

        return $places;
    }
}
