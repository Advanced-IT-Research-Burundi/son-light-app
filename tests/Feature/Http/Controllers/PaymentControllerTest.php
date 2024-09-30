<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaymentController
 */
final class PaymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $payments = Payment::factory()->count(3)->create();

        $response = $this->get(route('payments.index'));

        $response->assertOk();
        $response->assertViewIs('payment.index');
        $response->assertViewHas('payments');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('payments.create'));

        $response->assertOk();
        $response->assertViewIs('payment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'store',
            \App\Http\Requests\PaymentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $payment_date = Carbon::parse($this->faker->date());
        $payment_method = $this->faker->word();

        $response = $this->post(route('payments.store'), [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'amount' => $amount,
            'payment_date' => $payment_date->toDateString(),
            'payment_method' => $payment_method,
        ]);

        $payments = Payment::query()
            ->where('order_id', $order->id)
            ->where('user_id', $user->id)
            ->where('amount', $amount)
            ->where('payment_date', $payment_date)
            ->where('payment_method', $payment_method)
            ->get();
        $this->assertCount(1, $payments);
        $payment = $payments->first();

        $response->assertRedirect(route('payments.index'));
        $response->assertSessionHas('payment.id', $payment->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payments.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.show');
        $response->assertViewHas('payment');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payments.edit', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.edit');
        $response->assertViewHas('payment');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'update',
            \App\Http\Requests\PaymentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $payment = Payment::factory()->create();
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $payment_date = Carbon::parse($this->faker->date());
        $payment_method = $this->faker->word();

        $response = $this->put(route('payments.update', $payment), [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'amount' => $amount,
            'payment_date' => $payment_date->toDateString(),
            'payment_method' => $payment_method,
        ]);

        $payment->refresh();

        $response->assertRedirect(route('payments.index'));
        $response->assertSessionHas('payment.id', $payment->id);

        $this->assertEquals($order->id, $payment->order_id);
        $this->assertEquals($user->id, $payment->user_id);
        $this->assertEquals($amount, $payment->amount);
        $this->assertEquals($payment_date, $payment->payment_date);
        $this->assertEquals($payment_method, $payment->payment_method);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->delete(route('payments.destroy', $payment));

        $response->assertRedirect(route('payments.index'));

        $this->assertSoftDeleted($payment);
    }
}
