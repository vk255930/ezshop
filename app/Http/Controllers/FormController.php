<?php

namespace App\Http\Controllers;

use Validator;
use Storage;
use Illuminate\Support\Str;
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
        $uuid       = isset($input['uuid']) && strlen(trim($input['uuid']))>0? $input['uuid']: '';
        // 判斷是否有uuid，若有則檢查產品是否存在
        if(strlen($uuid)>0){
            $product_id = Product::getProduct(array('uuid' => $uuid), 'id');
            if((int)$product_id == 0){
                $this->msg  = '查無此商品';
                $result     = $this->returnResult();
                return $result;
            }
        }
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
        // 儲存檔案
        if ($request->hasFile('file')) {
            if ($request->hasFile('file')) {
                $file_name  = Str::random(8). '.'.$request->file('file')->getClientOriginalExtension();
                Storage::put('/public/'.$file_name, $request->file('file')->get());
                $file_path  = '/storage/'.$file_name;
            }
            $data['img_path'] = $file_path;
        }
        $data['name']               = $input['product'];
        $data['product_type_id']    = $type_id;
        $data['amount']             = $input['price'];
        $data['description']        = $input['desc'];
        if(strlen($uuid)>0){
            $product = Product::where('uuid', '=', $uuid)->update($data);
        }else{
            $data['img_path']   = isset($data['img_path'])? $data['img_path']: '/images/products/default.jpg';
            $data['create_by']  = 0;
            $data['modify_by']  = 0;
            $product = Product::create($data);
        }
        $this->error    = false;
        $result         = $this->returnResult();
        $result['url']  = 'list?type='.$input['type'];
        return $result;
    }
}
