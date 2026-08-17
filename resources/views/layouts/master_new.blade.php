<!DOCTYPE html>
<html>
<head>
<title>Awzonex - @yield('title')</title>
@include('partial.head_new')
</head>
<body>

<!-- header elements -->
@include('partial.header_new')
<!-- header elements -->
@yield('content')
@include('partial.footer')
@include('partial.scripts')
</body>
</html>
