<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Administrator',
        ]);

        DB::table('roles')->insert([
            'name' => 'owner',
            'display_name' => 'Owner',
            'description' => 'Owner',
        ]);

        DB::table('roles')->insert([
            'name' => 'employee',
            'display_name' => 'Employee',
            'description' => 'Employee',
        ]);

        DB::table('roles')->insert([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Manager',
        ]);
    }
}
