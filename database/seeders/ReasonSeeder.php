<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reason;

class ReasonSeeder extends Seeder
{
    public function run(): void
    {
        $reasons = [
            'Consulta general',
            'Control médico',
            'Emergencia',
            'Seguimiento',
            'Examen médico',
        ];

        foreach ($reasons as $reason) {
            Reason::updateOrCreate(['name' => $reason]);
        }
    }
}