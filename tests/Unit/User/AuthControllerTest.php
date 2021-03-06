<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 3/6/19
 * Time: 6:42 PM
 */

namespace Tests\Unit\User;


use Apps\User\Model\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_login_form()
    {
//
        $body = [
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ];

        $this->json('POST', '/Api/v1/login', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['result' => ['token']]);
    }

    public function test_register_form()
    {
//
        $body = [
            'name' => 'mehdi',
            'family' => 'fathi',
            'email' => 'mehdifathi@gmail.com',
            'password' => '123456',
            'c_password' => '123456',
            'latitude' => 120,
            'longitude' => 120,
            'address' => 'sdsdrwvvs',
            'city' => 'Tehran',
        ];

        $this->json('POST', '/Api/v1/register', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['result' => ['token']]);
    }
    public function test_validation_register_form()
    {
//
        $body = [
            'name' => 'mehdi',
            'family' => 'fathi',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'c_password' => '123456',
            'latitude' => 120,
            'longitude' => 120,
            'address' => 'sdsdrwvvs',
            'city' => 'Tehran',
        ];
        $this->json('POST', '/Api/v1/register', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'result' => [
                    'error'=>['email']
                ]
            ]);
    }

    public function test_get_user()
    {
        factory(User::class)->create([
            'email' => 'admin_2@gmail.com',
            'password' =>  '123456',
        ]);
        $body = [
            'email' => 'admin_2@gmail.com',
            'password' => '123456'
        ];

        $token = json_decode($this->json('POST', '/Api/v1/login', $body,
            ['Accept' => 'application/json'])->getContent());

        $this->json('POST', '/Api/v1/get-user', [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token->result->token,
            ])->assertSee('admin_2@gmail.com');
    }
}
