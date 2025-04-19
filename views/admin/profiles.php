<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles - Dashboard</title>
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
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-16.39-2.128a3.375 3.375 0 0 1 6.39-.372zm0-5.25a3.375 3.375 0 0 1 6.39.372m-6.39 2.128a9.38 9.38 0 0 0 2.625-.372m9.9-2.128a3.375 3.375 0 0 1 6.39-.372m-6.39 5.25a3.375 3.375 0 0 1 6.39-.372m-3.98-11.008a13.024 13.024 0 0 1 3.495 0" />
                </svg>
                Entrenadores
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                Categorias
            </a>
            <a href="#" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
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
            <h2 class="text-xl font-semibold text-gray-800">Perfiles</h2>
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

        <main class="p-6">
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Filtro</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="nombre_filtro" class="block text-gray-600 text-sm font-medium mb-2">Nombre</label>
                        <input type="text" id="nombre_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="apellidos_filtro" class="block text-gray-600 text-sm font-medium mb-2">Apellidos</label>
                        <div class="relative">
                            <select id="apellidos_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option>Todos</option>
                                <option>Galdamez</option>
                                </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="deporte_filtro" class="block text-gray-600 text-sm font-medium mb-2">Deporte</label>
                        <input type="text" id="deporte_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="categoria_filtro" class="block text-gray-600 text-sm font-medium mb-2">Categoría</label>
                        <input type="text" id="categoria_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-3 flex justify-end space-x-2">
                        <button class="bg-white hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Borrar
                        </button>
                        <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <div class="px-4 py-3 sm:px-6 flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Lista de Perfiles
                    </h3>
                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nuevo Perfil
                    </button>
                </div>
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                September 9, 2023
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                December 29, 2023
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                                    <img src="https://via.placeholder.com/30" alt="Profile Avatar" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Juan Jose Galdamez
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
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>