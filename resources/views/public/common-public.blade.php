<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('header')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome.all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site wrapper -->
<div class="container-fluid">

    @include('layouts.messages')

    @yield('content')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/js/AdminLTE/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/AdminLTE/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/AdminLTE/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/js/AdminLTE/demo.js"></script>


</body>
</html>
