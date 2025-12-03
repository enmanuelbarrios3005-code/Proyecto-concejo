<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{!! asset('Estilos_login/css/login.css') !!}">
    <link rel="stylesheet" href="{!! asset('build/assets/app-c22a5d79.css') !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
@laravelPWA




<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4 text-center">
                                <div class="text-center">
                                    <img src="{{ asset('img/logo.png') }}" style="max-width: 50%; height: auto;">
                                    <br>
                                    <h2 class="mt-1 mb-8 pb-1">Inicio de Sesión</h2>
                                </div>
                                @include('auth.from.from-login')
                                @include('auth.from.Alertas_login')
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2 text-center">
                            <div class="text-white px-3 py-4 p-md-12 mx-md-12">
                                <h2 class="mb-4">Misión</h2>
                                <p class="large mb-10">
                                    Legislar, Aprobar las Ordenanzas del Municipio Escuque, autorizar modificaciones presupuestarias, 
                                    ejercer funciones de control político, seguimiento y evaluación de los órganos de la administración 
                                    pública municipal, estableciendo los principios generales para el ejercicio de la función legislativa.
                                </p>
                                
                                <h2 class="mb-4 mt-4">Visión</h2>
                                <p class="large mb-10">
                                    Lograr establecer todas las bases y principios generales en el ejercicio de la función legislativa, 
                                    en cuanto a velar y garantizar el cumplimiento de las políticas públicas a través de la democracia 
                                    participativa de las diferentes comunidades organizadas del municipio Escuque, así como cumplir con la Normativa 
                                    que rige la materia de este órgano establecido en la Constitución, con la Ley Orgánica del Poder Público Municipal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

