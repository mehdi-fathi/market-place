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

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_buy_product()
    {
        $user = User::where([
            'email' => 'customer@gmail.com',
            'role_id' => Role::getIdByRole('Customer')
        ])->first();

        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/customer/payment/product-buy', [
            'product_id' => 1,
            'value' => 120.2,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
    public function test_validation_buy_product()
    {
        $user = User::where([
            'email' => 'customer@gmail.com',
            'role_id' => Role::getIdByRole('Customer')
        ])->first();

        Passport::actingAs($user);

        $response = $this->json('POST', '/Api/v1/customer/payment/product-buy', [
            'value' => 120.2,
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
