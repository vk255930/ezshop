<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ezshop</title>
    <link href="{{ asset('/images/favicon.png') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/css/bootstrap-slider.css') }}">
    <link href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/fancybox/jquery.fancybox.pack.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
</head>
<body class="body-wrapper">
@include('layout.header')
@yield('content')
@include('layout.footer')
</body>
<html>