@extends('layout.master')
@section('content')
<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center mx-auto">
                <div class="404-img">
                    <img src="{{ asset('/images/404/404.png') }}" class="img-fluid" alt="">
                </div>
                <div class="404-content">
                    <h1 class="display-1 pt-1 pb-2">Oops</h1>
                    <p class="px-3 pb-2 text-dark">Something went wrong,we can't find the page that you are looking for :(But there is a lot more for you!</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection