<!DOCTYPE html>
<html lang="pt-br">

<head>

    @include('dashboard.layout.header-scripts')

    @yield('header-extras')

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        @include('dashboard.layout.header')

        @include('dashboard.layout.sidebar')


        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="card-body">
                @yield('content')
            </div>

            <div class="card-footer"></div>

        </div>


        @include('dashboard.layout.footer')

    </div>


    @include('dashboard.layout.footer-scripts')


</body>

</html>
