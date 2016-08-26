<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('news.news_title') }}</title>
    {!! Html::style('/bower/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css') !!}
    {!! Html::style('/css/custom.css') !!}
    {!! Html::style('/bower/sweetalert/dist/sweetalert.css') !!}
    {!! Html::style('/css/comment.css') !!}
    {!! Html::style('/css/app.css') !!}
    <meta name="csrf_token" content="{{ csrf_token() }}">
    @yield('style')
</head>

<body>
    @include('news.partials.header')
    @yield('content')

    @include('layout.scripts')
    {!! Html::script('/bower/masonry/dist/masonry.pkgd.min.js') !!}
    {!! Html::script('/bower/sweetalert/dist/sweetalert.min.js') !!}
    {!! Html::script('/js/comment_facebook.js') !!}
    {!! Html::script('/js/like_share_button.js') !!}
    {!! Html::script('/js/comment.js') !!}
    @include('sweet::alert')
    @yield('script')
</body>
</html>
