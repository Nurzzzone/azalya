<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use database\seeds\UsersAndNotesSeeder;
//use database\seeds\MenusTableSeeder;

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
        ]);
    }
}
