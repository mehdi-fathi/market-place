<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class LocationsTableSeeder extends Seeder
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

        DB::table('locations')->delete();

        $faker = \Faker\Factory::create();

        foreach (range(1, 3) as $index) {

            DB::table('locations')->insertGetId([
                'latitude' => $faker->latitude(),
                'longitude' => $faker->longitude,
                'address' => $faker->address,
                'city' => $faker->city,
                'radius' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
