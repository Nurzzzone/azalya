<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::create([
            'title' => 'Delivery', 
            'description_title' => 'Delivery',
            'description' => '<p>Delivery</p>',
            'price_title' => 'Оплата',
            'price' => '<p>Delivery</p>'
        ]);
    }
}
