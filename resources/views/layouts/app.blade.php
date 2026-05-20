<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FerreSoft ERP</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- VITE -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>

        /*
        |--------------------------------------------------------------------------
        | VARIABLES
        |--------------------------------------------------------------------------
        */

        :root{

            --bg-main:#f4f6f9;
            --bg-card:#ffffff;
            --bg-sidebar:#111827;

            --text-main:#111827;
            --text-muted:#6b7280;

            --border-color:#e5e7eb;

        }

        /*
        |--------------------------------------------------------------------------
        | DARK MODE
        |--------------------------------------------------------------------------
        */

        body.dark-mode{

            --bg-main:#0f172a;
            --bg-card:#1e293b;
            --bg-sidebar:#020617;

            --text-main:#f8fafc;
            --text-muted:#cbd5e1;

            --border-color:#334155;

        }

        /*
        |--------------------------------------------------------------------------
        | BODY
        |--------------------------------------------------------------------------
        */

        body{

            background:var(--bg-main);

            color:var(--text-main);

            overflow-x:hidden;

            transition:.3s ease;

        }

        /*
        |--------------------------------------------------------------------------
        | LOADER
        |--------------------------------------------------------------------------
        */

        #loader{

            position:fixed;

            inset:0;

            background:#fff;

            z-index:9999;

            display:flex;

            align-items:center;
            justify-content:center;

        }

        body.dark-mode #loader{

            background:#0f172a;

        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

        .sidebar{

            width:260px;

            min-height:100vh;

            background:var(--bg-sidebar);

            position:fixed;

            top:0;
            left:0;

            padding:25px 20px;

            z-index:1000;

            overflow-y:auto;

            transition:.3s ease;

        }

        .sidebar-logo{

            text-align:center;

            margin-bottom:30px;

        }

        .sidebar-logo h2{

            color:#fff;

            font-weight:800;

        }

        .sidebar-link{

            border-radius:12px;

            padding:12px 15px;

            transition:.3s ease;

            font-weight:500;

        }

        .sidebar-link:hover{

            background:rgba(255,255,255,.1);

            transform:translateX(5px);

        }

        .sidebar-link.active{

            background:#2563eb;

            box-shadow:0 4px 10px rgba(37,99,235,.3);

        }

        /*
        |--------------------------------------------------------------------------
        | MAIN
        |--------------------------------------------------------------------------
        */

        .main-content{

            margin-left:260px;

            width:calc(100% - 260px);

            min-height:100vh;

            padding:30px;

        }

        /*
        |--------------------------------------------------------------------------
        | TOPBAR
        |--------------------------------------------------------------------------
        */

        .topbar{

            background:var(--bg-card);

            border-radius:20px;

            padding:20px;

        }

        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .card{

            background:var(--bg-card);

            color:var(--text-main);

            border:1px solid var(--border-color);

            border-radius:20px;

        }

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .table{

            color:var(--text-main);

        }

        /*
        |--------------------------------------------------------------------------
        | INPUTS
        |--------------------------------------------------------------------------
        */

        .form-control,
        .form-select{

            background:var(--bg-card);

            color:var(--text-main);

            border:1px solid var(--border-color);

        }

        .form-control:focus,
        .form-select:focus{

            background:var(--bg-card);

            color:var(--text-main);

            border-color:#2563eb;

            box-shadow:none;

        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        .mobile-toggle{

            position:fixed;

            top:15px;
            left:15px;

            z-index:2000;

            display:none;

        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media(max-width:991px){

            .sidebar{

                left:-270px;

            }

            .sidebar.show-sidebar{

                left:0;

            }

            .main-content{

                margin-left:0;

                width:100%;

                padding:15px;

            }

            .topbar{

                margin-top:70px;

            }

            .mobile-toggle{

                display:block;

            }

        }

    </style>

</head>

<body>

<!-- LOADER -->
<div id="loader">

    <div class="spinner-border text-primary"
         style="width:4rem;height:4rem">

    </div>

</div>

<!-- MOBILE BUTTON -->
<button class="btn btn-dark mobile-toggle shadow"
        onclick="toggleSidebar()">

    <i class="bi bi-list"></i>

</button>

<!-- SIDEBAR -->
<aside id="sidebar"
       class="sidebar shadow-lg d-flex flex-column">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <h2>🏪 FerreSoft</h2>

        <small class="text-light">

            Sistema ERP

        </small>

    </div>

    <!-- MENU -->
    <ul class="nav flex-column gap-2 flex-grow-1">

        <!-- DASHBOARD -->
        <li class="nav-item">

            <a href="{{ route('dashboard') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

        </li>

        <!-- PRODUCTOS -->
        <li class="nav-item">

            <a href="{{ route('products.index') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('products.*') ? 'active' : '' }}">

                <i class="bi bi-box-seam me-2"></i>

                Productos

            </a>

        </li>

        <!-- CLIENTES -->
        <li class="nav-item">

            <a href="{{ route('clients.index') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('clients.*') ? 'active' : '' }}">

                <i class="bi bi-people me-2"></i>

                Clientes

            </a>

        </li>

        <!-- PROVEEDORES -->
        <li class="nav-item">

            <a href="{{ route('suppliers.index') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">

                <i class="bi bi-truck me-2"></i>

                Proveedores

            </a>

        </li>

        <!-- FACTURACIÓN -->
        <li class="nav-item">

            <a href="{{ route('sales.index') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('sales.*') ? 'active' : '' }}">

                <i class="bi bi-receipt me-2"></i>

                Facturación

            </a>

        </li>

        <!-- REPORTES -->
        <li class="nav-item">

            <a href="{{ route('reports.index') }}"
               class="nav-link text-white sidebar-link
               {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                <i class="bi bi-bar-chart-line me-2"></i>

                Reportes

            </a>

        </li>
    

        <!-- KARDEX -->
<li class="nav-item">

    <a href="{{ route('kardex.index') }}"
       class="nav-link text-white sidebar-link
       {{ request()->routeIs('kardex.*') ? 'active' : '' }}">

        <i class="bi bi-journal-text me-2"></i>

        Kardex

    </a>

</li>



        <!-- SOLO ADMIN -->
        @auth

            @if(Auth::user()->role === 'admin')

                <!-- LOGS -->
                <li class="nav-item">

                    <a href="{{ route('logs.index') }}"
                       class="nav-link text-white sidebar-link
                       {{ request()->routeIs('logs.*') ? 'active' : '' }}">

                        <i class="bi bi-clock-history me-2"></i>

                        Logs

                    </a>

                </li>

                <!-- TITULO -->
                <li class="nav-item mt-4">

                    <small class="text-uppercase text-secondary fw-bold ms-2">

                        Administración

                    </small>

                </li>

                <!-- USUARIOS -->
                <li class="nav-item">

                    <a href="{{ route('users.index') }}"
                       class="nav-link text-white sidebar-link
                       {{ request()->routeIs('users.*') ? 'active' : '' }}">

                        <i class="bi bi-person-gear me-2"></i>

                        Usuarios

                    </a>

                </li>

                <!-- CREAR EMPLEADO -->
                <li class="nav-item">

                    <a href="{{ route('users.create') }}"
                       class="nav-link text-white sidebar-link
                       {{ request()->routeIs('users.create') ? 'active' : '' }}">

                        <i class="bi bi-person-plus me-2"></i>

                        Crear empleado

                    </a>

                </li>

            @endif

        @endauth

    </ul>

    <!-- FOOTER -->
    <div class="mt-4">

        <hr class="border-secondary">

        @auth

            <div class="text-center mb-3 text-light">

                <div class="fw-bold">

                    👤 {{ Auth::user()->name }}

                </div>

                <small class="text-secondary text-uppercase">

                    {{ Auth::user()->role }}

                </small>

            </div>

        @endauth

        <!-- DARK MODE -->
        <button onclick="toggleDarkMode()"
                class="btn btn-outline-light w-100 mb-3">

            🌙 / ☀️ Tema

        </button>

        <!-- LOGOUT -->
        @auth

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button class="btn btn-danger w-100 rounded-3">

                    <i class="bi bi-box-arrow-right"></i>

                    Cerrar sesión

                </button>

            </form>

        @endauth

    </div>

</aside>

<!-- MAIN -->
<main class="main-content">

    <!-- TOPBAR -->
    <div class="topbar shadow-sm mb-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h4 class="fw-bold mb-1">

                    🚀 FerreSoft ERP

                </h4>

                <small class="text-muted">

                    Panel administrativo

                </small>

            </div>

            @auth

            <div class="d-flex align-items-center gap-4">

                <div class="text-center">

                    <small class="text-muted d-block">

                        Hora actual

                    </small>

                    <strong id="clock">

                        --:--

                    </strong>

                </div>

                <div class="text-center">

                    <small class="text-muted d-block">

                        Usuario

                    </small>

                    <strong>

                        {{ Auth::user()->name }}

                    </strong>

                </div>

            </div>

            @endauth

        </div>

    </div>

    <!-- ALERTAS -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

            ✅ {{ session('success') }}

            <button class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">

            ❌ {{ session('error') }}

            <button class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- CONTENIDO -->
    @yield('content')

    <!-- FOOTER -->
    <footer class="text-center mt-5">

        <hr>

        <p>

            © {{ date('Y') }} FerreSoft ERP |
            Laravel 12 + Bootstrap 5

        </p>

    </footer>

</main>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | LOADER
    |--------------------------------------------------------------------------
    */

    window.addEventListener('load', () => {

        document.getElementById('loader')
            .style.display = 'none';

    });

    /*
    |--------------------------------------------------------------------------
    | CLOCK
    |--------------------------------------------------------------------------
    */

    function updateClock(){

        const now = new Date();

        document.getElementById('clock')
            .innerHTML = now.toLocaleTimeString();

    }

    setInterval(updateClock,1000);

    updateClock();

    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    function toggleSidebar(){

        document
            .getElementById('sidebar')
            .classList
            .toggle('show-sidebar');

    }

    /*
    |--------------------------------------------------------------------------
    | ALERTAS
    |--------------------------------------------------------------------------
    */

    setTimeout(() => {

        document.querySelectorAll('.alert')
            .forEach(alert => {

                alert.style.transition = '.5s';
                alert.style.opacity = '0';

                setTimeout(() => {

                    alert.remove();

                },500);

            });

    },3000);

    /*
    |--------------------------------------------------------------------------
    | DARK MODE
    |--------------------------------------------------------------------------
    */

    if(localStorage.getItem('darkMode') === 'enabled'){

        document.body.classList.add('dark-mode');

    }

    function toggleDarkMode(){

        document.body.classList.toggle('dark-mode');

        if(document.body.classList.contains('dark-mode')){

            localStorage.setItem(
                'darkMode',
                'enabled'
            );

        }else{

            localStorage.removeItem('darkMode');

        }

    }

</script>

</body>
</html>