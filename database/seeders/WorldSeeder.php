<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Nnjeim\World\World;

class WorldSeeder extends Seeder
{
    public function run(): void
    {
        $countries = World::countries()->data;

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['iso2' => $country['code']], // clave única
                [
                    'name'       => $country['name'],
                    'phone_code' => $country['phone_code'] ?? null,
                    'iso3'       => $country['iso3'] ?? null,
                ]
            );
        }
    }
}