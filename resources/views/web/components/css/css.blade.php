<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
 <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(209, 19, 19, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbar .btn-primary {
            margin-left: auto;
        }

        .navbar-brand img {
            height: 60px;
            margin-right: 20px;
        }

        .main-header {
            background: linear-gradient(to right, #13508d,   #0f58a1,   #3a7ab9,   #2c67a1);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .container h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #fff;
            text-align: center;
        }

        .input-group {
            max-width: 600px;
            margin: 0 auto;
        }
             </style> 



    <style>
        /* Contenedor de la tabla */
        .dataTables-container {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            margin-top: 20px;
        }

        /* Estilos para la tabla */
        #ordenanzasTable {
            width: 100% !important;
            margin-bottom: 15px;
        }
        
        #ordenanzasTable thead th {
            background-color: #2c3e50;
            color: white;
            position: sticky;
            top: 0;
            padding: 12px 15px;
        }
        
        #ordenanzasTable tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .btn-action {
            padding: 5px 10px;
            margin: 2px;
            font-size: 0.85rem;
        }
        
        /* Integración de controles de DataTables */
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_paginate {
            margin: 15px 0;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px 10px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 1px solid #dee2e6;
            border-radius: 4px !important;
            margin: 0 3px;
            padding: 5px 10px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #2c3e50;
            color: white !important;
            border-color: #2c3e50;
        }
        
        /* Estilos para el botón de búsqueda */
        .boton-buscar-igual-tamano {
            height: 38px; /* Igual que el input */
        }
        
        /* Estilos para los modales QR */
        .modal-qr .modal-header {
            background-color: #2c3e50;
            color: white;
        }
        
        .modal-qr .btn-close {
            filter: invert(1);
        }
        
        .modal-qr .qr-image {
            max-width: 100%;
            height: auto;
        }
    </style>