<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::factory()->createMany([
            [
                'name' => 'Поездка на квадроцикле',
            ],
            [
                'name' => 'Тур на эндуро',
            ],
        ]);
    }
}
