<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Format;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(20)
            ->create();

        $size = Size::all()->where('slug', 's')->first();
        $format = Format::all()->where('slug', 'lenta')->first();

        Product::all()->each(function($product) use ($size, $format) {
            $product->sizes()->attach([$size->id]);
            $product->formats()->attach([$format->id]);
        });
    }
}
