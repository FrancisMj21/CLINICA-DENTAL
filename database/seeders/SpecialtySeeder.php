<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Odontología general'],
            ['name' => 'Cirugía oral y maxilofacial'],
            ['name' => 'Endodoncia'],
            ['name' => 'Odontología estética'],
            ['name' => 'Odontopediatría'],
            ['name' => 'Ortodoncia'],
            ['name' => 'Patología bucal'],
            ['name' => 'Periodoncia'],
            ['name' => 'Prostodoncia y rehabilitación oral'],
            ['name' => 'Radiología oral y maxilofacial'],
        ];

        foreach ($data as $row) {
            DB::table('specialties')->updateOrInsert(
                ['name' => $row['name']],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}