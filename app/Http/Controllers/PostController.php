<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式

class PostController extends Controller{
    public function getPostView(){
        $product_types          = $product_types = ProductType::getProductType(array(), 'tag');
        $data['product_types']  = $product_types;
        return view('post', $data);
    }
}
