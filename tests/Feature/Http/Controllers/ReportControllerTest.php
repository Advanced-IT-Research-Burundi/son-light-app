<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReportController
 */
final class ReportControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reports = Report::factory()->count(3)->create();

        $response = $this->get(route('reports.index'));

        $response->assertOk();
        $response->assertViewIs('report.index');
        $response->assertViewHas('reports');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('reports.create'));

        $response->assertOk();
        $response->assertViewIs('report.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReportController::class,
            'store',
            \App\Http\Requests\ReportStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $type = $this->faker->word();
        $content = $this->faker->paragraphs(3, true);
        $report_date = Carbon::parse($this->faker->date());

        $response = $this->post(route('reports.store'), [
            'user_id' => $user->id,
            'type' => $type,
            'content' => $content,
            'report_date' => $report_date->toDateString(),
        ]);

        $reports = Report::query()
            ->where('user_id', $user->id)
            ->where('type', $type)
            ->where('content', $content)
            ->where('report_date', $report_date)
            ->get();
        $this->assertCount(1, $reports);
        $report = $reports->first();

        $response->assertRedirect(route('reports.index'));
        $response->assertSessionHas('report.id', $report->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.show', $report));

        $response->assertOk();
        $response->assertViewIs('report.show');
        $response->assertViewHas('report');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.edit', $report));

        $response->assertOk();
        $response->assertViewIs('report.edit');
        $response->assertViewHas('report');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReportController::class,
            'update',
            \App\Http\Requests\ReportUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $report = Report::factory()->create();
        $user = User::factory()->create();
        $type = $this->faker->word();
        $content = $this->faker->paragraphs(3, true);
        $report_date = Carbon::parse($this->faker->date());

        $response = $this->put(route('reports.update', $report), [
            'user_id' => $user->id,
            'type' => $type,
            'content' => $content,
            'report_date' => $report_date->toDateString(),
        ]);

        $report->refresh();

        $response->assertRedirect(route('reports.index'));
        $response->assertSessionHas('report.id', $report->id);

        $this->assertEquals($user->id, $report->user_id);
        $this->assertEquals($type, $report->type);
        $this->assertEquals($content, $report->content);
        $this->assertEquals($report_date, $report->report_date);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $report = Report::factory()->create();

        $response = $this->delete(route('reports.destroy', $report));

        $response->assertRedirect(route('reports.index'));

        $this->assertSoftDeleted($report);
    }
}
