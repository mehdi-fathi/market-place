<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('roles')->delete();
        DB::table('roles')->insert(
            [
                [
                    'role' => 'Admin',
                    'slug' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'role' => 'Seller',
                    'slug' => 'seller',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'role' => 'Customer',
                    'slug' => 'customer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
