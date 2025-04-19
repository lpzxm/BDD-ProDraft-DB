<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observaciones - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for active sidebar link */
        .sidebar-link.active {
            background-color: #6d28d9; /* Example active color */
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex font-sans">

    <aside class="bg-indigo-700 text-white w-64 flex flex-col p-4">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold">Your Brand</h1>
        </div>
        <nav class="flex-1">
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2 12 3-3m0 6-3-3M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Inicio
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-16.39-2.128a3.375 3.375 0 0 1 6.39-.372zm0-5.25a3.375 3.375 0 0 1 6.39.372m-6.39 2.128a9.38 9.38 0 0 0 2.625-.372m9.9-2.128a3.375 3.375 0 0 1 6.39.372m-6.39 5.25a3.375 3.375 0 0 1 6.39-.372m-3.98-11.008a13.024 13.024 0 0 1 3.495 0" />
                </svg>
                Entrenadores
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                Categorias
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.125a15.63 15.63 0 0 1 15.998-7.5M4.501 20.125a15.65 15.65 0 0 0-2.25-3.75c-1.034-1.94-2.285-3.482-4.112-4.636m15.998-7.5a15.63 15.63 0 0 1-15.998 7.5M19.5 10.125a15.657 15.657 0 0 0 2.25-3.75c1.034-1.94 2.285-3.482 4.112-4.636" />
                </svg>
                Perfiles
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.704 14.21 14.21 0 0 1 13.053-5.457.999.999 0 0 1 .708 0l3.96 3.96a.999.999 0 0 1 0 1.414l-7.07 7.07a.999.999 0 0 1-.707 0 14.21 14.21 0 0 1-13.053 5.457.999.999 0 0 1-.708 0Z" />
                </svg>
                Observaciones
            </a>
        </nav>
        <button class="mt-8 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Salir
        </button>
    </aside>

    <div class="flex-1 overflow-x-auto bg-gray-100">
        <header class="bg-white py-4 px-6 shadow-md flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Observaciones</h2>
            <div class="flex items-center space-x-4">
                <div class="relative flex-grow max-w-md">
                    <input type="text" class="bg-gray-100 border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm w-full" placeholder="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/30" alt="User Avatar" class="w-8 h-8 rounded-full object-cover">
                    <span class="ml-2 text-gray-700 text-sm">Prof. Magno</span>
                </div>
            </div>
        </header>

        <main class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://via.placeholder.com/40" alt="Sofia Gutierrez" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700">Sofia Gutierrez</h4>
                        <p class="text-xs text-gray-500">Hace 1 hora</p>
                    </div>
                    <div class="flex-grow text-right">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4zM10 2a2 2 0 100-4 2 2 0 000 4zM10 22a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-gray-800 mb-2">No presento un Excelente Comportamiento</p>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">Categoria sub15 futbol</span>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://via.placeholder.com/40" alt="Sophey Paul" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700">Sophey Paul</h4>
                        <p class="text-xs text-gray-500">Hace 1 hora</p>
                    </div>
                    <div class="flex-grow text-right">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4zM10 2a2 2 0 100-4 2 2 0 000 4zM10 22a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-gray-800 mb-2">No presento un Excelente Comportamiento</p>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">Categoria sub15 futbol</span>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://via.placeholder.com/40" alt="John Selee" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700">John Selee</h4>
                        <p class="text-xs text-gray-500">Hace 1 hora</p>
                    </div>
                    <div class="flex-grow text-right">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4zM10 2a2 2 0 100-4 2 2 0 000 4zM10 22a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-gray-800 mb-2">No presento un Excelente Comportamiento</p>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">Categoria sub15 futbol</span>
            </div>

            <div class="lg:col-span-3 bg-indigo-700 shadow-md rounded-lg p-6 text-white flex items-center justify-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Nueva Observacion
                    </button>
                </div>
            </div>
        </main>
    </div>

</body>
</html>