<nav class="navbar navbar-expand-lg bg-white shadow-sm border-bottom px-4 py-3">

    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold"
           href="{{ route('dashboard') }}"
           style="font-size: 28px; color: #111827;">

            🛠️ FerreSoft

        </a>

        <!-- MOBILE -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- CONTENT -->
        <div class="collapse navbar-collapse"
             id="navbarContent">

            <!-- LEFT -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- DASHBOARD -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('dashboard') }}">

                        📊 Dashboard

                    </a>

                </li>

                <!-- PRODUCTOS -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('products.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('products.index') }}">

                        📦 Productos

                    </a>

                </li>

                <!-- CLIENTES -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('clients.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('clients.index') }}">

                        👥 Clientes

                    </a>

                </li>

                <!-- PROVEEDORES -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('suppliers.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('suppliers.index') }}">

                        🚚 Proveedores

                    </a>

                </li>

                <!-- FACTURACIÓN -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('sales.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('sales.index') }}">

                        💰 Facturación

                    </a>

                </li>

                <!-- REPORTES -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('reports.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('reports.index') }}">

                        📈 Reportes

                    </a>

                </li>

                <!-- KARDEX -->
                <li class="nav-item">

                    <a class="nav-link
                        {{ request()->routeIs('kardex.*') ? 'active fw-bold text-primary' : '' }}"
                       href="{{ route('kardex.index') }}">

                        📋 Kardex

                    </a>

                </li>

                <!-- LOGS SOLO ADMIN -->
                @auth

                    @if(Auth::user()->role === 'admin')

                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->routeIs('logs.*') ? 'active fw-bold text-primary' : '' }}"
                               href="{{ route('logs.index') }}">

                                📜 Logs

                            </a>

                        </li>

                    @endif

                @endauth

                <!-- ADMINISTRACIÓN -->
                @auth

                    @if(Auth::user()->role === 'admin')

                        <!-- USUARIOS -->
                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->routeIs('users.*') ? 'active fw-bold text-primary' : '' }}"
                               href="{{ route('users.index') }}">

                                👤 Usuarios

                            </a>

                        </li>

                        <!-- CREAR EMPLEADO -->
                        <li class="nav-item">

                            <a class="nav-link
                                {{ request()->routeIs('users.create') ? 'active fw-bold text-primary' : '' }}"
                               href="{{ route('users.create') }}">

                                ➕ Crear Empleado

                            </a>

                        </li>

                    @endif

                @endauth

            </ul>

            <!-- RIGHT -->
            <div class="d-flex align-items-center gap-3">

                @auth

                    <!-- USER -->
                    <div class="text-end">

                        <div class="fw-bold">

                            {{ Auth::user()->name }}

                        </div>

                        <small class="text-muted text-uppercase">

                            {{ Auth::user()->role }}

                        </small>

                    </div>

                    <!-- DROPDOWN -->
                    <div class="dropdown">

                        <button class="btn btn-light border dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">

                            ⚙️

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                            <li>

                                <a class="dropdown-item"
                                   href="{{ route('profile.edit') }}">

                                    👤 Perfil

                                </a>

                            </li>

                            <li>

                                <hr class="dropdown-divider">

                            </li>

                            <li>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item text-danger">

                                        🚪 Cerrar sesión

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                @endauth

            </div>

        </div>

    </div>

</nav>