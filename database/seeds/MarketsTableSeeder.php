<?php

use Illuminate\Database\Seeder;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('markets')->delete();


        $faker = \Faker\Factory::create();

        foreach (range(1, 200) as $index) {

            $lastId = DB::table('locations')->insertGetId([
                'address' => $faker->address,
                'latitude' => $faker->latitude(40, 41.985091),
                'longitude' => $faker->longitude(-70,-73.168285),
                'city' => $faker->city,
                'radius' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('markets')->insert([
                'user_id' => \Apps\User\Model\Role::getIdByRole('Seller'),
                'location_id' => $lastId,
                'name' => $faker->lastName,
                'description' => $faker->text,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ]);
        }
    }
}
