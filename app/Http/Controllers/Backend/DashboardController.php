<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;


class DashboardController extends Controller
{
    public function index()
    {
        // Status ID :
        // 1 = waiting payment
        // 2 = On Progress
        // 3 = Done

        $data['progress'] = Orders::where('status', 2)->get();
        $data['done'] = Orders::where('status', 3)->get();
        return view('backend.dashboard.dashboard', compact('data'));
    }

        public function total_done()
    {
        $orders = Orders::select('id', 'created_at', 'status')
                ->where('status', 3)
                ->get()
                ->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->created_at)->format('m');
                });

        $order_count = [];
        $total = [];

        foreach ($orders as $key => $value) {
            $order_count[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($order_count[$i])){
                $total[] = $order_count[$i];    
            }else{
                $total[] = 0;    
            }
        }
        return $total;
    }

    public function total_progress()
    {
        $orders = Orders::select('id', 'created_at', 'status')
        ->whereNot('status', 2)
        ->get()
        ->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('m');
        });
                
        $order_count = [];
        $total = [];

        foreach ($orders as $key => $value) {
            $order_count[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($order_count[$i])){
                $total[] = $order_count[$i];    
            }else{
                $total[] = 0;    
            }
        }
        return $total;
    }
}
