<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式

class ProductTypeController extends Controller{

    public function getProductType(){
        $product_types          = ProductType::select('name', 'uuid')->limit(5)->orderBy('id', 'asc')->get();
        $data['product_types']  = $product_types;
        return view('index', $data);
    }
}
