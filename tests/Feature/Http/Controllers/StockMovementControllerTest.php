<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StockMovementController
 */
final class StockMovementControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $stockMovements = StockMovement::factory()->count(3)->create();

        $response = $this->get(route('stock-movements.index'));

        $response->assertOk();
        $response->assertViewIs('stockMovement.index');
        $response->assertViewHas('stockMovements');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('stock-movements.create'));

        $response->assertOk();
        $response->assertViewIs('stockMovement.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockMovementController::class,
            'store',
            \App\Http\Requests\StockMovementStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $stock = Stock::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->word();
        $user = User::factory()->create();

        $response = $this->post(route('stock-movements.store'), [
            'stock_id' => $stock->id,
            'quantity' => $quantity,
            'type' => $type,
            'user_id' => $user->id,
        ]);

        $stockMovements = StockMovement::query()
            ->where('stock_id', $stock->id)
            ->where('quantity', $quantity)
            ->where('type', $type)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $stockMovements);
        $stockMovement = $stockMovements->first();

        $response->assertRedirect(route('stockMovements.index'));
        $response->assertSessionHas('stockMovement.id', $stockMovement->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $stockMovement = StockMovement::factory()->create();

        $response = $this->get(route('stock-movements.show', $stockMovement));

        $response->assertOk();
        $response->assertViewIs('stockMovement.show');
        $response->assertViewHas('stockMovement');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $stockMovement = StockMovement::factory()->create();

        $response = $this->get(route('stock-movements.edit', $stockMovement));

        $response->assertOk();
        $response->assertViewIs('stockMovement.edit');
        $response->assertViewHas('stockMovement');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockMovementController::class,
            'update',
            \App\Http\Requests\StockMovementUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $stockMovement = StockMovement::factory()->create();
        $stock = Stock::factory()->create();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->word();
        $user = User::factory()->create();

        $response = $this->put(route('stock-movements.update', $stockMovement), [
            'stock_id' => $stock->id,
            'quantity' => $quantity,
            'type' => $type,
            'user_id' => $user->id,
        ]);

        $stockMovement->refresh();

        $response->assertRedirect(route('stockMovements.index'));
        $response->assertSessionHas('stockMovement.id', $stockMovement->id);

        $this->assertEquals($stock->id, $stockMovement->stock_id);
        $this->assertEquals($quantity, $stockMovement->quantity);
        $this->assertEquals($type, $stockMovement->type);
        $this->assertEquals($user->id, $stockMovement->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $stockMovement = StockMovement::factory()->create();

        $response = $this->delete(route('stock-movements.destroy', $stockMovement));

        $response->assertRedirect(route('stockMovements.index'));

        $this->assertSoftDeleted($stockMovement);
    }
}
