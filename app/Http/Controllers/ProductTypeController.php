<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class ProductTypeController extends Controller{
    public function setIndex(){
        $product_types          = $this->getProductType();
        $data['product_types']  = $product_types;
        return view('index', $data);
    }
    // 取得產品列表
    public function getProductList($product_type_uuid=null){
        // 判斷是否有類別uuid，沒有則預設查詢第一筆類型
        $search_type    = is_null($product_type_uuid)? 'default_type_list': 'type_list';
        $search         = array();
        if(!is_null($product_type_uuid)){
            $search['uuid'] = $product_type_uuid;
        }
        // 取得類別名稱及ID
        $get_product_type   = ProductType::getProductType($search, $search_type);
        $product_type       = isset($get_product_type[0]) && is_array($get_product_type[0])? $get_product_type[0]: array();
        $type_id            = isset($product_type['id']) && (int)$product_type['id']>0? $product_type['id']: 0;
        $type_name          = isset($product_type['name']) && (strlen(trim($product_type['name'])))>0? $product_type['name']: '';
        // 判斷是否存在此類別
        if((int)$type_id == 0){
            return view('404');
        }
        $product_types          = $this->getProductType('list', true);                                  // 類別資料
        $products               = Product::getProduct(array('product_type_id' => $type_id), 'list');    // 產品資料
        // 取得類別列表資料
        $data['product_types']  = $product_types;
        $data['products']       = $products;
        return view('list', $data);
    }
    // 取得產品分類
    private function getProductType($type='tag', $has_count=false){
        $product_types = ProductType::getProductType(array(), $type);
        if($has_count){
            $data = array();
            // 取得各類別的商品數
            $product_count = Product::getProduct(array(), 'product_type_count');
            foreach($product_types as $product_type){
                $product_type['product_count'] = isset($product_count[$product_type['id']]) && (int)$product_count[$product_type['id']]>0? $product_count[$product_type['id']]: 0;
                $data[] = $product_type;
            }
            $product_types = $data;
        }
        return $product_types;
    }
    // 取得產品
    private function getProduct($type='list'){
        $product_count = Product::getProduct(array(), 'count');
        return $product_count;
    }
}
