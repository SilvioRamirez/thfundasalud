<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificación Planilla ARC</title>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .verification-container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        .verification-header {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .verification-header h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: 700;
        }
        
        .verification-body {
            padding: 30px;
        }
        
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #16a34a;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        
        .info-card h4 {
            color: #16a34a;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .info-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            width: 200px;
            color: #495057;
        }
        
        .info-value {
            flex: 1;
            color: #212529;
        }
        
        .table-custom {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        
        .table-custom thead {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
        }
        
        .table-custom th,
        .table-custom td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }
        
        .table-custom tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .table-custom tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .total-row {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
            color: white;
            font-weight: bold;
        }
        
        .deducciones-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        
        .deduccion-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        
        .deduccion-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .deduccion-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #dc2626;
        }
        
        .verified-badge {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
        }
        
        .text-right {
            text-align: right;
        }
        
        @media (max-width: 768px) {
            .deducciones-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @php
        $meses = [
            1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL',
            5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO',
            9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
        ];
    @endphp

    <div class="verification-container">
        <div class="verification-header">
            <i class="fa fa-check-circle fa-3x mb-3"></i>
            <h1>Planilla ARC Verificada</h1>
            <p>Fundación Trujillana de la Salud</p>
        </div>
        
        <div class="verification-body">
            <div class="text-center">
                <span class="verified-badge">
                    <i class="fa fa-shield-alt"></i> Documento Válido y Verificado
                </span>
            </div>
            
            <!-- Información del Trabajador -->
            <div class="info-card">
                <h4><i class="fa fa-user"></i> Información del Trabajador</h4>
                <div class="info-row">
                    <span class="info-label">Cédula:</span>
                    <span class="info-value">{{ $trabajadorCedula->cedula }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value">{{ $trabajadorCedula->nombre }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Cargo:</span>
                    <span class="info-value">{{ $trabajadorCedula->cargo }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Código RAC:</span>
                    <span class="info-value">{{ $trabajadorCedula->codigo_rac ?? '***' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Año:</span>
                    <span class="info-value">{{ $ano }}</span>
                </div>
            </div>
            
            <!-- Deducciones de Ley -->
            <div class="info-card">
                <h4><i class="fa fa-calculator"></i> Deducciones de Ley</h4>
                <div class="deducciones-grid">
                    <div class="deduccion-item">
                        <div class="deduccion-label">S.S.O.</div>
                        <div class="deduccion-value">{{ formatear_moneda($deduccionesLey['sso']) }}</div>
                    </div>
                    <div class="deduccion-item">
                        <div class="deduccion-label">Paro Forzoso</div>
                        <div class="deduccion-value">{{ formatear_moneda($deduccionesLey['paro_forzoso']) }}</div>
                    </div>
                    <div class="deduccion-item">
                        <div class="deduccion-label">Fondo de Jubilación</div>
                        <div class="deduccion-value">{{ formatear_moneda($deduccionesLey['fondo_jubilacion']) }}</div>
                    </div>
                    <div class="deduccion-item">
                        <div class="deduccion-label">Fondo Vivienda y Hábitat (FAOV)</div>
                        <div class="deduccion-value">{{ formatear_moneda($deduccionesLey['faov']) }}</div>
                    </div>
                    <div class="deduccion-item">
                        <div class="deduccion-label">Impuesto sobre la Renta</div>
                        <div class="deduccion-value">{{ formatear_moneda($deduccionesLey['impuesto_renta']) }}</div>
                    </div>
                    <div class="deduccion-item" style="background: #fef2f2;">
                        <div class="deduccion-label">Total Deducciones de Ley</div>
                        <div class="deduccion-value" style="color: #991b1b;">{{ formatear_moneda($totalDeduccionesLey) }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Tabla de Meses -->
            <div class="info-card">
                <h4><i class="fa fa-calendar-alt"></i> Detalle Mensual de Asignaciones</h4>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th class="text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meses as $numMes => $nombreMes)
                            <tr>
                                <td>{{ $nombreMes }}</td>
                                <td class="text-right">{{ formatear_moneda($datosMensuales[$numMes]) }}</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td><strong>TOTAL ANUAL</strong></td>
                            <td class="text-right"><strong>{{ formatear_moneda($totalAnualAsignaciones) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-info mt-4">
                <i class="fa fa-info-circle"></i>
                <strong>Información:</strong> Esta planilla es válida solo con el sello y firma de la Dirección de Recursos Humanos de FUNDASALUD.
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-home"></i> Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</body>
</html>
