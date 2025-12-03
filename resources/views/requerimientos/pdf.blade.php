<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimiento N° {{ $requerimiento->numero_requerimiento }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
        body {
            background-color: #f8f9fa;
            font-size: 10pt; 
        }
        .paper-container {
            max-width: 700px; 
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header-logo {
            content: url('{{ asset('img/logo.png') }}'); 
            height: 70px; /* Reducido */
            border: 1px solid #ccc;
            padding: 5px; /* Reducido */
            background-color: #eee;
            text-align: center;
            line-height: 40px;
            font-size: 10px; /* Reducido */
            color: #888;
            border-radius: 45px;
        }
        .header-title h4 {
            font-size: 1.1rem; /* Reducido */
            margin: 0;
            font-weight: bold;
        }
        .header-title p {
            margin: 0;
            font-size: 0.8rem; /* Reducido */
        }
        .info-box {
            border: 1px solid #000;
            padding: 3px 8px; /* Reducido */
            font-size: 0.9rem;
        }
        .main-table {
            border: 1px solid #000;
            font-size: 0.85rem; /* Reducido el tamaño de letra de la tabla */
        }
        .main-table th, .main-table td {
            border: 1px solid #000;
            padding: 5px; /* Reducido el padding de la celda */
            vertical-align: top;
        }
        .signature-box {
            border: 1px solid #000;
            padding: 8px; /* Reducido */
            height: 100px; /* Reducido para ahorrar espacio */
            position: relative;
        }
        .signature-box p {
            font-size: 0.8rem; /* Reducido */
        }
        .signature-box .signature-line {
            border-top: 1px solid #000;
            margin-top: 25px; /* Reducido */
        }

        /* --- ESTILOS DE IMPRESIÓN (CLAVE PARA UNA SOLA PÁGINA) --- */
        @media print {
            .action-buttons {
                display: none !important;
            }
            body {
                background-color: #fff;
                /* Eliminamos todos los márgenes del cuerpo para empezar desde cero */
                margin: 0 !important;
                padding: 0 !important;
            }
            .paper-container {
                /* Usamos el ancho completo en impresión */
                max-width: 100% !important; 
                margin: 0 !important;
                border: none !important;
                box-shadow: none !important;
                padding: 10mm; /* Establece un margen interno fijo para el contenido */
            }
            /* Asegúrate de que no haya saltos de página dentro de la tabla o firmas */
            table, section {
                page-break-inside: avoid !important;
            }
            /* Reducir aún más el tamaño de la fuente para el PDF final */
            body, .main-table, .signature-box p, .info-box {
                font-size: 9pt !important; 
            }
        }
    </style>
</head>
<body>

    <div class="action-buttons text-center p-3 bg-dark sticky-top">
        <button id="btnDescargarPDF" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Descargar PDF</button>
        <button id="btnImprimir" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
    </div>

    <div class="paper-container" id="documentoAPDF">
        
        <header class="row mb-3 align-items-center"> <!-- mb-4 reducido a mb-3 -->
            <div class="col-2">
                <div class="header-logo" url="('{{ asset('img/logo.png') }}')">LOGO AQUÍ</div>
            </div>
            <div class="col-8 header-title">
                <h4>REPÚBLICA BOLIVARIANA DE VENEZUELA</h4>
                <p>CONCEJO MUNICIPAL</p>
                <h4>SECRETARÍA</h4>
            </div>
            <div class="col-2 text-end">
                <p style="font-size: 0.75rem;">Palacio Municipal<br>Frente a la Pza. Bolívar</p> <!-- Reducido font-size -->
            </div>
        </header>

        <section class="row mb-3">
            <div class="col-7">
                <div class="info-box">
                    <strong>Requerimiento N°:</strong> {{ $requerimiento->numero_requerimiento }}
                </div>
            </div>
            <div class="col-5">
                <div class="info-box">
                    <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($requerimiento->fecha)->format('d/m/Y') }}
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="info-box">
                    <strong>Oficina:</strong> {{ $requerimiento->oficina }}
                </div>
            </div>
        </section>

        <section class="mb-3"> 
            <table class="table table-bordered main-table">
                <thead>
                    <tr class="text-center">
                        <th style="width: 10%;">CANT.</th>
                        <th>Descripción</th>
                        <th style="width: 30%;">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requerimiento->detalles as $detalle)
                    <tr>
                        <td class="text-center">{{ $detalle->cantidad }}</td>
                        <td>{!! nl2br(e($detalle->descripcion)) !!}</td>
                        <td>{!! nl2br(e($detalle->observaciones)) !!}</td>
                    </tr>
                    @endforeach
                    @for ($i = $requerimiento->detalles->count(); $i < 10; $i++)
                    <tr>
                        <td style="height: 30px;">&nbsp;</td> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </section>

        <section class="row">
            <div class="col-6">
                <div class="signature-box">
                    <p class="text-center"><strong>Elaborado por:</strong></p>
                    <div class="signature-line"></div>
                    <p class="text-center mb-0">{{ $requerimiento->elaborado_por_nombre }}</p>
                    <p class="text-center"><strong>{{ $requerimiento->elaborado_por_cargo }}</strong></p>
                </div>
            </div>
            <div class="col-6">
                <div class="signature-box">
                    <p class="text-center"><strong>Recibido por:</strong></p>
                    <div class="signature-line"></div>
                    <p class="text-center mb-0">{{ $requerimiento->recibido_por_nombre }}</p>
                    <p class="text-center"><strong>{{ $requerimiento->recibido_por_cargo }}</strong></p>
                </div>
            </div>
        </section>

        <footer class="text-center mt-3 border-top pt-2"> 
            <small style="font-size: 0.75rem;">
                Palacio Municipal. Frente a la Plaza Bolívar - Escuque Despacho del Concejo Municipal
                <br>
                Correo: camaramunicipalescuque@gmail.com Telf: De Oficina: 0271-295.10.65/295.04.05
            </small>
        </footer>

    </div> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('btnImprimir').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('btnDescargarPDF').addEventListener('click', function() {
            const elemento = document.getElementById('documentoAPDF');
            const nombreArchivo = 'Requerimiento-{{ $requerimiento->numero_requerimiento }}.pdf';

            html2pdf()
                .from(elemento)
                .set({
                    margin: [8, 8, 8, 8], 
                    filename: nombreArchivo,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 3, logging: false, useCORS: true }, 
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } 
                })
                .save();
        });
    </script>
</body>
</html>
