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
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_admin_can_create_seller()
    {
//
        $body = [
            'name' => 'mehdi',
            'email' => 'mehdifathi@gmail.com',
            'password' => '123456',
            'c_password' => '123456',
            'lat' => 120,
            'lng' => 120,
            'address' => 'sdsdrwvvs',
            'radius' => 120984,
            'city' => 'Tehran',
        ];

        $user = User::where([
            'email' => 'admin@gmail.com',
            'role_id' => Role::getIdByRole('Admin')
        ])->first();

        Passport::actingAs($user);

        $this->json('POST', '/Api/v1/admin/create-seller', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(201);
    }
    public function test_customer_can_not_create_seller()
    {
//
        $body = [
            'name' => 'mehdi',
            'email' => 'mehdifathi@gmail.com',
            'password' => '123456',
            'c_password' => '123456',
            'lat' => 120,
            'lng' => 120,
            'address' => 'sdsdrwvvs',
            'radius' => 120984,
            'city' => 'Tehran',
        ];

        $user = User::where([
            'email' => 'customer@gmail.com',
            'role_id' => Role::getIdByRole('Customer')
        ])->first();

        Passport::actingAs($user);

        $this->json('POST', '/Api/v1/admin/create-seller', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(401);
    }
}
