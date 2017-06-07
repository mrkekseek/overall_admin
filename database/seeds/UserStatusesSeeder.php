<?php

use Illuminate\Database\Seeder;

class UserStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_statuses')->insert([
            'status_name' => 'Active',
        ]);

        DB::table('user_statuses')->insert([
            'status_name' => 'Suspended',
        ]);

        DB::table('user_statuses')->insert([
            'status_name' => 'Deleted',
        ]);

        DB::table('user_statuses')->insert([
            'status_name' => 'Pending',
        ]);
    }
}
