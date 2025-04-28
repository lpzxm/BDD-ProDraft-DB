<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Jugador - Sub17</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .player-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        
        .metric-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #f3f4f6;
            transition: all 0.2s ease;
        }
        
        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-color: #e5e7eb;
        }
        
        .metric-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 10px;
            font-weight: 600;
            background: linear-gradient(135deg, #f0f4ff 0%, #e6edff 100%);
            color: #2563eb;
            border: 1px solid #dbeafe;
        }
        
        .data-table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .data-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table td {
            border-bottom: 1px solid #f3f4f6;
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .indicator-item {
            position: relative;
            padding-left: 1.5rem;
        }
        
        .indicator-item:before {
            content: "";
            position: absolute;
            left: 0.5rem;
            top: 0.75rem;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #3b82f6;
        }
        
        .time-slot {
            position: relative;
            padding-left: 1.25rem;
        }
        
        .time-slot:before {
            content: "→";
            position: absolute;
            left: 0;
            color: #9ca3af;
            font-weight: bold;
        }
        
        .section-divider {
            border-top: 1px dashed #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-5xl mx-auto p-6">
        <div class="player-card p-8 mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-8">
                <div class="w-40 h-40 rounded-xl bg-gray-100 overflow-hidden border-4 border-white shadow-md">
                    <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&h=400&q=80" 
                         alt="Jugador Sub17" 
                         class="w-full h-full object-cover">
                </div>
                
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Juan Jose</h1>
                    <p class="text-lg text-gray-600 mb-4">Delantero - Categoría Sub17</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Edad</p>
                            <p class="font-medium">16 años</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Altura</p>
                            <p class="font-medium">1.78 m</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Peso</p>
                            <p class="font-medium">68 kg</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dorsal</p>
                            <p class="font-medium">#9</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="metric-card p-5">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Partidos Jugados</h3>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold">24</span>
                    <span class="metric-badge">92%</span>
                </div>
            </div>
            
            <div class="metric-card p-5">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Goles</h3>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold">18</span>
                    <span class="metric-badge">0.75</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Promedio por partido</p>
            </div>
            
            <div class="metric-card p-5">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Asistencias</h3>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold">12</span>
                    <span class="metric-badge">0.5</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Promedio por partido</p>
            </div>
            
            <div class="metric-card p-5">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Rendimiento</h3>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold">8.7</span>
                    <span class="metric-badge">+12%</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Mejora temporada</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="metric-card p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Asistencia a Entrenamientos</h2>
                    <p class="text-gray-600 mb-4">Registro de asistencia a sesiones de entrenamiento en los últimos 3 meses.</p>
                    
                    <div class="flex flex-wrap gap-3">
                        <div class="metric-badge">15</div>
                        <div class="metric-badge">16</div>
                        <div class="metric-badge">17</div>
                        <div class="metric-badge">18</div>
                        <div class="metric-badge">19</div>
                        <div class="metric-badge">20</div>
                        <div class="metric-badge">21</div>
                    </div>
                    
                    <div class="section-divider my-5"></div>
                    
                    <div>
                        <h3 class="font-medium text-gray-700 mb-2">Resumen</h3>
                        <p class="text-sm text-gray-600">
                            El jugador ha asistido al 92% de los entrenamientos programados, 
                            mostrando un excelente compromiso con el equipo. Las ausencias 
                            corresponden a compromisos académicos justificados.
                        </p>
                    </div>
                </div>
                
                <div class="metric-card p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Datos de Rendimiento</h2>
                    <p class="text-gray-600 mb-4">Métricas clave de los últimos 5 partidos oficiales.</p>
                    
                    <div class="overflow-x-auto">
                        <table class="data-table w-full">
                            <thead>
                                <tr>
                                    <th class="p-3 text-left">Indicador</th>
                                    <th class="p-3 text-center">Promedio</th>
                                    <th class="p-3 text-center">Último</th>
                                    <th class="p-3 text-center">Mejor</th>
                                    <th class="p-3 text-center">Tendencia</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">Distan. Recorrida (km)</td>
                                    <td class="p-3 text-center font-medium">8.2</td>
                                    <td class="p-3 text-center">8.7</td>
                                    <td class="p-3 text-center text-blue-600 font-medium">9.1</td>
                                    <td class="p-3 text-center text-green-500 font-medium">↑ 6%</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">Precisión Pase</td>
                                    <td class="p-3 text-center font-medium">78%</td>
                                    <td class="p-3 text-center">82%</td>
                                    <td class="p-3 text-center text-blue-600 font-medium">85%</td>
                                    <td class="p-3 text-center text-green-500 font-medium">↑ 4%</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">Duelos Ganados</td>
                                    <td class="p-3 text-center font-medium">63%</td>
                                    <td class="p-3 text-center">68%</td>
                                    <td class="p-3 text-center text-blue-600 font-medium">72%</td>
                                    <td class="p-3 text-center text-green-500 font-medium">↑ 5%</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">Remates a Puerta</td>
                                    <td class="p-3 text-center font-medium">3.2</td>
                                    <td class="p-3 text-center">4</td>
                                    <td class="p-3 text-center text-blue-600 font-medium">5</td>
                                    <td class="p-3 text-center text-green-500 font-medium">↑ 25%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="metric-card p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Indicadores Técnicos</h2>
                    <p class="text-gray-600 mb-4">Aspectos a mejorar según el cuerpo técnico.</p>
                    
                    <ul class="space-y-3">
                        <li class="indicator-item">
                            <p class="text-gray-700">Mejorar el timing de los desmarques</p>
                        </li>
                        <li class="indicator-item">
                            <p class="text-gray-700">Potenciar el remate con pierna izquierda</p>
                        </li>
                        <li class="indicator-item">
                            <p class="text-gray-700">Optimizar la toma de decisiones en presión</p>
                        </li>
                    </ul>
                    
                    <div class="section-divider my-5"></div>
                    
                    <div>
                        <h3 class="font-medium text-gray-700 mb-2">Progreso</h3>
                        <p class="text-sm text-gray-600">
                            El jugador muestra buena disposición para trabajar en sus aspectos 
                            débiles, con una mejora del 15% en los ejercicios específicos.
                        </p>
                    </div>
                </div>
                
                <div class="metric-card p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Horario de Entrenamiento</h2>
                    <p class="text-gray-600 mb-4">Próximas sesiones programadas.</p>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="font-medium text-gray-700">Lunes 12/06</p>
                            <p class="time-slot text-gray-600 ml-4">16:00 - 18:00 (Táctico)</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">Miércoles 14/06</p>
                            <p class="time-slot text-gray-600 ml-4">16:00 - 18:00 (Técnico)</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">Viernes 16/06</p>
                            <p class="time-slot text-gray-600 ml-4">10:00 - 12:00 (Físico)</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700">Sábado 17/06</p>
                            <p class="time-slot text-gray-600 ml-4">09:00 - 11:00 (Partido)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
    </div>
</body>
</html>