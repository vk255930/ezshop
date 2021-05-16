<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\ProductType; // 產品類型相關函式
use App\Models\Product;     // 產品相關函式
use Ecpay\Sdk\Factories\Factory;
use Ecpay\Sdk\Services\UrlService;
use Ecpay\Sdk\Exceptions\RtnException;

require __DIR__ . '/../../../vendor/autoload.php';

class PayController extends Controller{
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
    // 取得產品列表
    public function order(Request $request){
        $this->resetResult();
        try {
            $input      = $request->all();
            // 收件人相關資料
            $name       = isset($input['uuid']) && strlen(trim($input['uuid']))>0? $input['uuid']: '';
            $address    = isset($input['address']) && strlen(trim($input['address']))>0? $input['address']: '';
            // 取得產品資訊
            $uuid           = isset($input['uuid']) && strlen(trim($input['uuid']))>0? $input['uuid']: '';
            $get_product    = Product::getProduct(array('uuid' => $uuid), 'list');
            $product        = isset($get_product[0]) && is_array($get_product[0])? $get_product[0]: array();
            if(empty($product)){
                $this->msg  = '查無此商品';
                $result     = $this->returnResult();
                return $result;
            }
            $product_name   = isset($product['name'])? $product['name']: '';
            $amount         = isset($product['amount']) && (int)$product['amount']>0? (int)$product['amount']: 0;
            $factory        = new Factory;
            $hashKey        = '5294y06JbISpM5x9';
            $hashIv         = 'v77hoKGq4kWxNNIS';
            $autoSubmitFormService = $factory->createWithHash('AutoSubmitFormWithCmvService', $hashKey, $hashIv);
            $input = [
                'MerchantID'        => '2000132',
                'MerchantTradeNo'   => 'Test' . time(),
                'MerchantTradeDate' => date('Y/m/d H:i:s'),
                'PaymentType'       => 'aio',
                'TotalAmount'       => $amount,
                'TradeDesc'         => UrlService::ecpayUrlEncode('交易描述範例'),
                'ItemName'          => $product_name,
                'ReturnURL'         => 'https://www.ecpay.com.tw/example/receive',
                'ChoosePayment'     => 'ALL',
                'EncryptType'       => 1,
            ];
            $action = 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';
            $this->error    = false;
            $result         = $this->returnResult();
            $result['data'] = $autoSubmitFormService->generate($input, $action);
            return $result;
        } catch (RtnException $e) {
            $result         = $this->returnResult();
            $result['msg']  = '(' . $e->getCode() . ')' . $e->getMessage() . PHP_EOL;
            return $result;
        }
    }
}
