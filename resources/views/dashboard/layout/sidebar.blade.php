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
                    <a href="{{ route('client.index') }}" class="nav-link {{ Ekko::isActiveRoute('client*') }}">
                        <i class="fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('purveyor.index') }}" class="nav-link {{ Ekko::isActiveRoute('purveyor*') }}">
                        <i class="fas fa-users"></i>
                        <p>Fornecedores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link {{ Ekko::isActiveRoute('product*') }}">
                        <i class="fas fa-boxes"></i>
                        <p>Produtos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link {{ Ekko::isActiveRoute('category*') }}">
                        <i class="fas fa-folder-open"></i>
                        <p>Categorias</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('suit.index') }}" class="nav-link {{ Ekko::isActiveRoute('suit*') }}">
                        <i class="fas fa-check"></i>
                        <p>Pedidos</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
