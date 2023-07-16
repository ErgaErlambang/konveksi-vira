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

        if(getRoleId() == 6) {
            $data['progress'] = Orders::where('user_id', auth()->user()->id)->whereIn('status', [1,3,4,6,7,8,9])->get();
            $data['done'] = Orders::where('user_id', auth()->user()->id)->where('status', 5)->get();
        }else {
            $data['progress'] = Orders::whereIn('status', [1,3,4,6,7,8,9])->get();
            $data['done'] = Orders::where('status', 5)->get();
        }
        return view('backend.dashboard.dashboard', compact('data'));
    }

    public function total_done()
    {
        if(getRoleId() == 6) {
            $orders = Orders::select('id', 'created_at', 'status')
                    ->where('user_id', auth()->user()->id)
                    ->where('status', 5)
                    ->get()
                    ->groupBy(function($date) {
                        return \Carbon\Carbon::parse($date->created_at)->format('m');
                    });
        }else {
            $orders = Orders::select('id', 'created_at', 'status')
                    ->where('status', 5)
                    ->get()
                    ->groupBy(function($date) {
                        return \Carbon\Carbon::parse($date->created_at)->format('m');
                    });
        }

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
        if(getRoleId() == 6) {
            $orders = Orders::select('id', 'created_at', 'status')
            ->whereNotIn('status', [2,5])
            ->where('user_id', auth()->user()->id)
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('m');
            });
        }else {
            $orders = Orders::select('id', 'created_at', 'status')
            ->whereNotIn('status', [2,5])
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('m');
            });
        }
                
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
