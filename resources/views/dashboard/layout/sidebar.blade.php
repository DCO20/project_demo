<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light ml-5"><strong>Demons</strong>trativo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('country.index') }}" class="nav-link {{ Ekko::isActiveRoute('country*') }}">
                        <i class="fas fa-globe-americas"></i>
                        <p>Paises</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('location.index') }}" class="nav-link {{ Ekko::isActiveRoute('location*') }}">
                        <i class="fas fa-location-arrow"></i>
                        <p>Localização</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('state.index') }}" class="nav-link {{ Ekko::isActiveRoute('state*') }}">
                        <i class="fab fa-usps"></i>
                        <p>Estados</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
