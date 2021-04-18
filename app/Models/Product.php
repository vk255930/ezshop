<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    protected $table = 'product';
    protected $fillable = [
        'name',
        'product_type_id',
        'amount',
        'img_path',
        'description',
        'create_by',
        'modify_by'
    ];
    protected $access = array(
        'name',
        'product_type_id',
        'amount',
        'img_path',
        'description',
        'create_by',
        'modify_by'
    );
    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
    protected function getAccessField(){
        return $this->access;
    }
    public static function getProduct($cond=array(), $type='list', $order=array(), $page_offset=0, $limit=5){
        switch ($type) {
            case 'id':
                $column_arr = array('id');
                break;
            case 'dashboard':
            case 'list':
                $column_arr = array('uuid', 'product_type_id', 'name', 'amount', 'img_path', 'description');
                break;
            case 'tag':
                $column_arr = array('uuid', 'name');
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
                    case 'keyword':
                        $search[] = array('name', 'like', '%'.$cond_val.'%');
                        break;
                    default:
                        $search[] = array($cond_key, '=', $cond_val);
                        break;
                }
            }
        }
        $search = array_filter($search);
        switch($type){
            case 'id':
                $product = Product::select($column_arr)->where($search)->orderBy('id', 'asc')->value('id');
                break;
            case 'count':
                $product = Product::select('id')->get()->count();
                break;
            case 'type_count':
                $tmp_product_arr    = Product::select('product_type_id', Product::raw('count(id) as count'))->groupBy('product_type_id')->get()->toArray();
                $product            = array();
                foreach($tmp_product_arr as $tmp_product){
                    $product_type_id    = isset($tmp_product['product_type_id']) && (int)$tmp_product['product_type_id']>0? $tmp_product['product_type_id']: 0;
                    $product_count      = isset($tmp_product['count']) && (int)$tmp_product['count']>0? $tmp_product['count']: 0;
                    $product[$product_type_id] = $product_count;
                }
                break;
            case 'dashboard':
                $order_key  = isset($order['key'])? $order['key']: 'name';
                $order_type = isset($order['type']) && $order['type'] == 'asc'? 'asc': 'desc';
                $product    = Product::select($column_arr)->where($search)->orderBy($order_key, $order_type)->offset($page_offset)->limit($limit)->get()->toArray();
                break;
            default:
                $order_key  = isset($order['key'])? $order['key']: 'name';
                $order_type = isset($order['type']) && $order['type'] == 'asc'? 'asc': 'desc';
                $product    = Product::select($column_arr)->where($search)->orderBy($order_key, $order_type)->get()->toArray();
                break;
        }
        return $product;
    }
}
