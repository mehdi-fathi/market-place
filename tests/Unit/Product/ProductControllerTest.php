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
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
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
            'market_id' => 1,
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
            'market_id' => 1,
            'title' => 'Mac book pro',
            'description' => "It's a type of laptop",
            'price' => 1500.5 . '$', // it's not valid data
            'discount' => 10,
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'result' => [
                    'error' => ['price']
                ]
            ]);;
    }

    public function test_customer_find_near_product()
    {
        $user = User::where([
            'email' => 'customer@gmail.com',
            'role_id' => Role::getIdByRole('Customer')
        ])->first();

        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/customer/products/find-near', [
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'result' => [
                    '*' => [
                        'price',
                        'market_id',
                        'title',
                    ]
                ]
            ]);

        $response = $this->json('POST', '/Api/v1/customer/products/find-near', [
            'radius' => 100
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'result' => [
                    '*' => [
                        'price',
                        'market_id',
                        'title',
                    ]
                ]
            ]);

    }
}
