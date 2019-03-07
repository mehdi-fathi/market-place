<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 3/6/19
 * Time: 6:42 PM
 */

namespace Tests\Unit\User;


use Apps\User\Model\Role;
use Apps\User\Model\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_seller_can_create_product()
    {
        $user = User::where([
            'email' => 'seller@gmail.com',
            'role_id' => Role::getIdByRole('Seller')
        ])->first();
//        dd($user);
        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/seller/products/create', [
            'store_id' => 1,
            'title' => 'Mac book pro',
            'description' => "It's a type of laptop",
            'price' => 1500,
            'discount' => 10,
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_seller_validation_create_product()
    {
        $user = User::where([
            'email' => 'seller@gmail.com',
            'role_id' => Role::getIdByRole('Seller')
        ])->first();
//        dd($user);
        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/seller/products/create', [
            'store_id' => 1,
            'title' => 'Mac book pro',
            'description' => "It's a type of laptop",
            'price' => 1500.5.'$', // it's not valid data
            'discount' => 10,
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'result' => [
                    'error'=>['price']
                ]
            ]);;
    }
}
