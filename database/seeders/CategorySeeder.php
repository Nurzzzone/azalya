<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Оригинальные букеты',
            'Цветы в конусе',
            'Цветы в коробке',
            'Розы'
        ];

        foreach($names as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'in_homepage' => false
            ]);
        }
    }
}
