<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
        $sort[$sort_by]['is_select'] = 'selected';
        return $sort;
    }
}
