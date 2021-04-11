<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'product_type';
    public static function getProductType($cond=array(), $type='list', $key_by='id'){
        switch ($type) {
            case 'id':
                $column_arr = array('id');
                break;
            case 'tag':
                $column_arr = array('id', 'uuid', 'name');
                break;
            case 'list':
            case 'type_list':
            case 'default_type_list':
                $column_arr = array('id', 'uuid', 'name');
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
            case 'id':
                $product_type = ProductType::select($column_arr)->where($search)->orderBy('id', 'asc')->value('id');
                break;
            case 'default_type_list':
                $product_type = ProductType::select($column_arr)->where($search)->limit(1)->orderBy('id', 'asc')->get()->keyBy($key_by)->toArray();
                break;
            default:
                $product_type = ProductType::select($column_arr)->where($search)->orderBy('id', 'asc')->get()->keyBy($key_by)->toArray();
                break;
        }
        return $product_type;
    }
}
