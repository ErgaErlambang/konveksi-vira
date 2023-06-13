<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Orders::latest()->get();
        return view('backend.history.index', compact('histories'));
    }
}
