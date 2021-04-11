<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class ListController extends Controller{
    // 取得產品列表
    public function getListView(Request $request){
        // 取得排序列表
        $sort_list          = Controller::getListSort();
        // 取得傳入參數
        $keyword            = $request->query('keyword');
        $product_type_uuid  = $request->query('type');
        $sort_by            = $request->query('order');
        $sort_by            = isset($sort_list[$sort_by])? $sort_by: 'name_asc';
        $sort_list[$sort_by]['is_select'] = 'selected';
        // 判斷是否有類別uuid，沒有則預設查詢第一筆類型
        $search = array();
        if(!is_null($product_type_uuid)){
            $search['uuid'] = $product_type_uuid;
        }
        // 取得所有類別
        $product_types  = $this->getProductType('list', 'uuid', true);
        // 取得目前所屬類別
        $select_type    = isset($product_types[$product_type_uuid]) && is_array($product_types[$product_type_uuid])? $product_types[$product_type_uuid]: array();
        // 若uuid不存在，則自動帶入第一種類別
        $select_type    = empty($select_type) && isset($product_types[array_key_first($product_types)])? $product_types[array_key_first($product_types)]: $select_type;
        $type_id        = isset($select_type['id']) && (int)$select_type['id']>0? $select_type['id']: 0;
        $type_uuid      = isset($select_type['uuid']) && (strlen(trim($select_type['uuid'])))>0? $select_type['uuid']: '';
        $type_name      = isset($select_type['name']) && (strlen(trim($select_type['name'])))>0? $select_type['name']: '';
        // 設定目前所選類別
        $product_types[$type_uuid]['active'] = 'active';
        // 取得類別下的產品
        $sort           = $sort_list[$sort_by];
        $products       = Product::getProduct(array('product_type_id' => $type_id, 'keyword' => $keyword), 'list', $sort);
        // 整理要印出的資料
        $data['list_active']    = 'active';
        $data['keyword']        = $keyword;
        $data['type_uuid']      = $type_uuid;
        $data['type_name']      = $type_name;
        $data['product_types']  = $product_types;
        $data['products']       = $products;
        $data['sorts']          = $sort_list;
        return view('list', $data);
    } 
    // 取得產品分類
    private function getProductType($type='tag', $key_by='id', $has_count=false){
        $product_types = ProductType::getProductType(array(), $type, $key_by);
        if($has_count){
            $data = array();
            // 取得各類別的商品數
            $product_count = Product::getProduct(array(), 'count');
            foreach($product_types as $product_type){
                $product_type['product_count'] = isset($product_count[$product_type['id']]) && (int)$product_count[$product_type['id']]>0? $product_count[$product_type['id']]: 0;
                $data[$product_type['uuid']] = $product_type;
            }
            $product_types = $data;
        }
        return $product_types;
    }
}
