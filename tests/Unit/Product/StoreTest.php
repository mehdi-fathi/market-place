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

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_seller_can_create_store()
    {

        $user = User::where([
            'email' => 'seller@gmail.com',
            'role_id' => Role::getIdByRole('Seller')
        ])->first();

        Passport::actingAs($user);


        $response = $this->json('POST', '/Api/v1/seller/stores/create', [
            'store' => 'Mahan',
            'description' => "It's a store sell new laptops",
            'lat' => 1145,
            'lng' => 1145,
            'address' => 'Tehran - pleak 11',
            'radius' => 215445,
            'city' => 'Tehran',
        ]);

        $response->assertStatus(201);
    }
}
