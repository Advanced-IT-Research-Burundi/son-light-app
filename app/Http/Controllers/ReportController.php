<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\MaterialUsage;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $raports = Report::all();

        return view('report.index', compact('raports'));
    }

    public function create(Request $request): View
    {
        return view('report.create');
    }

    public function store(ReportStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['report_date'] = now();

        $report = Report::create($data);


        return redirect()->route('reports.index');
    }

    public function show(Request $request, Report $report): View
    {
        return view('report.show', compact('report'));
    }

    public function edit(Request $request, Report $report): View
    {
        return view('report.edit', compact('report'));
    }

    public function update(ReportUpdateRequest $request, Report $report): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['report_date'] = now();

        $report->update($data);



        return redirect()->route('reports.index');
    }

    public function destroy(Request $request, Report $report): RedirectResponse
    {
        $report->delete();

        return redirect ()->route('reports.index');
    }

    public function rapportgenerale(){
        $rapports = MaterialUsage::latest()->get();

        return view('report.index', compact('raports'));
    }
}
