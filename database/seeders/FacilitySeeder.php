<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            'Allows Dogs',
            'Live Music',
            'Outdoor Seating',
            'Restroom',
            'Good For Children',
            'Good For Groups',
            'Free WiFi',
            'Air Conditioning',
            'Parking Available',
            'Wheelchair Accessible',
            'Smoking Area',
            'Private Dining Room',
            'Rooftop Seating',
            'Drive-Thru',
            '24-Hour Service',
            'Lounge Area',
            'Pet Friendly',
            'Kid Friendly',
            'Self-Service',
            'Valet Parking',
            'Bike Parking',
            'Outdoor Smoking Area',
            'Garden Seating',
            'Playground Area',
            'Quiet Atmosphere',
            'Charging Stations',
            'Happy Hour',
            'Live Sports Screening',
            'Private Booths',
            'Complimentary Water'
        ];

        foreach ($facilities as $facility) {
            Facility::create([
                'name' => $facility,
            ]);
        }

    }
}
