<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/fronted/favicon.png') }}">

    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
    @include('fronted.css')
</head>

<body>
    @include('fronted.header')
    <div class="content-wrapper">
        <div class="content-header">
            @yield('content')
        </div>
    </div>
    <div>
        @include('fronted.footer')
    </div>
    @include('fronted.js')
</body>

</html>
