<?php

namespace Tests\Feature\Controller;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private $fakeUser;

    protected function setup(): void
    {
        parent::setUp();
        $this->fakeUser = User::Create(['name' => 'andy',
                                    'email' => 'andy@gmail.com',
                                    'password' => 1234567,
                                    ]);
        Passport::actingAs($this->fakeUser);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $cart = $this->fakeUser->carts()->create();
        $product = Product::factory()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 2]
        );
        $response->assertOk();
    }

    public function testUpdate()
    {
        $cart = $this->fakeUser->carts()->create();
        $product = Product::factory()->create();
        $cartItem = $cart->cartItems()->create(['product_id' => $product->id, 'quantity' => 10]);
        $response = $this->call(
            'PUT',
            'cart-items/'.$cartItem->id,
            ['quantity' => 2]
        );
        $this->assertEquals('true', $response->getContent());
        $cartItem->refresh();
        $this->assertEquals(2, $cartItem->quantity);
    }

    public function testDestory()
    {
        $cart = $this->fakeUser->carts()->create();
        $product = Product::factory()->create();
        $cartItem = $cart->cartItems()->create(['product_id' => $product->id, 'quantity' => 10]);
        $response = $this->call(
            'DELETE',
            'cart-items/'.$cartItem->id,
            ['quantity' => 2]
        );
        $response->assertOk();
        $cartItem = CartItem::find($cartItem->id);
        $this->assertNull($cartItem);
    }
}
