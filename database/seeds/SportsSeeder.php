<?php

use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert([
            'name' => 'Tennis',
        ]);

        DB::table('sports')->insert([
            'name' => 'Squash',
        ]);

        DB::table('sports')->insert([
            'name' => 'Volley',
        ]);

        DB::table('sports')->insert([
            'name' => 'Badminton',
        ]);
    }
}
