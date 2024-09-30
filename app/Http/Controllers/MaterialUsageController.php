<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialUsageStoreRequest;
use App\Http\Requests\MaterialUsageUpdateRequest;
use App\Models\MaterialUsage;
use App\Models\Stock;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MaterialUsageController extends Controller
{
    public function index(Request $request): View
    {
        $materialUsages = MaterialUsage::all();

        return view('materialUsage.index', compact('materialUsages'));
    }

    public function create(Request $request): View
    {
        $tasks = Task::latest()->get();
        $stocks = Stock::latest()->get();
        return view('materialUsage.create',compact(['tasks','stocks']));
    }

    public function store(MaterialUsageStoreRequest $request): RedirectResponse
    {

        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $materialUsage = MaterialUsage::create($data);


        return redirect()->route('material-usages.index');
    }

    public function show(Request $request, MaterialUsage $materialUsage): View
    {

        return view('materialUsage.show', compact('materialUsage'));
    }

    public function edit(Request $request, MaterialUsage $materialUsage): View
    {

        $tasks = Task::latest()->get();
        $stocks = Stock::latest()->get();

        return view('materialUsage.edit', compact(['materialUsage','tasks','stocks']));
    }

    public function update(MaterialUsageUpdateRequest $request, MaterialUsage $materialUsage): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $materialUsage->update($data);

        return redirect()->route('material-usages.index');
    }

    public function destroy(Request $request, MaterialUsage $materialUsage): RedirectResponse
    {
        $materialUsage->delete();

        return redirect()->route('material-usages.index');
    }
}
