<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Deportivas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .hamburger-menu {
            display: none;
            cursor: pointer;
            padding: 10px;
        }

        .line {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: 0.4s;
        }

        .open .line1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .open .line2 {
            opacity: 0;
        }

        .open .line3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 6rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-gray-700 hover: text-indigo-500 transition-colors;
        }

        @media (max-width: 768px) {
            .main-nav {
                padding: 1rem;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                background-color: #fff;
                width: 100%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                z-index: 10;
                gap: 1rem;
            }

            .nav-links.open {
                display: flex;
            }

            .hamburger-menu {
                display: block;
            }
        }
        
        .stat-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .header-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            border-radius: 12px;
        }
        
        .day-progress::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #dbeafe;
            border-radius: 2px;
        }
        
        .filter-btn {
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background-color: white;
            color: #2563eb;
            font-weight: 600;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .progress-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(#3b82f6 var(--percentage), #e5e7eb 0%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .progress-inner {
            width: 70%;
            height: 70%;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .stat-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .stat-badge.positive {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .stat-badge.negative {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .stat-badge.neutral {
            background-color: #e0e7ff;
            color: #4338ca;
        }
        
        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
            }
            
            .filters-container {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 p-6">
    <header class="main-nav flex justify-between items-center px-4 py-3">
        <div class="font-bold text-xl text-gray-800">Our Brand
        </div>
        <div class="flex items-center">
            <a href="login.php" class="mr-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-300">
                Login
            </a>

            <nav>
                <div class="hamburger-menu" id="hamburger">
                    <div class="line line1"></div>
                    <div class="line line2"></div>
                    <div class="line line3"></div>
                </div>
                <div class="nav-links" id="navLinks">
                    <a href="index.php">Home</a>
                    <a href="categories.php">Categorías</a>
                    <a href="statistics.php">Estadísticas</a>
                    <a href="profile.php">Perfil</a>
                </div>
            </nav>
        </div>
    </header>
    
    <div class="max-w-6xl mx-auto">
        <!-- Encabezado con información del atleta -->
        <div class="header-section p-6 mb-6 shadow-lg flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mr-4">
                    <span class="text-2xl font-bold text-blue-700">AP</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Ana Pérez</h1>
                    <p class="text-blue-100">Mujer • Fútbol</p>
                </div>
            </div>
            
            <div class="flex space-x-4">
                <div class="text-center">
                    <p class="text-sm text-blue-200">Partidos</p>
                    <p class="text-xl font-bold">24</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-blue-200">Goles</p>
                    <p class="text-xl font-bold">12</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-blue-200">Asistencias</p>
                    <p class="text-xl font-bold">8</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Rendimiento Deportivo</h2>
                
                <div class="flex flex-col w-full md:w-auto space-y-3 md:space-y-0 md:space-x-3">
                    <div class="filters-container flex flex-wrap gap-2">
                        <button class="filter-btn active bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-blue-50 transition-all">
                            Últimos 7 días
                        </button>
                        <button class="filter-btn bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-blue-700 transition-all">
                            Últimos 30 días
                        </button>
                        <button class="filter-btn bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-blue-700 transition-all">
                            Temporada
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-lg text-gray-800">Rendimiento en Partidos</h3>
                 
                </div>
                <div class="chart-container">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
            
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-lg text-gray-800">Distribución de Goles</h3>
                    <span class="stat-badge neutral">Últimos 10 partidos</span>
                </div>
                <div class="chart-container">
                // se llama a la grafica con un canvas

                    <canvas id="goalsChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Tiempo de Juego</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Promedio</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Lunes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">65'</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 80%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">80'</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Viernes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">72'</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle" style="--percentage: 72%">
                        <div class="progress-inner text-blue-600">
                            72%
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">72'</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                            actualizado                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Eficacia de Tiros</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Precisión</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Lunes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">45%</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">60%</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Viernes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 52%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">52%</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle" style="--percentage: 52%; background: conic-gradient(#10b981 52%, #e5e7eb 0%)">
                        <div class="progress-inner text-green-600">
                            52%
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">52%</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1"></span>
                            actualizado                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Distancia Recorrida</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">KM</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Lunes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">7.0</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">8.5</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Viernes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 78%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">7.8</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle" style="--percentage: 78%; background: conic-gradient(#8b5cf6 78%, #e5e7eb 0%)">
                        <div class="progress-inner text-purple-600">
                            78%
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">7.8km</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                            actualizado                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card p-6">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Faltas Cometidas</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Promedio</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Lunes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-red-400 to-red-600 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">3</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-red-400 to-red-600 h-2 rounded-full" style="width: 50%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">5</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Viernes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-red-400 to-red-600 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">2</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle" style="--percentage: 33%; background: conic-gradient(#ef4444 33%, #e5e7eb 0%)">
                        <div class="progress-inner text-red-600">
                            3.3
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">3.3</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                            actualizado
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');
        
        hamburger.addEventListener('click', function() {
            this.classList.toggle('open');
            navLinks.classList.toggle('open');
        });
        
        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                    b.classList.add('bg-blue-600', 'text-white');
                    b.classList.remove('bg-white', 'text-blue-600');
                });
                
                this.classList.add('active');
                this.classList.remove('bg-blue-600', 'text-white');
                this.classList.add('bg-white', 'text-blue-600');
                
                const filterType = this.textContent.trim();
                console.log(`Filtro seleccionado: ${filterType}`);
            });
        });
        
        // GRAFICA SOLO FALTA LLAMAR LOS DATOS DE LA BD
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6'],
                datasets: [{
                    label: 'Puntuación de Rendimiento',
                    data: [65, 72, 70, 78, 82, 85],
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgba(37, 99, 235, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 50,
                        max: 100,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // GRAFICA SOLO FALTA LLAMAR LOS DATOS DE LA BD
        const goalsCtx = document.getElementById('goalsChart').getContext('2d');
        const goalsChart = new Chart(goalsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tiros libres', 'Penales', 'Dentro del área', 'Fuera del área'],
                datasets: [{
                    data: [2, 3, 5, 2],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>
</html>