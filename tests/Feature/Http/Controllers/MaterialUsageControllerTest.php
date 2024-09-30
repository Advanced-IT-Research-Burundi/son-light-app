<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MaterialUsage;
use App\Models\Stock;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaterialUsageController
 */
final class MaterialUsageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $materialUsages = MaterialUsage::factory()->count(3)->create();

        $response = $this->get(route('material-usages.index'));

        $response->assertOk();
        $response->assertViewIs('materialUsage.index');
        $response->assertViewHas('materialUsages');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('material-usages.create'));

        $response->assertOk();
        $response->assertViewIs('materialUsage.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialUsageController::class,
            'store',
            \App\Http\Requests\MaterialUsageStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $stock = Stock::factory()->create();
        $task = Task::factory()->create();
        $user = User::factory()->create();
        $quantity_used = $this->faker->numberBetween(-10000, 10000);
        $usage_date = Carbon::parse($this->faker->date());

        $response = $this->post(route('material-usages.store'), [
            'stock_id' => $stock->id,
            'task_id' => $task->id,
            'user_id' => $user->id,
            'quantity_used' => $quantity_used,
            'usage_date' => $usage_date->toDateString(),
        ]);

        $materialUsages = MaterialUsage::query()
            ->where('stock_id', $stock->id)
            ->where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->where('quantity_used', $quantity_used)
            ->where('usage_date', $usage_date)
            ->get();
        $this->assertCount(1, $materialUsages);
        $materialUsage = $materialUsages->first();

        $response->assertRedirect(route('materialUsages.index'));
        $response->assertSessionHas('materialUsage.id', $materialUsage->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $materialUsage = MaterialUsage::factory()->create();

        $response = $this->get(route('material-usages.show', $materialUsage));

        $response->assertOk();
        $response->assertViewIs('materialUsage.show');
        $response->assertViewHas('materialUsage');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $materialUsage = MaterialUsage::factory()->create();

        $response = $this->get(route('material-usages.edit', $materialUsage));

        $response->assertOk();
        $response->assertViewIs('materialUsage.edit');
        $response->assertViewHas('materialUsage');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialUsageController::class,
            'update',
            \App\Http\Requests\MaterialUsageUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $materialUsage = MaterialUsage::factory()->create();
        $stock = Stock::factory()->create();
        $task = Task::factory()->create();
        $user = User::factory()->create();
        $quantity_used = $this->faker->numberBetween(-10000, 10000);
        $usage_date = Carbon::parse($this->faker->date());

        $response = $this->put(route('material-usages.update', $materialUsage), [
            'stock_id' => $stock->id,
            'task_id' => $task->id,
            'user_id' => $user->id,
            'quantity_used' => $quantity_used,
            'usage_date' => $usage_date->toDateString(),
        ]);

        $materialUsage->refresh();

        $response->assertRedirect(route('materialUsages.index'));
        $response->assertSessionHas('materialUsage.id', $materialUsage->id);

        $this->assertEquals($stock->id, $materialUsage->stock_id);
        $this->assertEquals($task->id, $materialUsage->task_id);
        $this->assertEquals($user->id, $materialUsage->user_id);
        $this->assertEquals($quantity_used, $materialUsage->quantity_used);
        $this->assertEquals($usage_date, $materialUsage->usage_date);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $materialUsage = MaterialUsage::factory()->create();

        $response = $this->delete(route('material-usages.destroy', $materialUsage));

        $response->assertRedirect(route('materialUsages.index'));

        $this->assertSoftDeleted($materialUsage);
    }
}
