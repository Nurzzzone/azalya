<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'name' => 'Моно-букет',
                'slug' => Str::slug('Моно-букет')
            ],
            [
                'name' => 'Сборный букет',
                'slug' => Str::slug('Сборный букет')
            ],
            [
                'name' => 'В коробке',
                'slug' => Str::slug('В коробке')
            ],
            [
                'name' => 'В корзине',
                'slug' => Str::slug('В корзине')
            ],
        ]);
    }
}
