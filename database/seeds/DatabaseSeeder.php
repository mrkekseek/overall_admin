<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(SportsSeeder::class);
        $this->call(UserStatusesSeeder::class);
    }
}
