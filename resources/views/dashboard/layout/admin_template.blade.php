
<!DOCTYPE html>
<html lang="pt-br">
<head>
  
  @include('dashboard.layout.header-scripts')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  @include('dashboard.layout.navbar')

  @include('dashboard.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  @yield('content')

  </div>
  <!-- /.content-wrapper -->

  @include('dashboard.layout.footer')

</div>
<!-- ./wrapper -->

@include('dashboard.layout.footer-scripts')


</body>
</html>
