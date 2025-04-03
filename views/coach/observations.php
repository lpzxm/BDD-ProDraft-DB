<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mockup con Observaciones y Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .modal-overlay {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 10; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .close-button {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                        <a href="./index_coach.php" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
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
                        <a href="./evaluate_player.php" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 4v-4m3 2v-6m2 10h.01M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Evaluación
                        </a>
                        <a href="./categories.php" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Categorías
                        </a>
                        <a href="./observations.php" class="flex items-center py-2 px-3 rounded-md bg-gray-200 text-gray-800 mb-1">
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
                    <h2 class="text-xl font-semibold">Observaciones</h2>
                    <button id="openModalBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Nueva Observacion
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div>
                        <textarea class="w-full h-24 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Type your comment here"></textarea>
                    </div>

                    <div class="mt-4 space-y-4">
                        <div class="bg-gray-100 rounded-md p-4">
                            <div class="flex items-start space-x-4">
                                <img src="../img/coach/random.png" alt="Sofia Gutierrez" class="rounded-full w-8 h-8">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="font-semibold text-gray-800">Sofia Gutierrez</h3>
                                        <span class="text-gray-500 text-sm">Hace 1 hora</span>
                                    </div>
                                    <p class="text-gray-700">No presento un Excelente Comportamiento</p>
                                    <p class="text-gray-600 text-sm">Categoria sub16 futbol</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-100 rounded-md p-4">
                            <div class="flex items-start space-x-4">
                                <img src="../img/coach/random.png" alt="Sophey Paul" class="rounded-full w-8 h-8">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="font-semibold text-gray-800">Sophey Paul</h3>
                                        <span class="text-gray-500 text-sm">Hace 1 hora</span>
                                    </div>
                                    <p class="text-gray-700">No presento un Excelente Comportamiento</p>
                                    <p class="text-gray-600 text-sm">Categoria sub16 futbol</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-100 rounded-md p-4">
                            <div class="flex items-start space-x-4">
                                <img src="../img/coach/random.png" alt="John Selese" class="rounded-full w-8 h-8">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="font-semibold text-gray-800">John Selese</h3>
                                        <span class="text-gray-500 text-sm">Hace 1 hora</span>
                                    </div>
                                    <p class="text-gray-700">No presento un Excelente Comportamiento</p>
                                    <p class="text-gray-600 text-sm">Categoria sub16 futbol</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-grow"></div>
            </main>
        </div>
    </div>

    <div id="newObservationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-semibold">Nueva Observacion</h2>
                <span class="close-button" id="closeModalBtn">&times;</span>
            </div>
            <div class="mb-4">
                <label for="observacion" class="block text-gray-700 text-sm font-bold mb-2">Observacion</label>
                <input type="text" id="observacion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="de" class="block text-gray-700 text-sm font-bold mb-2">DE</label>
                    <div class="relative">
                        <select id="de" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option>Prto Magno</option>
                            <option>Otro</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="para" class="block text-gray-700 text-sm font-bold mb-2">Para</label>
                    <input type="text" id="para" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
                </div>
            </div>
            <div class="flex justify-end">
                <button id="cancelModalBtn" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mr-2">
                    Cancelar
                </button>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    Guardar
                </button>
            </div>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const newObservationModal = document.getElementById('newObservationModal');

        openModalBtn.addEventListener('click', () => {
            newObservationModal.style.display = 'block';
        });

        closeModalBtn.addEventListener('click', () => {
            newObservationModal.style.display = 'none';
        });

        cancelModalBtn.addEventListener('click', () => {
            newObservationModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target == newObservationModal) {
                newObservationModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>