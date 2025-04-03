<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mockup con Cards y Botón Agregar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Basic styles for card layout */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Adjust minmax as needed */
            gap: 1rem;
        }

        .player-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            text-align: center;
        }

        .player-card img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 0.5rem;
        }

        .player-card h3 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        .player-card p {
            font-size: 0.875rem;
            color: #6b7280; /* text-gray-600 */
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <div class="flex">
        <aside class="bg-white rounded-lg shadow-md w-64 p-4 mr-4 flex flex-col justify-between">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="../img/coach/profile.jpeg" alt="Avatar" class="rounded-full w-8 h-8 mr-2">
                        <span class="font-semibold">Juan Jose</span>
                    </div>
                    <div class="relative mb-4">
                        <input type="text" class="w-full bg-gray-100 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Buscador">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-6a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <nav>
                        <a href="./index_coach.php" class="flex items-center py-2 px-3 rounded-md bg-gray-200 text-gray-800 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 01-1-1h-2a1 1 0 00-1 1v4a1 1 0 011 1m-6 0h2" />
                            </svg>
                            Inicio
                        </a>
                        <a href="./add_player.php" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7.304a6 6 0 00-4-3.297m5 5.197h-2a12.013 12.013 0 01-3-5.197m5 5.197l-2-2.286m2 2.286l3.64-3.648m-3.64 3.648l-3.64-3.648" />
                            </svg>
                            Jugadores
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 4v-4m3 2v-6m2 10h.01M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Evaluacion
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Categorias
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Asistencia <span class="ml-1 text-sm text-gray-500"></span>
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7 1.274 4.057-2.515 7-7 7a7.003 7.003 0 01-6.542-7z" />
                            </svg>
                            Observaciones
                        </a>
                    </nav>
                </div>
                <button class="bg-red-600 text-white rounded-md py-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cerrar sesión
                </button>
            </aside>

            <main class="flex-1 flex flex-col">
                <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Jugadores</h2>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Agregar
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <div class="card-grid">
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 1">
                            <h3>Juan Jose</h3>
                            <p>Delantero</p>
                        </div>
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 2">
                            <h3>Juan Jose</h3>
                            <p>Mediocampista</p>
                        </div>
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 3">
                            <h3>Juan Jose</h3>
                            <p>Defensa</p>
                        </div>
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 4">
                            <h3>Juan Jose</h3>
                            <p>Portero</p>
                        </div>
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 5">
                            <h3>Juan Jose</h3>
                            <p>Delantero</p>
                        </div>
                        <div class="player-card">
                            <img src="../img/coach/random.png" alt="Player 6">
                            <h3>Juan Jose</h3>
                            <p>Mediocampista</p>
                        </div>
                    </div>
                </div>

                <div class="flex-grow"></div>
            </main>
        </div>
    </div>
</body>
</html>