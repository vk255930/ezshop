@extends('layout.master')
@section('content')
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <!-- Left sidebar -->
            <div class="col-md-8">
                <div class="product-details">
                    <h1 class="product-title">{{ $product['name'] ?? '' }}</h1>
                    <div class="">
                        <div class="product-slider-item my-4" data-image="{{  asset($product['img_path']) }}">
                            <img class="img-fluid w-100" src="{{  asset($product['img_path']) }}" alt="product-img">
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h3 class="tab-title">商品說明</h3>
                                {{ $product['description'] ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="widget price text-center">
                        <h4>價格</h4>
                        <p>${!! number_format($product['amount']) !!}</p>
                    </div>
                    <div class="widget user text-center">
                        <ul class="list-inline mt-20">
                            <li class="list-inline-item">
                                <a href="javascript:changeForm('order?uuid={{ $product['uuid'] }}');" class="btn btn-contact d-inline-block  btn-primary px-lg-5 my-1 px-md-3">購買</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget disclaimer">
                        <h5 class="widget-header">其他商品</h5>
                        @foreach($products as $product)
                        <div>
                            <p>{{ $product['name'] }}</p>
                            <a onclick="changeForm('product?uuid={{ $product['uuid'] }}');">
                                <img class="rounded-circle img-fluid mb-5 px-5" src="{{  asset($product['img_path']) }}" alt="image description">
                            </a>
                        </div>
                        @endforeach 
                        <!-- <img class="rounded-circle img-fluid mb-5 px-5" src="images/user/user-thumb.jpg" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
</script>    
@endsection