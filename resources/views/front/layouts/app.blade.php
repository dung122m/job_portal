<!DOCTYPE html>
<html class="no-js" lang="en_AU"/>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Career Viet | Find Best Jobs</title>
    <meta name="description" content=""/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="pinterest" content="nopin"/>
{{--    <meta name="csrf-token" content="{{ csrf_token() }}"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}"/>
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
</head>
<style>

    .text-truncate {
        overflow: hidden;        /* Ẩn phần nội dung thừa */
        white-space: nowrap;     /* Không xuống dòng */
        text-overflow: ellipsis; /* Thêm dấu ba chấm (...) */
    }
</style>
<body data-instant-intensity="mousedown">
@include('front.layouts.header')
@yield('main')

@include('front.layouts.modal')

@include('front.layouts.footer')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('assets/js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('assets/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
{{--<script>--}}
{{--    $.ajaxSetup({--}}
{{--        headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
@yield('scripts')
</body>
</html>
