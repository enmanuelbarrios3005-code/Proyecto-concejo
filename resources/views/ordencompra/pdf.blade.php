<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Pago #{{ $orden->numero_orden }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
       
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; 
        }
        
     
        .paper-container {
           
            margin: 20px auto;
            background: #fff;
            padding: 0; 
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 2px;
            overflow: auto;
         
            padding-top: 0.4in; 
            padding-left: 0.5in; 
            padding-right: 0.5in;
        }
        .header img {
            width: 70px; 
            float: left;
        }
        .header h2, .header h3 {
            margin: 0;
            font-weight: bold;
            font-size: 13px;
        }

        .content-area {
             
             padding-left: 0.5in; 
             padding-right: 0.5in;
             padding-bottom: 0.4in;
        }

        .info-table, .main-table, .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        .info-table td, .main-table th, .main-table td, .footer-table td {
            border: 1px solid #000;
            padding: 2px 3px; 
            font-size: 9px; 
            vertical-align: top;
        }
        .main-table th {
            background: #f2f2f2;
            font-size: 9px;
        }
        .main-table td {
            text-align: center;
        }
        .section-title {
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 1px;
            font-size: 10px;
        }
        .observaciones {
            border: 1px solid #000;
            height: 15px; 
            padding: 3px;
            font-size: 9px;
            margin-top: 5px;
        }
        .firmas {
            margin-top: 10px;
            width: 100%;
        }
        .firmas td {
            border: none;
            text-align: center;
            font-size: 9px;
            padding-top: 15px;
            border-top: 1px solid #000;
            width: 45%;
        }
        .small {
            font-size: 9px;
        }

        
        @media print {
            .action-buttons {
                display: none !important;
            }
            .paper-container {
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
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
        
        <div class="header">

            <h3>REPÚBLICA BOLIVARIANA DE VENEZUELA</h3>
            <h3>CÁMARA MUNICIPAL</h3>
            <div class="small">ADMINISTRACIÓN</div>
            <div class="small" style="float:right;">R.I.F. G-20007405-1</div>
        </div>

        <div class="content-area">
            <h2 style="text-align:center; margin-bottom:2px; font-size: 14px;">ORDEN DE PAGO</h2>

            <table class="info-table">
                <tr>
                    <td style="width:50%;">ESCUQUE:</td>
                    <td style="width:20%;">Nº {{ $orden->numero_orden }}</td>
                    <td style="width:15%;">{{ $orden->fecha_orden }}</td>
                    <td style="width:5%;">Bs.</td>
                    <td style="width:10%; text-align: right; font-weight: bold;">{{ $orden->monto_total }}</td> 
                </tr>
            </table>

            <div class="section-title">LA CANTIDAD DE: <span style="font-weight:normal;">{{ $orden->cantidad_letras }}</span></div>

            <table class="info-table">
                <tr>
                    <td style="width:33%;">ORDEN DE COMPRA N°<br>{{ $orden->orden_compra_numero }}</td>
                    <td style="width:33%;">TIPO DE ORDEN<br>{{ $orden->tipo_orden }}</td>
                    <td style="width:34%;">ORDEN DE SERVICIO N°<br>{{ $orden->orden_servicio_numero }}</td>
                </tr>
                <tr>
                    <td colspan="2">BENEFICIARIO: {{ $orden->beneficiario }}</td>
                    <td>AUTORIZADO A COBRAR</td> 
                </tr>
                <tr>
                    <td colspan="3">CONCEPTO DEL GASTO: {{ $orden->concepto_gasto }}</td>
                </tr>
            </table>

            <div class="section-title">PAGO DE SEGURO SOCIAL {{ $orden->concepto_gasto }}</div>

            <table class="main-table">
                <thead>
                    <tr>
                        <th>SECTOR</th>
                        <th>PROGRAMA</th>
                        <th>ACTIVIDAD</th>
                        <th>PARTIDA</th>
                        <th>GENERICA</th>
                        <th>ESPECIFICA</th>
                        <th>SUB.ESPECIFICA</th>
                        <th>MONTO BS.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orden->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->sector }}</td>
                        <td>{{ $detalle->programa }}</td>
                        <td>{{ $detalle->actividad }}</td>
                        <td>{{ $detalle->partida }}</td>
                        <td>{{ $detalle->generica }}</td>
                        <td>{{ $detalle->especifica }}</td>
                        <td>{{ $detalle->subespecifica }}</td>
                        <td style="text-align: right;">{{ $detalle->monto }}</td>
                    </tr>
                    @endforeach
                    @for ($i = $orden->detalles->count(); $i < 5; $i++)
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <table class="footer-table">
                <tr>
                    <td rowspan="2" style="width:20%; vertical-align: middle;">RECIBÍ CONFORME<br><br>FIRMA Y SELLO DEL BENEFICIARIO<br>C.I. N°</td>
                    <td style="width:20%;">RETENCIÓN SATET<br>BASE<br>RETENCIÓN</td>
                    <td style="width:20%;">Nº COMPROBANTE DE RETENCIÓN<br>Nº TRANSFERENCIA</td>
                    <td style="width:20%;">BASE I.V.A.<br>TOTAL<br>RET. I.V.A</td>
                    <td style="width:20%; font-weight: bold; text-align: right; vertical-align: bottom;">MONTO A PAGAR<br>{{ $orden->monto_total }}</td> 
                </tr>
                <tr>
                    <td>0</td>
                    <td>96779969</td> 
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div class="firmas">
                <table style="width:100%; border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 1px solid #000; width: 45%; padding-top: 5px;">ADMINISTRADOR<br>LCDO. GUIDO PEREZ</td> 
                        <td style="width: 10%;"></td>
                        <td style="border-top: 1px solid #000; width: 45%; padding-top: 5px;">PRESIDENTE<br>LCDO. MANUEL MARQUEZ</td>
                    </tr>
                </table>
            </div>

            <div class="observaciones">
                OBSERVACIONES:
            </div>
        </div> 

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('btnImprimir').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('btnDescargarPDF').addEventListener('click', function() {
            const elemento = document.getElementById('documentoAPDF');
            const nombreArchivo = 'Orden-Pago-{{ $orden->numero_orden }}.pdf';
            
            var opt = {
                
                margin: [0.4, 0.5, 0.4, 0.5], 
                filename: nombreArchivo,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 3, useCORS: true }, 
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().from(elemento).set(opt).save();
        });
    </script>
</body>
</html>
