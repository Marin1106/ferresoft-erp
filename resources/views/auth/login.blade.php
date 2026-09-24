<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | FerreSoft</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        /*
        |------------------------------------------------------------------
        | BODY
        |------------------------------------------------------------------
        */

        body{

            min-height:100vh;

            display:flex;

            align-items:center;

            justify-content:center;

            background:linear-gradient(
                135deg,
                #0f172a,
                #1e293b
            );

            font-family:Arial,sans-serif;

            padding:20px;

        }

        /*
        |------------------------------------------------------------------
        | CARD LOGIN
        |------------------------------------------------------------------
        */

        .login-card{

            width:100%;

            max-width:430px;

            background:#ffffff;

            border-radius:30px;

            padding:45px;

            box-shadow:0 20px 45px rgba(0,0,0,.30);

            animation:fadeIn .5s ease;

        }

        @keyframes fadeIn{

            from{

                opacity:0;

                transform:translateY(20px);

            }

            to{

                opacity:1;

                transform:translateY(0);

            }

        }

        /*
        |------------------------------------------------------------------
        | LOGO
        |------------------------------------------------------------------
        */

        .logo{

            width:95px;

            height:95px;

            margin:auto;

            border-radius:25px;

            background:linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            display:flex;

            align-items:center;

            justify-content:center;

            color:#fff;

            font-size:45px;

            box-shadow:0 10px 25px rgba(37,99,235,.35);

        }

        /*
        |------------------------------------------------------------------
        | TITULO
        |------------------------------------------------------------------
        */

        .title{

            font-size:42px;

            font-weight:800;

            color:#111827;

        }

        /*
        |------------------------------------------------------------------
        | INPUTS
        |------------------------------------------------------------------
        */

        .form-control{

            height:55px;

            border-radius:14px;

            border:1px solid #d1d5db;

            padding-left:15px;

        }

        .form-control:focus{

            box-shadow:none;

            border-color:#2563eb;

        }

        /*
        |------------------------------------------------------------------
        | BUTTON
        |------------------------------------------------------------------
        */

        .btn-login{

            height:55px;

            border-radius:14px;

            font-weight:700;

            font-size:16px;

            transition:.3s ease;

        }

        .btn-login:hover{

            transform:translateY(-2px);

            box-shadow:0 10px 20px rgba(37,99,235,.25);

        }

        /*
        |------------------------------------------------------------------
        | LINKS
        |------------------------------------------------------------------
        */

        a{

            color:#2563eb;

            text-decoration:none;

        }

        a:hover{

            color:#1d4ed8;

        }

        /*
        |------------------------------------------------------------------
        | MOBILE
        |------------------------------------------------------------------
        */

        @media(max-width:576px){

            .login-card{

                padding:35px 25px;

            }

            .title{

                font-size:34px;

            }

        }

    </style>

</head>

<body>

    <!-- CARD -->
    <div class="login-card">

        <!-- HEADER -->
        <div class="text-center mb-4">

            <!-- ICONO -->
            <div class="logo">

                <i class="bi bi-tools"></i>

            </div>

            <!-- TITULO -->
            <h1 class="title mt-4">

                FerreSoft

            </h1>

            <!-- SUBTITLE -->
            <p class="text-muted mt-2">

                Inicia sesión para continuar

            </p>

        </div>

        <!-- STATUS -->
        @if (session('status'))

            <div class="alert alert-success rounded-4 border-0 shadow-sm">

                {{ session('status') }}

            </div>

        @endif

        <!-- ERRORES -->
        @if ($errors->any())

            <div class="alert alert-danger rounded-4 border-0 shadow-sm">

                {{ $errors->first() }}

            </div>

        @endif

        <!-- FORM -->
        <form method="POST"
              action="{{ route('login') }}">

            @csrf

            <!-- EMAIL -->
            <div class="mb-3">

                <label class="form-label fw-semibold">

                    Correo electrónico

                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control"
                       placeholder="Ingrese su correo"
                       required
                       autofocus>

            </div>

            <!-- PASSWORD -->
            <div class="mb-3">

                <label class="form-label fw-semibold">

                    Contraseña

                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Ingrese su contraseña"
                       required>

            </div>

            <!-- RECORDAR -->
            <div class="form-check mb-4">

                <input class="form-check-input"
                       type="checkbox"
                       name="remember"
                       id="remember">

                <label class="form-check-label"
                       for="remember">

                    Recordarme

                </label>

            </div>

            <!-- RECUPERAR -->
            <div class="mb-4">

                @if (Route::has('password.request'))

                    <a href="{{ route('password.request') }}">

                        ¿Olvidaste tu contraseña?

                    </a>

                @endif

            </div>

            <!-- BOTON LOGIN -->
            <button type="submit"
                    class="btn btn-primary w-100 btn-login">

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Iniciar sesión

            </button>

        </form>

        <!-- FOOTER -->
        <div class="text-center mt-4">

            <small class="text-muted">

                Acceso exclusivo para empleados autorizados

            </small>

        </div>

    </div>

</body>

</html>