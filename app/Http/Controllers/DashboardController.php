<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Task;


class DashboardController extends Controller
{
    public function dashboard(){
        $orders_count = Order::where('status', 'En cours')->count();
        $tasks_count = Task::where('status', 'en cours')->count();
        $chiffre_affaire = Payment::where('created_at','like', '%'.date('Y-m').'%' )->sum('amount') ;
        $last_commands = Order::with(['client'])->latest()->take(5)->get();
       
  
        return view('dashboard', [
            'commande_cours' => $orders_count,
            'tasks_count' => $tasks_count,
            'chiffre_affaire' => number_format($chiffre_affaire,0,',','.')  . ' FBU',
           'last_commands' => $last_commands,
          
        ]);
    }


    
}
