<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class OrderController extends Controller{
    // 取得產品列表
    public function getOrderView(Request $request){
        // 取得傳入參數
        $uuid = $request->query('uuid', '');
        $get_product            = Product::getProduct(array('uuid' => $uuid), 'list');
        $product                = isset($get_product[0]) && is_array($get_product[0])? $get_product[0]: array();
        $product['amount']      = isset($product['amount'])? (int)$product['amount']: '';
        $data['uuid']           = $uuid;
        $data['product']        = $product;
        return view('order', $data);
    }
}
