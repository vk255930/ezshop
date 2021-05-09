@extends('layout.master')
@section('content')
<section class="section">
    <div class="container">
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
                <form action="#">
                    <fieldset class="p-4 product-details">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h1 class="tab-title">${!! number_format($product['amount']) !!}</h1>
                                <div>
                                    <input type="radio" name="send_type" value="1" id="send_type_1" checked>
                                    <label for="send_type_1" class="py-2">貨到付款</label>
                                </div>
                                <div>
                                    <input type="radio" name="send_type" value="2" id="send_type_2">
                                    <label for="send_type_2" class="py-2">轉帳</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12 py-2">
                                    <input type="text" id="address" name="address" placeholder="郵寄地址" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="btn-grounp">
                            <button type="submit" class="btn btn-primary mt-2 float-right">結帳</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
</script>
@endsection