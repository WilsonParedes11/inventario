<?php

namespace Database\Seeders;

use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = collect([
            [
                'name' => 'Pintura Interior Blanca',
                'slug' => 'pintura-interior-blanca',
                'code' => 001,
                'quantity' => 100,
                'buying_price' => 20,
                'selling_price' => 30,
                'quantity_alert' => 10,
                'tax' => 15,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => 1,
                'unit_id' => 3,
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => 'assets/img/products/interior-white.png'
            ],
            [
                'name' => 'Pintura Exterior Gris',
                'slug' => 'pintura-exterior-gris',
                'code' => 002,
                'quantity' => 100,
                'buying_price' => 25,
                'selling_price' => 35,
                'quantity_alert' => 10,
                'tax' => 15,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => 2,
                'unit_id' => 3,
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => 'assets/img/products/exterior-gray.png'
            ],
            [
                'name' => 'Pintura Impermeabilizante Transparente',
                'slug' => 'pintura-impermeabilizante-transparente',
                'code' => 003,
                'quantity' => 100,
                'buying_price' => 30,
                'selling_price' => 40,
                'quantity_alert' => 10,
                'tax' => 15,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => 3,
                'unit_id' => 3,
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => 'assets/img/products/waterproof-clear.png'
            ],
            [
                'name' => 'Set de Pinceles',
                'slug' => 'set-de-pinceles',
                'code' => 004,
                'quantity' => 200,
                'buying_price' => 10,
                'selling_price' => 15,
                'quantity_alert' => 50,
                'tax' => 15,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => 4,
                'unit_id' => 3,
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => 'assets/img/products/brush-set.png'
            ],
            [
                'name' => 'Cinta de Pintor',
                'slug' => 'cinta-de-pintor',
                'code' => 005,
                'quantity' => 500,
                'buying_price' => 2,
                'selling_price' => 3,
                'quantity_alert' => 100,
                'tax' => 15,
                'tax_type' => 1,
                'notes' => null,
                'category_id' => 5,
                'unit_id' => 3,
                'user_id' => 1,
                'uuid' => Str::uuid(),
                'product_image' => 'assets/img/products/painter-tape.png'
            ]
        ]);

        $products->each(function ($product) {
            Product::create($product);
        });
    }
}
