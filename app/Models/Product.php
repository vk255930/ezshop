<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public static function getProduct($cond=array(), $type='list'){
        switch ($type) {
            case 'tag':
                $column_arr = array('name', 'uuid');
                break;
            case 'product':
            case 'default_product':
                $column_arr = array('id', 'name');
                break;
            default:
                $column_arr = array();
                break;
        }
        $order_by = array();
        $cond['is_delete'] = 0;
        $search = array();
        if (is_array($cond)) {
            foreach ($cond as $cond_key => $cond_val) {
                switch ($cond_key) {
                    default:
                        $search[] = array($cond_key, '=', $cond_val);
                        break;
                }
            }
        }
        switch($type){
            case 'product_type_count':
                $tmp_product_arr    = Product::select('product_type_id', Product::raw('count(id) as count'))->groupBy('product_type_id')->get()->toArray();
                $product            = array();
                foreach($tmp_product_arr as $tmp_product){
                    $product_type_id    = isset($tmp_product['product_type_id']) && (int)$tmp_product['product_type_id']>0? $tmp_product['product_type_id']: 0;
                    $product_count      = isset($tmp_product['count']) && (int)$tmp_product['count']>0? $tmp_product['count']: 0;
                    $product[$product_type_id] = $product_count;
                }
                break;
            case 'default_product':
                $product = Product::select($column_arr)->where($search)->limit(1)->orderBy('id', 'asc')->get()->toArray();
                break;
            default:
                $product = Product::select($column_arr)->where($search)->orderBy('id', 'asc')->get()->toArray();
                break;
        }
        return $product;
    }
}
