<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class PostController extends Controller{
    public function getPostView(Request $request){
        // 取得傳入參數
        $uuid       = $request->query('product', '');
        if(strlen(trim($uuid))>0){
            $get_product    = Product::getProduct(array('uuid' => $uuid), 'list');
        }
        $product            = isset($get_product[0]) && is_array($get_product[0])? $get_product[0]: array();
        $product['amount']  = isset($product['amount'])? (int)$product['amount']: '';
        $type_id            = isset($product['product_type_id'])? $product['product_type_id']: '';
        $product_types      = $product_types = ProductType::getProductType(array(), 'tag');
        if(isset($product_types[$type_id])){
            $product_types[$type_id]['selected'] = 'selected';
        }
        $data['dashboard_active']   = 'active';
        $data['product_types']      = $product_types;
        $data['product']            = $product;
        return view('post', $data);
    }
}
