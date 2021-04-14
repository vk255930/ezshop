<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;         // 產品相關函式

class DashboardController extends Controller{
    public function getDashboardView(Request $request){
        $data['dashboard_active']    = 'active';
        return view('dashboard', $data);
    }
}
