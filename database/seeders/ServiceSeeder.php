<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Takeout',
            'Delivery',
            'Dine In',
            'Reservable',
            'Serves Breakfast',
            'Serves Lunch',
            'Serves Dinner',
            'Serves Beer',
            'Serves Wine',
            'Serves Brunch',
            'Serves Cocktails',
            'Serves Coffee',
            'Serves Dessert',
            'Serves Vegetarian Food',
            'Catering Service',
            'Private Events',
            'Self Service',
            'Table Service',
            'Drive-Thru Service',
            'Online Reservation',
            'Mobile Ordering',
            'Curbside Pickup',
            'Happy Hour Specials',
            'Buffet Style',
            'Event Hosting',
            'Loyalty Program',
            'Live Cooking Station',
            'Contactless Payment',
            'Chef’s Special Menu',
            '24/7 Service'
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service,
            ]);
        }
    }
}
