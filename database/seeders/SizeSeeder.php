<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'L',
            'M',
            'S',
            'XL',
        ];

        foreach($names as $name) {
            Size::create([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }
    }
}
