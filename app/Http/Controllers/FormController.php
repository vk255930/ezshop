<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\ProductType;             // 產品類型相關函式
use App\Models\Product;                 // 產品相關函式
use App\Http\Requests\ProductRequest;   // 產品驗證欄位

class FormController extends Controller{
    private function resetResult(){
        $this->error    = true;
        $this->msg      = '';
    }
    private function returnResult(){
        return array(
            'error'     => $this->error,
            'msg'       => $this->msg
        );
    }
    public function saveProduct(Request $request){
        $this->resetResult();
        $input      = $request->all();
        $check      = new ProductRequest();
        $rules      = $check->rules();
        $validator  = Validator::make($input, $rules);
        if(!$validator->passes()){
            $this->msg  = '資料格式錯誤'.$validator->errors();
            $result     = $this->returnResult();
            return $result;
        }
        $get_type_id    = ProductType::getProductType(array('uuid' => $input['type']), 'id');
        $type_id        = (int)$get_type_id>0? $get_type_id: 0;
        if((int)$type_id == 0){
            $this->msg  = '不存在的類別';
            $result     = $this->returnResult();
            return $result;
        }
        $data = array();
        $data['name']               = $input['product'];
        $data['product_type_id']    = $type_id;
        $data['amount']             = $input['price'];
        $data['img_path']           = '/images/products/default.jpg';
        $data['description']        = $input['desc'];
        $data['create_by']          = 0;
        $data['modify_by']          = 0;
        $product        = Product::create($data);
        $this->error    = false;
        $result         = $this->returnResult();
        $result['url']  = 'list?type='.$input['type'];
        return $result;
    }
}
