<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Generales</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
                /* Hide links on smaller screens */
                flex-direction: column;
                position: absolute;
                top: 60px;
                /* Adjust based on header height */
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
        }
        .progress-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(#4f46e5 23%, #e5e7eb 0%);
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
        .header-section {
            background: linear-gradient(135deg, #6b46c1 0%, #805ad5 100%);
            color: white;
            border-radius: 12px;
        }
        .day-progress {
            position: relative;
        }
        .day-progress::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #e9d8fd;
            border-radius: 2px;
        }
        .filter-btn {
            transition: all 0.3s ease;
        }
        .filter-btn.active {
            background-color: white;
            color: #6b46c1;
            font-weight: 600;
        }
        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
            }
            .stat-card {
                width: 100%;
                margin-bottom: 1rem;
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
        <div class="font-bold text-xl text-gray-800">Our Brand</div>
        <div class="flex items-center">
            <!-- HACER CODE QUE CUANDO ESTE LOGEADO DESAPAREZCA O ESTE EL LOGPUT -->
            <a href="login.php"
                class="mr-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-300">
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
                    <a href="categories.php">Cattegories</a>
                    <a href="statistics.php">Stadisticas</a>
                    <a href="profile.php">Profile</a>
                </div>
            </nav>
        </div>
    </header>
    <div class="max-w-6xl mx-auto">
        <div class="header-section p-6 mb-6 shadow-lg">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold mb-1">Estadísticas</h1>
                    <h2 class="text-xl font-semibold opacity-90">Estadísticas Generales</h2>
                </div>
                <div class="flex flex-col w-full md:w-auto">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium opacity-90">Filtros:</span>
                        <div class="filters-container flex space-x-2">
                            <button class="filter-btn active bg-white text-purple-600 px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-purple-50 transition-all">
                                Diario
                            </button>
                            <button class="filter-btn bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-purple-700 transition-all">
                                Semanal
                            </button>
                            <button class="filter-btn bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-purple-700 transition-all">
                                Mensual
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-end space-x-3">
                        <span class="text-sm font-medium opacity-90">Periodo:</span>
                        <button class="bg-white text-purple-600 px-3 py-1 rounded-full text-sm font-semibold shadow-sm hover:bg-purple-50 transition-all">
                            ← Mayo →
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row gap-6 stats-container">
            <div class="stat-card p-6 flex-1">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Bounce Rate</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">Semanal</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Martes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">3%</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 40%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">4%</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Jueves</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" style="width: 50%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">5%</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle">
                        <div class="progress-inner text-purple-600">
                            23%
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">23%</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                            Desde ayer
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card p-6 flex-1">
                <div class="flex justify-between items-center mb-6 day-progress">
                    <h4 class="font-semibold text-gray-700 text-lg">Tiempo promedio</h4>
                    <div class="flex space-x-2">
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Diario</span>
                    </div>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Martes</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">23m</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Miércoles</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">31m</div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-16 text-sm text-gray-600 font-medium">Jueves</div>
                        <div class="flex-1 bg-gray-100 h-2 rounded-full mx-3">
                            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                        <div class="w-8 text-right text-sm font-medium text-gray-700">42m</div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="progress-circle" style="background: conic-gradient(#3182ce 65%, #e5e7eb 0%);">
                        <div class="progress-inner text-blue-600">
                            65%
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">23%</p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1"></span>
                            Desde ayer
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                    b.classList.add('bg-purple-600', 'text-white');
                    b.classList.remove('bg-white', 'text-purple-600');
                });
                
                this.classList.add('active');
                this.classList.remove('bg-purple-600', 'text-white');
                this.classList.add('bg-white', 'text-purple-600');
                
                const filterType = this.textContent.trim();
                console.log(`Filtro seleccionado: ${filterType}`);
                
            });
        });
    </script>
</body>
</html>