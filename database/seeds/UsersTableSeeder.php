<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

//        $faker = Faker::create();

        DB::table('users')->delete();
        DB::table('users')->insert(
            [
                [
                    'name' => Faker::create()->name(),
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => \Apps\User\Model\Role::where('role', 'Admin')->first()['id'],
                    'location_id' => \Apps\Product\Model\Location::all()[0]['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => Faker::create()->name(),
                    'email' => 'seller@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => \Apps\User\Model\Role::where('role', 'Seller')->first()['id'],
                    'location_id' => \Apps\Product\Model\Location::all()[1]['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => Faker::create()->name(),
                    'email' => 'customer@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => \Apps\User\Model\Role::where('role', 'Customer')->first()['id'],
                    'location_id' => \Apps\Product\Model\Location::all()[2]['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
