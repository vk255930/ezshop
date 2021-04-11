<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function getListSort($sort_by='name_asc'){
        $sort = array(
            'name_asc' => array(
                'name'      => '產品名稱A-Z',
                'key'       => 'name',
                'type'      => 'asc',
                'is_select' => '',
            ),
            'name_desc' => array(
                'name'      => '產品名稱Z-A',
                'key'       => 'name',
                'type'      => 'desc',
                'is_select' => '',
            ),
            'price_desc' => array(
                'name'      => '價格由高至低',
                'key'       => 'amount',
                'type'      => 'desc',
                'is_select' => '',
            ),
            'price_asc' => array(
                'name'      => '價格由低至高',
                'key'       => 'amount',
                'type'      => 'asc',
                'is_select' => '',
            )
        );
        return $sort;
    }
}
