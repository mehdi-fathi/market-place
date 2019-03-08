<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('products')->delete();
        $faker = \Faker\Factory::create();

        foreach (range(1, 400) as $index) {

            DB::table('products')->insert([
                'market_id' => \Apps\User\Model\Market::inRandomOrder()->first()['id'],
                'title' => $faker->domainWord,
                'price' => rand(0,100000.999),
                'description' => $faker->text,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
