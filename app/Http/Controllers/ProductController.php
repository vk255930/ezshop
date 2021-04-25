<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class ProductController extends Controller{
    // 取得產品列表
    public function getProductView(Request $request){
        // 取得傳入參數
        $uuid = $request->query('uuid', '');
        if(strlen(trim($uuid))>0){
            $get_product    = Product::getProduct(array('uuid' => $uuid), 'list');
        }
        $product            = isset($get_product[0]) && is_array($get_product[0])? $get_product[0]: array();
        $product['amount']  = isset($product['amount'])? (int)$product['amount']: '';
        $type_id            = isset($product['product_type_id'])? $product['product_type_id']: '';
        $products           = Product::getProduct(array('product_type_id' => $type_id, 'nuuid' => $uuid), 'other');
        $data['list_active']    = 'active';
        $data['products']       = $products;
        $data['product']        = $product;
        return view('product', $data);
    }
}
