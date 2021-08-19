<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
            'name' => 'Азалия',
            'phone_number' => 'phone number',
            'instagram' => 'link',
            'facebook' => 'link',
            'whatsapp' => 'link'
        ]);
    }
}
