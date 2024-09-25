<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Creator;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TaskController
 */
final class TaskControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tasks = Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertViewIs('task.index');
        $response->assertViewHas('tasks');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertOk();
        $response->assertViewIs('task.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TaskController::class,
            'store',
            \App\Http\Requests\TaskStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $creator = Creator::factory()->create();
        $status = $this->faker->word();
        $start_date = Carbon::parse($this->faker->date());
        $end_date = Carbon::parse($this->faker->date());

        $response = $this->post(route('tasks.store'), [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'creator_id' => $creator->id,
            'status' => $status,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
        ]);

        $tasks = Task::query()
            ->where('order_id', $order->id)
            ->where('user_id', $user->id)
            ->where('creator_id', $creator->id)
            ->where('status', $status)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $tasks);
        $task = $tasks->first();

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('task.id', $task->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', $task));

        $response->assertOk();
        $response->assertViewIs('task.show');
        $response->assertViewHas('task');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.edit', $task));

        $response->assertOk();
        $response->assertViewIs('task.edit');
        $response->assertViewHas('task');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TaskController::class,
            'update',
            \App\Http\Requests\TaskUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $task = Task::factory()->create();
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $creator = Creator::factory()->create();
        $status = $this->faker->word();
        $start_date = Carbon::parse($this->faker->date());
        $end_date = Carbon::parse($this->faker->date());

        $response = $this->put(route('tasks.update', $task), [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'creator_id' => $creator->id,
            'status' => $status,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
        ]);

        $task->refresh();

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('task.id', $task->id);

        $this->assertEquals($order->id, $task->order_id);
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals($creator->id, $task->creator_id);
        $this->assertEquals($status, $task->status);
        $this->assertEquals($start_date, $task->start_date);
        $this->assertEquals($end_date, $task->end_date);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));

        $this->assertSoftDeleted($task);
    }
}
