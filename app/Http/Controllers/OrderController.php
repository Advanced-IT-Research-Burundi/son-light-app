<?php

namespace App\Http\Controllers;

use App\Events\OrderCreatedEvent;
use App\Http\Requests\OrderStoreRequest;
use App\Jobs\SyncOrderWithExternalService;
use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): Response
    {
        $orders = Order::all();

        return view('order.index', compact('orders'));
    }

    public function store(OrderStoreRequest $request): Response
    {
        $order = Order::create($request->validated());

        Mail::to($order->client->email)->send(new OrderCreated());

        SyncOrderWithExternalService::dispatch($order);

        OrderCreatedEvent::dispatch($order);

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('order.index');
    }
}
