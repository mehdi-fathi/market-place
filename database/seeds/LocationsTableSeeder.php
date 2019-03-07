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
        DB::table('locations')->insert(
            [
                [
                    'lat' => 200,
                    'lng' => 150,
                    'address' => 'sdsdsds',
                    'city' => 'Tehran',
                    'radius' => 214545,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lat' => 400,
                    'lng' => 120,
                    'address' => 'sdsdsds',
                    'city' => 'Kerman',
                    'radius' => 12324,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'lat' => 360,
                    'lng' => 320,
                    'address' => 'xsdssf',
                    'city' => 'Tehran',
                    'radius' => 1232124,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
