<?php

use Illuminate\Database\Seeder;

class ClubFederationstatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubfederation_statuses')->insert([
            'status_name' => 'Active',
        ]);

        DB::table('clubfederation_statuses')->insert([
            'status_name' => 'Suspended',
        ]);

        DB::table('clubfederation_statuses')->insert([
            'status_name' => 'Deleted',
        ]);

        DB::table('clubfederation_statuses')->insert([
            'status_name' => 'Pending',
        ]);
        
        DB::table('clubfederation_statuses')->insert([
            'status_name' => 'Cancelled',
        ]);
    }
}
