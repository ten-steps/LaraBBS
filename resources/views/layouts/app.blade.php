<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title','LaraBBS') - {{setting('site_name','Laravel 进阶教程')}}</title>
    <meta name="description" content="@yield('descrption',setting('description','LaraBBs 爱好社区'))">
    <meta name="keyword" content="@yield('keyword',setting('keyword','LaraBBS,社区,论坛,开发者社区'))">
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
    @yield('styles')
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @include('shared._message')
        @yield('content')
    </div>
    @include('layouts._footer')
</div>
@if(app()->isLocal())
    @include('sudosu::user-selector')
@endif
<script src="{{mix('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>
