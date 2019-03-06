<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 3/6/19
 * Time: 6:42 PM
 */

namespace Tests\Unit\User;


use Apps\User\Model\User;
use Illuminate\Database\Eloquent\Factory;
use Tests\TestCase;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install --env=testing');
    }

    public function test_user_can_login_form()
    {
//
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt($password = '123456'),
        ]);
        $body = [
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ];
        $this->json('POST', '/Api/v1/login', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['success' => ['token']]);
    }

    public function test_register_form()
    {
//
        $body = [
            'name' => 'mehdi',
            'email' => 'mehdifathi@gmail.com',
            'password' => '123456',
            'c_password' => '123456'
        ];
        $this->json('POST', '/Api/v1/register', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['success' => ['token']]);
    }

    public function test_get_user()
    {
//
        factory(User::class)->create([
            'email' => 'admin_2@gmail.com',
            'password' => bcrypt($password = '123456'),
        ]);
        $body = [
            'email' => 'admin_2@gmail.com',
            'password' => '123456'
        ];

        $token = json_decode($this->json('POST', '/Api/v1/login', $body,
            ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['success' => ['token']])->getContent());


        $this->json('POST', '/Api/v1/getUser', [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token->success->token,
            ])->assertSee('admin_2@gmail.com');
    }
}