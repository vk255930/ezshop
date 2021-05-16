@extends('layout.master')
@section('content')
<section class="section">
    <div class="container">
        <div id="error_msg_block" style="display: none" class="alert alert-danger" role="alert"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="product-details">
                    <h1 class="product-title">{{ $product['name'] ?? '' }}</h1>
                    <div class="">
                        <div class="product-slider-item my-4" data-image="{{  asset($product['img_path']) }}">
                            <img class="img-fluid w-100" src="{{  asset($product['img_path']) }}" alt="product-img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form id="order_form">
                    {{ csrf_field() }}
                    <input type="hidden" id="uuid" name="uuid" value="{{ $uuid }}">
                    <fieldset class="p-4 product-details">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4 py-2">
                                    <label for="name" class="py-2">收件人姓名</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="col-lg-12 py-2">
                                    <label for="address" class="py-2">收件地址</label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="btn-grounp">
                            <button type="button" class="btn btn-primary mt-2 float-right" onclick="pay();">付款</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div id="ecpay"></div>
</section>
<script>
    // 儲存商品
    function pay(){
        sendForm('pay', 'order_form');
    }
</script>
@endsection