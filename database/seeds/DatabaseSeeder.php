<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(LocationsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(MarketsTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(PermissionsRolesTableSeeder::class);
    }
}
