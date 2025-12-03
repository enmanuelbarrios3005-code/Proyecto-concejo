    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Concejo Municipal</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />         
         @include('web.components.css.css')
         @include('web.components.css.css_btn_up')
    </head>
    <body>
    <section class="intro-section py-3 animate__animated"></section>
        <section class="intro-section py-8 animate__animated"></section>
        <nav class="navbar navbar-light bg-light static-top">
        <div class="container">
        <a class="navbar-brand" href="/login">
            <img src="{{ asset('img/logo.png') }}" alt="Camara Municipal de Escuque" style="height: 80px; margin-right: 20px;" />
        </a>            
         @include('web.components.btn.btn_dropdown')
    </div>
        </div>
    </div>
        </nav>
        <header class="main-header text-center animate__animated">     
            <h3>Bienvenido! Conozca un Poco Sobre las Resoluciones del Municipio Escuque.</h3>
        </header>
        <section class="intro-section py-3 animate__animated"></section>
        <div class="container mt-5">
        <h1 class="mb-4">Resoluciones Municipales</h1>    
        <br>    

     
        <form action="{{ route('resol.search') }}" method="GET" class="mb-4">
        </form>  

        <!-- Tu tabla de ordenanzas aquí -->
        @include('web.resoluciones.datatable.tablet')
            </div>                  
        
            @include('web.resoluciones.modal.modal')              
            
        <section class="intro-section py-3 animate__animated"></section>
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6"></div>
                </div>
            </div>
        </header>
        <section class="intro-section py-3 animate__animated"></section>         
             @include('web.components.btn.btn_up')
             @include('web.resoluciones.view.footer')
        <section class="intro-section py-3 animate__animated"></section>            
            @include('web.components.js.script')
            @include('web.components.js.script_btn_up')





    </body>
    </html>