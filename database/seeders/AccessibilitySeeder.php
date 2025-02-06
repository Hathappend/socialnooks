<?php

namespace Database\Seeders;

use App\Models\Accessibility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessibilities = [
            'Wheelchair Accessible',
            'Elevator Access',
            'Braille Signage',
            'Hearing Impaired Accessible',
            'Accessible Restrooms',
            'Ramp Access',
            'Tactile Flooring',
            'Parking for Disabled',
            'Guide Dogs Allowed',
            'Accessible Entrance',
            'Audio Assistance',
            'Large Print Menus',
            'Automatic Doors',
            'Sign Language Interpreters',
            'Accessible Seating',
            'Assistive Listening Systems',
            'Accessible Parking',
            'Accessible Shower Facilities',
            'Accessibility Tags for Online Shopping',
            'Subtitles/Closed Captions for Videos',
            'Wheelchair Rental Service',
            'Accessible Toilets',
            'Accessibility Assistance Available',
            'Hearing Aid Compatibility',
            'Elevator Buttons at Accessible Height',
            'Accessible Routes for Strollers/Wheelchairs',
            'Visual and Hearing Impairment Assistance'
        ];

        foreach ($accessibilities as $accessibility) {
            Accessibility::create([
                'name' => $accessibility,
            ]);
        }
    }
}
