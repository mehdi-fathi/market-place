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
                    'family' => 'admin',
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
                    'family' => 'seller',
                    'password' => bcrypt('123456'),
                    'role_id' => \Apps\User\Model\Role::where('role', 'Seller')->first()['id'],
                    'location_id' => \Apps\Product\Model\Location::all()[1]['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => Faker::create()->name(),
                    'family' => 'customer',
                    'email' => 'customer@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => \Apps\User\Model\Role::where('role', 'Customer')->first()['id'],
                    'location_id' => \Apps\Product\Model\Location::all()[2]['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );


        $faker = \Faker\Factory::create();

        foreach (range(1, 50) as $index) {

            $lastId = DB::table('locations')->insertGetId([
                'address' => $faker->address,
                'latitude' => $faker->latitude(40, 41.985091),
                'longitude' => $faker->longitude(-70, -73.168285),
                'city' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->insertGetId([
                'name' => $faker->name(),
                'family' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt('123456'),
                'role_id' => \Apps\User\Model\Role::where('role', 'Customer')->first()['id'],
                'location_id' => $lastId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
