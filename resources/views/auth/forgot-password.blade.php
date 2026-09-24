<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Recuperar contraseña | FerreSoft</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            background:linear-gradient(
                135deg,
                #0f172a,
                #111827,
                #1e3a8a
            );

            font-family:'Segoe UI',sans-serif;

            padding:20px;

        }

        .auth-card{

            width:100%;
            max-width:430px;

            background:#fff;

            border-radius:30px;

            padding:45px;

            box-shadow:0 20px 50px rgba(0,0,0,.35);

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

        .logo-box{

            width:95px;
            height:95px;

            background:#2563eb;

            border-radius:25px;

            display:flex;

            align-items:center;
            justify-content:center;

            margin:auto;

            box-shadow:0 10px 25px rgba(37,99,235,.4);

        }

        .logo-box i{

            font-size:42px;

            color:#fff;

        }

        .title{

            font-size:3rem;

            font-weight:900;

            color:#0f172a;

            text-align:center;

            margin-top:25px;

        }

        .subtitle{

            text-align:center;

            color:#6b7280;

            margin-bottom:35px;

        }

        .form-label{

            font-weight:700;

            color:#111827;

        }

        .form-control{

            height:56px;

            border-radius:16px;

            border:1px solid #d1d5db;

            padding-left:18px;

            font-size:1rem;

        }

        .form-control:focus{

            border-color:#2563eb;

            box-shadow:0 0 0 4px rgba(37,99,235,.15);

        }

        .btn-login{

            height:56px;

            border:none;

            border-radius:16px;

            background:#2563eb;

            color:#fff;

            font-weight:700;

            font-size:1rem;

            transition:.3s ease;

        }

        .btn-login:hover{

            background:#1d4ed8;

            transform:translateY(-2px);

        }

        .back-link{

            text-decoration:none;

            color:#2563eb;

            font-weight:500;

        }

        .back-link:hover{

            text-decoration:underline;

        }

        .footer-text{

            text-align:center;

            color:#6b7280;

            margin-top:25px;

            font-size:.95rem;

        }

        .alert{

            border-radius:14px;

        }

    </style>

</head>

<body>

<div class="auth-card">

    <!-- LOGO -->
    <div class="logo-box">

        <i class="bi bi-tools"></i>

    </div>

    <!-- TITULO -->
    <h1 class="title">

        FerreSoft

    </h1>

    <p class="subtitle">

        Recupera tu contraseña

    </p>

    <!-- MENSAJE -->
    <div class="alert alert-info">

        Ingresa tu correo electrónico y te enviaremos
        un enlace para restablecer tu contraseña.

    </div>

    <!-- STATUS -->
    @if (session('status'))

        <div class="alert alert-success">

            {{ session('status') }}

        </div>

    @endif

    <!-- FORM -->
    <form method="POST"
          action="{{ route('password.email') }}">

        @csrf

        <!-- EMAIL -->
        <div class="mb-4">

            <label class="form-label">

                Correo electrónico

            </label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Ingrese su correo"
                   value="{{ old('email') }}"
                   required
                   autofocus>

            @error('email')

                <small class="text-danger">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <!-- BOTON -->
        <button type="submit"
                class="btn btn-login w-100">

            <i class="bi bi-envelope-arrow-up me-2"></i>

            Enviar enlace

        </button>

    </form>

    <!-- VOLVER -->
    <div class="text-center mt-4">

        <a href="{{ route('login') }}"
           class="back-link">

            ← Volver al inicio de sesión

        </a>

    </div>

    <!-- FOOTER -->
    <div class="footer-text">

        Sistema exclusivo para empleados autorizados

    </div>

</div>

</body>
</html>