<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StockController
 */
final class StockControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $stocks = Stock::factory()->count(3)->create();

        $response = $this->get(route('stocks.index'));

        $response->assertOk();
        $response->assertViewIs('stock.index');
        $response->assertViewHas('stocks');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('stocks.create'));

        $response->assertOk();
        $response->assertViewIs('stock.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockController::class,
            'store',
            \App\Http\Requests\StockStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $product_name = $this->faker->word();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $unit = $this->faker->word();
        $min_quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('stocks.store'), [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'unit' => $unit,
            'min_quantity' => $min_quantity,
        ]);

        $stocks = Stock::query()
            ->where('product_name', $product_name)
            ->where('quantity', $quantity)
            ->where('unit', $unit)
            ->where('min_quantity', $min_quantity)
            ->get();
        $this->assertCount(1, $stocks);
        $stock = $stocks->first();

        $response->assertRedirect(route('stocks.index'));
        $response->assertSessionHas('stock.id', $stock->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.show', $stock));

        $response->assertOk();
        $response->assertViewIs('stock.show');
        $response->assertViewHas('stock');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.edit', $stock));

        $response->assertOk();
        $response->assertViewIs('stock.edit');
        $response->assertViewHas('stock');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StockController::class,
            'update',
            \App\Http\Requests\StockUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $stock = Stock::factory()->create();
        $product_name = $this->faker->word();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $unit = $this->faker->word();
        $min_quantity = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('stocks.update', $stock), [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'unit' => $unit,
            'min_quantity' => $min_quantity,
        ]);

        $stock->refresh();

        $response->assertRedirect(route('stocks.index'));
        $response->assertSessionHas('stock.id', $stock->id);

        $this->assertEquals($product_name, $stock->product_name);
        $this->assertEquals($quantity, $stock->quantity);
        $this->assertEquals($unit, $stock->unit);
        $this->assertEquals($min_quantity, $stock->min_quantity);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->delete(route('stocks.destroy', $stock));

        $response->assertRedirect(route('stocks.index'));

        $this->assertSoftDeleted($stock);
    }
}
