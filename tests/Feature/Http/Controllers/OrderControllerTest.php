<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\OrderCreatedEvent;
use App\Jobs\SyncOrderWithExternalService;
use App\Mail\OrderCreated;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('order.index');
        $response->assertViewHas('orders');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $client = Client::factory()->create();
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $order_date = Carbon::parse($this->faker->date());
        $delivery_date = Carbon::parse($this->faker->date());
        $status = $this->faker->word();
        $description = $this->faker->text();

        Mail::fake();
        Queue::fake();
        Event::fake();

        $response = $this->post(route('orders.store'), [
            'client_id' => $client->id,
            'amount' => $amount,
            'order_date' => $order_date,
            'delivery_date' => $delivery_date,
            'status' => $status,
            'description' => $description,
        ]);

        $orders = Order::query()
            ->where('client_id', $client->id)
            ->where('amount', $amount)
            ->where('order_date', $order_date)
            ->where('delivery_date', $delivery_date)
            ->where('status', $status)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('order.index'));
        $response->assertSessionHas('order.id', $order->id);

        Mail::assertSent(OrderCreated::class, function ($mail) {
            return $mail->hasTo($order->client->email);
        });
        Queue::assertPushed(SyncOrderWithExternalService::class, function ($job) use ($order) {
            return $job->order->is($order);
        });
        Event::assertDispatched(OrderCreatedEvent::class, function ($event) use ($order) {
            return $event->order->is($order);
        });
    }
}
