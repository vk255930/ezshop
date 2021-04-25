@extends('layout.master')
@section('content')
<section class="dashboard section">
   <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                <div class="sidebar">
                    <div class="widget user-dashboard-menu">
                        <ul>
                            <li class="active">
                                <a href="dashboard-my-ads.html">
                                    <i class="fa fa-user"></i> 我的拍賣
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>圖片</th>
                                <th>標題</th>
                                <th class="text-center">類別</th>
                                <th class="text-center">動作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="product-thumb">
                                    <img width="80px" height="auto" src="{{  asset($product['img_path']) }}" alt="image description">
                                </td>
                                <td class="product-details">
                                    <h3 class="title">{{ $product['name'] }}</h3> 
                                </td>
                                <td class="product-category"><span class="categories">{{ $product['type_name'] }}</span></td>
                                <td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a class="edit" data-toggle="tooltip" data-placement="top" onclick="changeForm('post?product={{ $product['uuid'] }}');">
                                                <i class="fa fa-pencil"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="delete" data-toggle="tooltip" data-placement="top" onclick="">
                                                <i class="fa fa-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                <!-- pagination -->
                <div class="pagination justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" onclick="changeForm('dashboard?page={{ $prev }}')" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            @foreach($pages as $page)
                            <li class="page-item {{ $page['active'] }}">
                                <a class="page-link" onclick="changeForm('dashboard?page={{ $page['page'] }}')">{{ $page['page'] }}</a>
                            </li>
                            @endforeach 
                            <li class="page-item">
                                <a class="page-link" onclick="changeForm('dashboard?page={{ $next }}')" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- pagination -->
            </div>
        </div>
      <!-- Row End -->
   </div>
   <!-- Container End -->
</section>
@endsection