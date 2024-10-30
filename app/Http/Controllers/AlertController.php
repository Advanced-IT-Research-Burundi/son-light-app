<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{
    public function index()
    {
        $orderAlerts = Order::where(function($query) {
            $query->where('status_livraison', '==',2)
                  ->whereDate('delivery_date', '=', now()->addDay())
                  ->orWhereDate('delivery_date', '=', now())
                 ->orWhere(function($q) {
                    $q->whereDate('delivery_date', '<', now())
                        ->where('status', '!=', 'delivered');
                });
        })->with('client')->get();

        $stockAlerts = Stock::where('quantity', '<=', DB::raw('min_quantity'))->get();

        return view('alerts.index', compact('orderAlerts', 'stockAlerts'));
    }
}