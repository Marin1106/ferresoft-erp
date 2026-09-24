<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FerreSoft</title>

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

            --bg-main:#f1f5f9;
            --bg-card:#ffffff;
            --bg-sidebar:#0f172a;

            --text-main:#111827;
            --text-muted:#64748b;

            --border-color:#e2e8f0;

            --primary:#2563eb;

            --success:#22c55e;

            --danger:#ef4444;

        }

        /*
        |--------------------------------------------------------------------------
        | DARK MODE
        |--------------------------------------------------------------------------
        */

        body.dark-mode{

            --bg-main:#020617;
            --bg-card:#0f172a;
            --bg-sidebar:#000814;

            --text-main:#f8fafc;
            --text-muted:#cbd5e1;

            --border-color:#1e293b;

        }

        /*
        |--------------------------------------------------------------------------
        | RESET
        |--------------------------------------------------------------------------
        */

        *{

            margin:0;
            padding:0;
            box-sizing:border-box;

        }

        /*
        |--------------------------------------------------------------------------
        | BODY
        |--------------------------------------------------------------------------
        */

        body{

            background:var(--bg-main);

            color:var(--text-main);

            min-height:100vh;

            overflow-x:hidden;

            transition:.3s ease;

            font-family:'Segoe UI',sans-serif;

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

            background:#020617;

        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

        .sidebar{

            width:260px;

            height:100vh;

            background:var(--bg-sidebar);

            position:fixed;

            top:0;
            left:0;

            z-index:1000;

            padding:25px 18px;

            overflow-y:auto;

            transition:.3s ease;

            display:flex;

            flex-direction:column;

        }

        .sidebar::-webkit-scrollbar{

            width:5px;

        }

        .sidebar::-webkit-scrollbar-thumb{

            background:#334155;

            border-radius:20px;

        }

        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */

        .sidebar-logo{

            text-align:center;

            margin-bottom:35px;

        }

        .sidebar-logo h2{

            color:#fff;

            font-weight:800;

            margin-bottom:5px;

        }

        .sidebar-logo small{

            color:#94a3b8;

        }

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR LINKS
        |--------------------------------------------------------------------------
        */

        .sidebar-link{

            display:flex;

            align-items:center;

            padding:12px 15px;

            border-radius:14px;

            font-weight:500;

            color:#fff !important;

            transition:.3s ease;

        }

        .sidebar-link i{

            font-size:1rem;

        }

        .sidebar-link:hover{

            background:rgba(255,255,255,.08);

            transform:translateX(5px);

        }

        .sidebar-link.active{

            background:var(--primary);

            box-shadow:0 5px 15px rgba(37,99,235,.35);

        }

        /*
        |--------------------------------------------------------------------------
        | MAIN CONTENT
        |--------------------------------------------------------------------------
        */

        .main-content{

            margin-left:260px;

            width:calc(100% - 260px);

            min-height:100vh;

            display:flex;

            flex-direction:column;

            padding:25px;

        }

        /*
        |--------------------------------------------------------------------------
        | CONTENT WRAPPER
        |--------------------------------------------------------------------------
        */

        .content-wrapper{

            flex:1;

        }

        /*
        |--------------------------------------------------------------------------
        | TOPBAR
        |--------------------------------------------------------------------------
        */

        .topbar{

            background:var(--bg-card);

            border:1px solid var(--border-color);

            border-radius:22px;

            padding:20px 25px;

        }

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        .card{

            background:var(--bg-card);

            color:var(--text-main);

            border:1px solid var(--border-color);

            border-radius:20px;

            overflow:hidden;

        }

        /*
        |--------------------------------------------------------------------------
        | TABLES
        |--------------------------------------------------------------------------
        */

        .table{

            color:var(--text-main);

            margin:0;

        }

        .table thead{

            background:#111827;

            color:#fff;

        }

        .table thead th{

            padding:18px;

            border:none;

            font-size:14px;

        }

        .table tbody td{

            padding:18px;

            vertical-align:middle;

        }

        /*
        |--------------------------------------------------------------------------
        | FORMS
        |--------------------------------------------------------------------------
        */

        .form-control,
        .form-select{

            background:var(--bg-card);

            color:var(--text-main);

            border:1px solid var(--border-color);

            border-radius:12px;

            padding:12px;

        }

        .form-control:focus,
        .form-select:focus{

            background:var(--bg-card);

            color:var(--text-main);

            border-color:var(--primary);

            box-shadow:none;

        }

        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        */

        .btn{

            border-radius:12px;

            font-weight:500;

        }

        /*
        |--------------------------------------------------------------------------
        | ALERTS
        |--------------------------------------------------------------------------
        */

        .alert{

            border:none;

            border-radius:15px;

        }

        /*
        |--------------------------------------------------------------------------
        | USER BOX
        |--------------------------------------------------------------------------
        */

        .sidebar-footer{

            margin-top:auto;

            padding-top:20px;

        }

        .user-box{

            background:rgba(255,255,255,.05);

            padding:15px;

            border-radius:15px;

        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer{

            margin-top:40px;

            background:#081028;

            border-radius:25px 25px 0 0;

            overflow:hidden;

        }

        .footer a{

            transition:.3s ease;

        }

        .footer a:hover{

            opacity:.7;

        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE TOGGLE
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
       class="sidebar shadow-lg">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <h2>FerreSoft</h2>

        <small>Sistema Administrativo</small>

    </div>

    <!-- MENU -->
    <ul class="nav flex-column gap-2">

        <!-- DASHBOARD -->
        <li class="nav-item">

            <a href="{{ route('dashboard') }}"
               class="nav-link sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

        </li>

        <!-- PRODUCTOS -->
        @if(in_array(Auth::user()->role,['admin','operario']))

        <li class="nav-item">

            <a href="{{ route('products.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

                <i class="bi bi-box-seam me-2"></i>

                Productos

            </a>

        </li>

        @endif

        <!-- CLIENTES -->
        @if(in_array(Auth::user()->role,['admin','vendedor']))

        <li class="nav-item">

            <a href="{{ route('clients.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">

                <i class="bi bi-people me-2"></i>

                Clientes

            </a>

        </li>

        <!-- PROVEEDORES -->
        @if(in_array(Auth::user()->role,['admin','operario']))

        <li class="nav-item">

            <a href="{{ route('suppliers.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">

                <i class="bi bi-truck me-2"></i>

                Proveedores

            </a>

        </li>

        @endif


        @endif

        <!-- FACTURACION -->
        @if(in_array(Auth::user()->role,['admin','vendedor']))

        <li class="nav-item">

            <a href="{{ route('sales.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">

                <i class="bi bi-receipt me-2"></i>

                Facturación

            </a>

        </li>

        @endif

        <!-- REPORTES -->
        @if(in_array(Auth::user()->role,['admin','contador']))

        <li class="nav-item">

            <a href="{{ route('reports.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                <i class="bi bi-bar-chart-line me-2"></i>

                Reportes

            </a>

        </li>

        @endif

        <!-- KARDEX -->
        @if(in_array(Auth::user()->role,['admin','operario']))

        <li class="nav-item">

            <a href="{{ route('kardex.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('kardex.*') ? 'active' : '' }}">

                <i class="bi bi-journal-text me-2"></i>

                Kardex

            </a>

        </li>

        @endif

        <!-- ADMIN -->
        @if(Auth::user()->role === 'admin')

        <li class="nav-item mt-3">

            <small class="text-uppercase text-secondary fw-bold ms-2">

                Administración

            </small>

        </li>

        <li class="nav-item">

            <a href="{{ route('users.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">

                <i class="bi bi-person-gear me-2"></i>

                Usuarios

            </a>

        </li>

        <li class="nav-item">

            <a href="{{ route('logs.index') }}"
               class="nav-link sidebar-link {{ request()->routeIs('logs.*') ? 'active' : '' }}">

                <i class="bi bi-clock-history me-2"></i>

                Logs

            </a>

        </li>

        @endif

    </ul>

    <!-- FOOTER SIDEBAR -->
    <div class="sidebar-footer">

        <hr class="border-secondary">

        <div class="user-box text-center text-light mb-3">

            <div class="fw-bold">

                👤 {{ Auth::user()->name }}

            </div>

            <small class="text-secondary text-uppercase">

                {{ Auth::user()->role }}

            </small>

        </div>

        <!-- DARK MODE -->
        <button onclick="toggleDarkMode()"
                class="btn btn-outline-light w-100 mb-3">

            🌙 / ☀️ Tema

        </button>

        <!-- LOGOUT -->
        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button class="btn btn-danger w-100 py-2">

                <i class="bi bi-box-arrow-right me-1"></i>

                Cerrar sesión

            </button>

        </form>

    </div>

</aside>

<!-- MAIN -->
<main class="main-content">

    <!-- CONTENT -->
    <div class="content-wrapper">

        <!-- TOPBAR -->
        <div class="topbar shadow-sm mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h3 class="fw-bold mb-1">

                        FerreSoft

                    </h3>

                    <small class="text-muted">

                        Panel Administrativo

                    </small>

                </div>

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

            </div>

        </div>

        <!-- ALERTAS -->
        @if(session('success'))

            <div class="alert alert-success shadow-sm">

                ✅ {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger shadow-sm">

                ❌ {{ session('error') }}

            </div>

        @endif

        <!-- CONTENIDO -->
        @yield('content')

    </div>

    <!-- FOOTER -->
    <footer class="footer text-white">

        <div class="container-fluid p-5">

            <div class="row">

                <div class="col-lg-6 mb-4">

                    <h4 class="fw-bold mb-3">

                        Sobre Nosotros

                    </h4>

                    <p class="text-light small">

                        FerreSoft es un sistema integral de gestión
                        diseñado para ferreterías y negocios de productos metálicos.

                    </p>

                    <small class="text-secondary">

                        Versión v2.1

                    </small>

                </div>

                <div class="col-lg-3 mb-4">

                    <h4 class="fw-bold mb-3">

                        Contacto

                    </h4>

                    <p>

                        <i class="bi bi-telephone me-2"></i>

                        +57 300 000 0000

                    </p>

                    <p>

                        <i class="bi bi-envelope me-2"></i>

                        contacto@ferresoft.com

                    </p>

                    <p>

                        <i class="bi bi-geo-alt me-2"></i>

                        Santiago de Cali

                    </p>

                </div>

                <div class="col-lg-3 mb-4">

                    <h4 class="fw-bold mb-3">

                        Síguenos

                    </h4>

                    <div class="d-flex gap-3 fs-4">

                        <a href="#" class="text-white">

                            <i class="bi bi-facebook"></i>

                        </a>

                        <a href="#" class="text-white">

                            <i class="bi bi-instagram"></i>

                        </a>

                        <a href="#" class="text-white">

                            <i class="bi bi-twitter-x"></i>

                        </a>

                        <a href="#" class="text-white">

                            <i class="bi bi-linkedin"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="border-top border-secondary px-5 py-3 d-flex justify-content-between flex-wrap">

            <div class="small text-light">

                © {{ date('Y') }} FerreSoft.
                Todos los derechos reservados.

            </div>

            <div class="small">

                <a href="#"
                   class="text-light text-decoration-none me-3">

                    Términos

                </a>

                <a href="#"
                   class="text-light text-decoration-none">

                    Privacidad

                </a>

            </div>

        </div>

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

        document.getElementById('loader').style.display = 'none';

    });

    /*
    |--------------------------------------------------------------------------
    | CLOCK
    |--------------------------------------------------------------------------
    */

    function updateClock(){

        const now = new Date();

        document.getElementById('clock').innerHTML =
            now.toLocaleTimeString();

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

            localStorage.setItem('darkMode','enabled');

        }else{

            localStorage.removeItem('darkMode');

        }

    }

</script>

</body>
</html>