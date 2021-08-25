<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersAndNotesSeeder::class,
            MenusTableSeeder::class,
            EmailSeeder::class,
            CategorySeeder::class,
            FormatSeeder::class,
            SizeSeeder::class,
            TypesSeeder::class,
            ProductTableSeeder::class,
            MapSeeder::class,
            DeliverySeeder::class,
            AboutSeeder::class,
            HomepageAboutSeeder::class,
            ProductAboutSeeder::class,
            GeneralSettingsTableSeeder::class,
        ]);
    }
}
