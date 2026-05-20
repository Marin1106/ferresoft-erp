<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | FerreSoft ERP</title>

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

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background: linear-gradient(
                135deg,
                #111827,
                #1e293b
            );

            font-family: Arial, sans-serif;

            padding: 20px;

        }

        /*
        |------------------------------------------------------------------
        | CARD LOGIN
        |------------------------------------------------------------------
        */

        .login-card{

            width: 100%;

            max-width: 430px;

            background: #ffffff;

            border-radius: 25px;

            padding: 40px;

            box-shadow: 0 15px 40px rgba(0,0,0,.25);

            animation: fadeIn .5s ease;

        }

        @keyframes fadeIn{

            from{

                opacity: 0;
                transform: translateY(20px);

            }

            to{

                opacity: 1;
                transform: translateY(0);

            }

        }

        /*
        |------------------------------------------------------------------
        | LOGO
        |------------------------------------------------------------------
        */

        .logo{

            font-size: 60px;

        }

        /*
        |------------------------------------------------------------------
        | INPUTS
        |------------------------------------------------------------------
        */

        .form-control{

            height: 50px;

            border-radius: 12px;

        }

        .form-control:focus{

            box-shadow: none;

            border-color: #2563eb;

        }

        /*
        |------------------------------------------------------------------
        | BUTTON
        |------------------------------------------------------------------
        */

        .btn-login{

            height: 50px;

            border-radius: 12px;

            font-weight: bold;

            font-size: 15px;

        }

        /*
        |------------------------------------------------------------------
        | MOBILE
        |------------------------------------------------------------------
        */

        @media(max-width:576px){

            .login-card{

                padding: 30px 20px;

            }

        }

    </style>

</head>

<body>

    <!-- CARD -->
    <div class="login-card">

        <!-- TITULO -->
        <div class="text-center mb-4">

            <div class="logo">

                🏪

            </div>

            <h1 class="fw-bold mt-2">

                FerreSoft ERP

            </h1>

            <p class="text-muted">

                Inicia sesión para continuar

            </p>

        </div>

        <!-- STATUS -->
        @if (session('status'))

            <div class="alert alert-success">

                {{ session('status') }}

            </div>

        @endif

        <!-- ERRORES -->
        @if ($errors->any())

            <div class="alert alert-danger">

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

            <!-- BOTONES -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                @if (Route::has('password.request'))

                    <a href="{{ route('password.request') }}"
                       class="text-decoration-none">

                        ¿Olvidaste tu contraseña?

                    </a>

                @endif

            </div>

            <!-- LOGIN -->
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