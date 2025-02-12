<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = collect([
            [
                'name' => 'Litros',
                'slug' => 'litros',
                'short_code' => 'l',
                'user_id'=>1
            ],
            [
                'name' => 'Kilogramos',
                'slug' => 'kilogramos',
                'short_code' => 'kg',
                'user_id'=>1
            ],
            [
                'name' => 'Galones',
                'slug' => 'galones',
                'short_code' => 'gl',
                'user_id'=>1
            ]
        ]);

        $units->each(function ($unit){
            Unit::insert($unit);
        });
    }
}
