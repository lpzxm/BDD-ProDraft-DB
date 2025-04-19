<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenadores - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for active sidebar link */
        .sidebar-link.active {
            background-color: #6d28d9; /* Example active color */
            color: white;
        }
        /* Custom styles for the table header icons */
        .sort-icon {
            width: 1em;
            height: 1em;
            margin-left: 0.5em;
            display: inline-block;
            vertical-align: middle;
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
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
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
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
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

    <div class="flex-1 overflow-x-auto overflow-y-auto bg-gray-100">
        <header class="bg-white py-4 px-6 shadow-md flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Entrenadores</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <button class="bg-white border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-700 focus:outline-none">
                        Todos
                    </button>
                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md ml-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nuevo
                    </button>
                </div>
                <div class="relative">
                    <input type="text" class="bg-gray-100 border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" placeholder="Search">
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

        <main class="p-6">
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Imagen
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Última Fecha
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="sort-icon">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                September 8, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                August 2, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                September 24, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                December 29, 2022
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                May 20, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                May 31, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                February 29, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                October 24, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                November 7, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                May 29, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30" alt="Trainer Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Prof. Magno
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                July 14, 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                sidebarLinks.forEach(otherLink => {
                    otherLink.classList.remove('active');
                });
                link.classList.add('active');
                // You can add logic here to load content based on the clicked link
            });
        });
    </script>

</body>
</html>