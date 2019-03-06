<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->delete();
        DB::table('permissions')->insert(
            [
                [
                    'permission' => 'Admin-users',
                    'slug' => 'admin-users',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'permission' => 'Seller-users',
                    'slug' => 'seller-users',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'permission' => 'Customer-users',
                    'slug' => 'customer-users',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
