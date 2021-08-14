<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Map::create([
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14566.99584800727!2d73.10491998293325!3d49.80288636254435!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4243472f6a1db441%3A0x116693fa87e4aef1!2z0KbQo9Cc!5e0!3m2!1sru!2skz!4v1628927494372!5m2!1sru!2skz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
        ]);
    }
}
