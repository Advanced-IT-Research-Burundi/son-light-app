<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $tasks = Task::all();

        return view('task.index', compact('tasks'));
    }

    public function create(Request $request): View
    {
        $orders = Order::latest()->get();
        $users = User::latest()->get();
        return view('task.create',compact(['orders', 'users']));
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {

        $data = $request->validated();
        $data['creator_id'] = Auth::user()->id;

      
       Task::create($data);


        return redirect()->route('tasks.index');
    }

    public function show(Request $request, Task $task): View
    {
        return view('task.show', compact('task'));
    }

    public function edit(Request $request, Task $task): View
    {
        $orders = Order::latest()->get();
        $users = User::latest()->get();

        return view('task.edit', compact(['task', 'users', 'orders']));
    }

    public function update(TaskUpdateRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();
        $data['creator_id'] = Auth::user()->id;

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy(Request $request, Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
