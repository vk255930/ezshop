@extends('layout.master')
@section('content')
@include('layout.search')
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="category-sidebar">
                    <div class="widget category-list">
                        <h4 class="widget-header">類別</h4>
                        <ul class="category-list">
                            @foreach($product_types as $product_type)
                            <li>
                                <a href="/list/{{ $product_type['uuid'] }}">{{ $product_type['name'] }} 
                                    <span>{{ $product_type['product_count'] }}</span>
                                </a>
                            </li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="category-search-filter">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>排序</strong>
                            <select id="sort" onchange="changeForm('/list/{{ $product_type_uuid }}/'+$('#sort').val());">
                                @foreach($sorts as $sort_code => $sort)
                                <option value="{{ $sort_code }}" {{ $sort['is_select'] }}>{{ $sort['name'] }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div>
                <div class="product-grid-list">
                    <div class="row mt-30">
                        @foreach($products as $product)
                        <div class="col-sm-12 col-lg-4 col-md-6">
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <div class="price">${{ number_format($product['amount']) }}</div>
                                        <a href="single.html">
                                            <img class="card-img-top img-fluid" src="{{ $product['img_path'] }}" alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="single.html">{{ $product['name'] }}</a>
                                        </h4>
                                        <p class="card-text">{!! nl2br($product['description']) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                </div>
                <div class="pagination justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
function search(){

}
</script>