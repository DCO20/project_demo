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

            @yield('content_header')

            <section class="content">

                @yield('content')

        </div>


        @include('dashboard.layout.footer')

    </div>


    @include('dashboard.layout.footer-scripts')

    @yield('footer-extras')

</body>

</html>
