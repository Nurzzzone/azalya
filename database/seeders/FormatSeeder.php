<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Лента',
            'Аквабумага',
        ];

        foreach($names as $name) {
            Format::create([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }
    }
}
