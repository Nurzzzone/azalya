<?php

namespace Database\Seeders;

use App\Models\ProductAbout;
use Illuminate\Database\Seeder;

class ProductAboutSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        ProductAbout::create([
            'name' => 'About', 
            'description' => '<p>description</p>',
        ]);
    }
}
