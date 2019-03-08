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

class MarketTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_seller_can_create_market()
    {

        $user = User::where([
            'email' => 'seller@gmail.com',
            'role_id' => Role::getIdByRole('Seller')
        ])->first();

        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/seller/markets/create', [
            'name' => 'Mahan',
            'description' => "It's a market sell new laptops",
            'latitude' => 1145,
            'longitude' => 1145,
            'address' => 'Tehran - pleak 11',
            'radius' => 215445,
            'city' => 'Tehran',
        ]);

        $response->assertStatus(201);
    }
}
