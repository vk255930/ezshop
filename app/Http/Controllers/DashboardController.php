<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;         // 產品相關函式
use App\Models\ProductType;     // 產品類型相關函式

class DashboardController extends Controller{
    public function getDashboardView(Request $request){
        $total_count    = Product::getProduct(array(), 'count');
        $now_page       = $request->input('page', 1);
        $page_offset    = Controller::getPageOffset($now_page);
        $product_arr    = Product::getProduct(array(), 'dashboard', array(), $page_offset);
        $products       = array();
        $tmp_type       = array();
        $pages          = Controller::getPageInfo($total_count, $now_page);
        foreach($product_arr as $product){
            $type_id = isset($product['product_type_id']) && (int)$product['product_type_id']>0? $product['product_type_id']: 0;
            if(!isset($tmp_type[$type_id])){
                $product_type       = ProductType::getProductType(array('id' => $type_id), 'tag');
                $tmp_type[$type_id] = isset($product_type[$type_id]['name'])? $product_type[$type_id]['name']: '';
            }
            $product['type_name']   = $tmp_type[$type_id];
            $products[]             = $product;
        }
        $data['dashboard_active']   = 'active';
        $data['products']           = $products;
        $data['next']               = $pages['next'];
        $data['prev']               = $pages['prev'];
        $data['pages']              = $pages['pages'];
        return view('dashboard', $data);
    }
}
