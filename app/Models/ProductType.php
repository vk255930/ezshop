<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_type';
    public static function getProductType($cond=array(), $type='list'){
        switch ($type) {
            case 'tag':
                $column_arr = array('uuid', 'name');
                break;
            case 'list':
                $column_arr = array('id', 'uuid', 'name');
                break;
            case 'type_list':
            case 'default_type_list':
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
            case 'default_type_list':
                $product_type = ProductType::select($column_arr)->where($search)->limit(1)->orderBy('id', 'asc')->get()->toArray();
                break;
            default:
                $product_type = ProductType::select($column_arr)->where($search)->orderBy('id', 'asc')->get()->toArray();
                break;
        }
        return $product_type;
    }
}
