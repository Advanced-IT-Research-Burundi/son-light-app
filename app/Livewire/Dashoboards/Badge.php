<?php

namespace App\Livewire\Dashoboards;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Badge extends Component
{
    public function render()
    {
        $result = 
        Cache::remember('results_header', 10, function() {
            //
            return $this->alertManager();
        });
        
        return view('livewire.dashoboards.badge', 
        [
            'badgeClass' =>  $result['badgeClass'],
            'totalAlerts' =>  $result['totalAlerts'],
        ]
    );
    }

    public function alertManager(){
    $orderAlerts =  \App\Models\Order::where(function($query) {
        $query->whereDate('delivery_date', '=', now()->addDay())
            ->orWhereDate('delivery_date', '=', now())
            ->orWhere(function($q) {
                $q->whereDate('delivery_date', '<', now())
                    ->where('status', '!=', 'delivered');
            });
   
    })->count();
    
    // Calculer le nombre d'alertes de stock
    $stockAlerts = \App\Models\Stock::where('quantity', '<=', DB::raw('min_quantity'))->count();

    // Calculer le nombre total d'alertes

    $totalAlerts = $orderAlerts + $stockAlerts;
    // Déterminer la classe de couleur du badge
    $badgeClass = 'bg-success';
    if ($totalAlerts > 10) {
        $badgeClass = 'bg-danger';
    } elseif ($totalAlerts > 5) {
        $badgeClass = 'bg-warning text-dark';
    } elseif ($totalAlerts > 0) {
        $badgeClass = 'bg-info';
    }
    return compact('badgeClass', 'totalAlerts');
}
}
