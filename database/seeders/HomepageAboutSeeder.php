<?php

namespace Database\Seeders;

use App\Models\HomepageAbout;
use Illuminate\Database\Seeder;

class HomepageAboutSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        HomepageAbout::create([
            'name' => 'About', 
            'description' => '<p>description</p>',
        ]);
    }
}
