<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FerreSoft</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{

            background:#f4f6fb;

            font-family:Segoe UI;

            overflow-x:hidden;

        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR
        |--------------------------------------------------------------------------
        */

        .navbar-custom{

            background:linear-gradient(90deg,#081028,#0b1d48);

            padding:18px 0;

            box-shadow:0 5px 20px rgba(0,0,0,.1);

        }

        .logo-box{

            width:55px;
            height:55px;

            background:#3b82f6;

            border-radius:16px;

            display:flex;
            align-items:center;
            justify-content:center;

            color:white;

            font-size:24px;

            box-shadow:0 10px 20px rgba(59,130,246,.3);

        }

        .login-btn{

            background:#3b82f6;

            color:white;

            padding:12px 30px;

            border-radius:14px;

            font-weight:600;

            text-decoration:none;

            transition:.3s;

        }

        .login-btn:hover{

            background:#2563eb;

            transform:translateY(-2px);

            color:white;

        }

        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero{

            min-height:90vh;

            display:flex;
            align-items:center;

            text-align:center;

            padding:80px 20px;

        }

        .hero-logo{

            width:180px;

            border-radius:30px;

            box-shadow:0 20px 40px rgba(0,0,0,.1);

        }

        .hero-title{

            font-size:90px;

            font-weight:800;

            margin-top:30px;

            color:#081028;

        }

        .hero-title span{

            color:#3b82f6;

        }

        .hero-subtitle{

            font-size:24px;

            color:#64748b;

            margin-top:10px;

        }

        .hero-text{

            max-width:900px;

            margin:auto;

            margin-top:30px;

            color:#475569;

            font-size:22px;

            line-height:1.7;

        }

        /*
        |--------------------------------------------------------------------------
        | CARDS
        |--------------------------------------------------------------------------
        */

        .feature-card{

            background:white;

            border-radius:30px;

            padding:40px;

            text-align:center;

            box-shadow:0 10px 30px rgba(0,0,0,.05);

            transition:.3s;

            height:100%;

        }

        .feature-card:hover{

            transform:translateY(-10px);

            box-shadow:0 20px 40px rgba(0,0,0,.08);

        }

        .feature-icon{

            width:90px;
            height:90px;

            background:#3b82f6;

            border-radius:25px;

            margin:auto;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:40px;

            color:white;

            margin-bottom:25px;

            box-shadow:0 10px 20px rgba(59,130,246,.3);

        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        footer{

            background:#081028;

            color:white;

            padding-top:70px;

            margin-top:100px;

        }

        .footer-link{

            text-decoration:none;

            color:rgba(255,255,255,.75);

            transition:.3s;

        }

        .footer-link:hover{

            color:white;

            transform:translateX(5px);

        }

        .social-link{

            width:45px;
            height:45px;

            border-radius:14px;

            background:rgba(255,255,255,.08);

            display:flex;
            align-items:center;
            justify-content:center;

            color:white;

            text-decoration:none;

            transition:.3s;

            font-size:20px;

        }

        .social-link:hover{

            background:#3b82f6;

            transform:translateY(-5px);

            color:white;

        }

        .footer-bottom{

            border-top:1px solid rgba(255,255,255,.1);

            margin-top:50px;

            padding:25px 0;

        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media(max-width:768px){

            .hero-title{

                font-size:55px;

            }

            .hero-subtitle{

                font-size:20px;

            }

            .hero-text{

                font-size:18px;

            }

        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-3"
           href="#">

            <div class="logo-box">

                <i class="bi bi-tools"></i>

            </div>

            <div>

                <h3 class="m-0 fw-bold">

                    FerreSoft

                </h3>

                <small class="text-light opacity-75">

                    Gestión Industrial

                </small>

            </div>

        </a>

        <a href="{{ route('login') }}"
           class="login-btn">

            <i class="bi bi-box-arrow-in-right me-2"></i>

            Iniciar Sesión

        </a>

    </div>

</nav>

<!-- HERO -->
<section class="hero">

    <div class="container">

        <img src="https://cdn-icons-png.flaticon.com/512/943/943594.png"
             class="hero-logo">

        <h1 class="hero-title">

            Ferre<span>Soft</span>

        </h1>

        <h3 class="hero-subtitle">

            Sistema de Gestión Industrial

        </h3>

        <p class="hero-text">

            Optimiza tu negocio con nuestra plataforma integral:
            inventario inteligente, facturación electrónica
            certificada y herramientas modernas para la administración
            de ferreterías y estructuras metálicas.

        </p>

        <!-- CARDS -->
        <div class="row mt-5 g-4">

            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <h2 class="fw-bold">

                        Inventario

                    </h2>

                    <p class="text-muted mt-3">

                        Control total de productos,
                        stock y movimientos en tiempo real.

                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-receipt"></i>

                    </div>

                    <h2 class="fw-bold">

                        Facturación

                    </h2>

                    <p class="text-muted mt-3">

                        Facturación electrónica
                        moderna y organizada.

                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card">

                    <div class="feature-icon">

                        <i class="bi bi-stars"></i>

                    </div>

                    <h2 class="fw-bold">

                        Inteligencia IA

                    </h2>

                    <p class="text-muted mt-3">

                        Herramientas inteligentes para
                        optimizar procesos industriales.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer>

    <div class="container">

        <div class="row g-5 align-items-start">

            <!-- EMPRESA -->
            <div class="col-lg-4">

                <div class="d-flex align-items-center gap-3 mb-3">

                    <div class="logo-box">

                        <i class="bi bi-tools"></i>

                    </div>

                    <div>

                        <h4 class="fw-bold m-0">

                            FerreSoft

                        </h4>

                        <small class="text-light opacity-75">

                            Sistema Industrial

                        </small>

                    </div>

                </div>

                <p class="text-light opacity-75">

                    Plataforma moderna para la administración
                    de ferreterías, control de inventario,
                    facturación y gestión empresarial.

                </p>

            </div>

            <!-- ENLACES -->
            <div class="col-lg-4">

                <h5 class="fw-bold mb-4">

                    Navegación

                </h5>

                <div class="d-flex flex-column gap-3">

                    <a href="#"
                       class="footer-link">

                        <i class="bi bi-house-door me-2"></i>

                        Inicio

                    </a>

                    <a href="#"
                       class="footer-link">

                        <i class="bi bi-grid me-2"></i>

                        Servicios

                    </a>

                    <a href="{{ route('login') }}"
                       class="footer-link">

                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Iniciar Sesión

                    </a>

                </div>

            </div>

            <!-- CONTACTO -->
            <div class="col-lg-4">

                <h5 class="fw-bold mb-4">

                    Contacto

                </h5>

                <div class="d-flex flex-column gap-3 text-light opacity-75">

                    <div>

                        <i class="bi bi-telephone me-2"></i>

                        +57 300 000 0000

                    </div>

                    <div>

                        <i class="bi bi-envelope me-2"></i>

                        soporte@ferresoft.com

                    </div>

                    <div>

                        <i class="bi bi-geo-alt me-2"></i>

                        Santiago de Cali, Colombia

                    </div>

                </div>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div class="text-light opacity-75">

                © {{ date('Y') }} FerreSoft —
                Todos los derechos reservados.

            </div>

            <div class="d-flex gap-3">

                <a href="#"
                   class="social-link">

                    <i class="bi bi-facebook"></i>

                </a>

                <a href="#"
                   class="social-link">

                    <i class="bi bi-instagram"></i>

                </a>

                <a href="#"
                   class="social-link">

                    <i class="bi bi-twitter-x"></i>

                </a>

                <a href="#"
                   class="social-link">

                    <i class="bi bi-linkedin"></i>

                </a>

            </div>

        </div>

    </div>

</footer>

</body>
</html>