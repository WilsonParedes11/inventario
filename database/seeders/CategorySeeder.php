<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            [
                'id'    => 1,
                'name'  => 'Pinturas Interiores',
                'slug'  => 'pinturas-interiores',
                'user_id' => 1,
            ],
            [
                'id'    => 2,
                'name'  => 'Pinturas Exteriores',
                'slug'  => 'pinturas-exteriores',
                'user_id' => 1,
            ],
            [
                'id'    => 3,
                'name'  => 'Pinturas Impermeabilizantes',
                'slug'  => 'pinturas-impermeabilizantes',
                'user_id' => 1,
            ],
            [
                'id'    => 4,
                'name'  => 'Pinceles y Rodillos',
                'slug'  => 'pinceles-y-rodillos',
                'user_id' => 1,
            ],
            [
                'id'    => 5,
                'name'  => 'Accesorios de Pintura',
                'slug'  => 'accesorios-de-pintura',
                'user_id' => 1,
            ]
        ]);

        $categories->each(function ($category) {
            Category::insert($category);
        });
    }
}
