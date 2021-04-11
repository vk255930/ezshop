<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class IndexController extends Controller{
    public function getIndexView(){
        $product_types          = $product_types = ProductType::getProductType(array(), 'tag');
        $data['product_types']  = $product_types;
        return view('index', $data);
    }
}
