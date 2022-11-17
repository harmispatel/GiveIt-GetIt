<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> @yield('title')</title>
  @include('common.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('common.header')
  
  @include('common.sidebar')
  

  <div class="wrapper">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>


  <div> 
    @include('common.footer')
  </div>
  
  
  @include('common.js')
</body>
</html>
