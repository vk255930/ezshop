@extends('layout.master')
@section('content')
<section class="bg-gray py-5">
    <div class="container">
        <div id="error_msg_block" style="display: none" class="alert alert-danger" role="alert"></div>
        <form id="product_form">
            {{ csrf_field() }}
            <fieldset class="border border-gary p-4 mb-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>新增商品</h3>
                    </div>
                    <div class="col-lg-6">
                        <h6 id="product_title" class="font-weight-bold pt-4 pb-1">標題</h6>
                        <input type="text" id="product" name="product" class="border w-100 p-2 bg-white text-capitalize" placeholder="請輸入商品標題">
                        <h6 id="desc_title" class="font-weight-bold pt-4 pb-1">備註</h6>
                        <textarea class="border p-3 w-100" id="desc" name="desc" rows="7" placeholder="備註"></textarea>
                    </div>
                    <div class="col-lg-6">
                        <h6 id="type_title" class="font-weight-bold pt-4 pb-1">類別</h6>
                        <select id="type" name="type" class="w-100">
                            @foreach($product_types as $product_type)
                            <option value="{{ $product_type['uuid'] }}">{{ $product_type['name'] }}</option>
                            @endforeach 
                        </select>
                        <div class="price">
                            <h6 class="font-weight-bold pt-4 pb-1" id="price_title">價格</h6>
                            <div class="row px-3">
                                <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                    <input type="text" id="price" name="price" class="border-0 py-2 w-100" placeholder="請輸入價格">
                                </div>
                            </div>
                        </div>
                        <div class="choose-file text-center my-4 py-4 rounded">
                            <label for="file-upload">
                                <span class="d-block font-weight-bold text-dark">Drop files anywhere to upload</span>
                                <span class="d-block">or</span>
                                <span class="d-block btn bg-primary text-white my-3 select-files">Select files</span>
                                <span class="d-block">Maximum upload file size: 500 KB</span>
                                <input type="file" class="form-control-file d-none" id="file-upload" name="file">
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <button type="button" class="btn btn-primary d-block mt-2" onclick="saveProduct();">新增</button>
        </form>
    </div>
</section>
<script>
    // 儲存商品
    function saveProduct(){
        // 檢查必填
        var check_field = ['product', 'type', 'price'];
        if(!checkInput(check_field)){
            return;
        }
        sendForm('saveProduct', 'product_form');
    }
</script>
@endsection