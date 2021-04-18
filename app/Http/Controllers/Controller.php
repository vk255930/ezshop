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
    // 取得查詢起始筆數
    function getPageOffset($now_page=1, $page_count=5){
        $page_offset  = ($now_page -1) * $page_count;
        return $page_offset;
    }
    // 取得頁籤
    function getPageInfo($total_count=0, $now_page=1, $show_page=5, $page_count=5){
        $total_page = ceil($total_count/$page_count);
        $end_page   = $show_page * ceil($now_page/$show_page);
        $end_page   = ($end_page > $total_page)? $total_page: $end_page;
        $start_page = ($end_page - ($show_page - 1)>0)? $end_page - ($show_page - 1): 1;
        $pages      = array();
        for($start=$start_page; $start<=$end_page; $start++){
            $active     = ($now_page == $start)? 'active': '';
            $pages[]    = array('page' => $start, 'active' => $active);
        }
        $next = $now_page+1;
        $prev = ($now_page-1)>0? $now_page-1: 1;
        return array(
            'next'  => $next,
            'prev'  => $prev,
            'pages' => $pages
        );
    }
}
