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
        /* Modal Styles */
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
            margin: 15% auto; /* More centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px; /* Added a maximum width */
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

        .modal-body {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group input[type="password"],
        .form-group textarea,
        .form-group select,
        .form-group input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-sizing: border-box;
            font-size: 1rem;
            color: #374151;
            focus:outline-none focus:ring-2 focus:ring-indigo-500;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .modal-footer button {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .modal-footer .cancel-button {
            background-color: #6b7280;
        }

        .modal-footer .cancel-button:hover {
            background-color: #4a5568;
        }

        .modal-footer .save-button {
            background-color: #6366f1;
        }

        .modal-footer .save-button:hover {
            background-color: #4f46e5;
        }

        /* Style for the file input to make it look better */
        .form-group input[type="file"] {
            padding: 0.5rem;
            border: 1px dashed #d1d5db;
            background-color: #f9fafb;
            display: flex;
            align-items: center;
        }

        .form-group input[type="file"]::-webkit-file-upload-button {
            background-color: #e5e7eb;
            border: none;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 0.5rem;
        }

        .form-group input[type="file"]::file-selector-button {
            background-color: #e5e7eb;
            border: none;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 0.5rem;
        }

        /* Style for the delete modal */
        .delete-modal-content {
            background-color:rgb(254, 254, 254);
            margin: 20% auto; /* Slightly lower for delete modal */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px; /* Smaller max width for delete modal */
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        .delete-modal-header {
            margin-bottom: 1rem;
        }

        .delete-modal-body {
            margin-bottom: 1.5rem;
            color: #374151;
        }

        .delete-modal-actions {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        .delete-modal-actions button {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .delete-modal-actions .confirm-delete-button {
            background-color: #dc2626; /* Red color for delete */
        }

        .delete-modal-actions .confirm-delete-button:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex font-sans">

<aside class="bg-indigo-700 text-white w-64 flex flex-col p-4">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold">Your Brand</h1>
        </div>
        <nav class="flex-1">
            <a href="./index.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2 12 3-3m0 6-3-3M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Inicio
            </a>
            <a href="./trainers.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-16.39-2.128a3.375 3.375 0 0 1 6.39-.372zm0-5.25a3.375 3.375 0 0 1 6.39.372m-6.39 2.128a9.38 9.38 0 0 0 2.625-.372m9.9-2.128a3.375 3.375 0 0 1 6.39.372m-6.39 5.25a3.375 3.375 0 0 1 6.39-.372m-3.98-11.008a13.024 13.024 0 0 1 3.495 0" />
                </svg>
                Entrenadores
            </a>
            <a href="./categories.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
                Categorias
            </a>
            <a href="./profiles.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.125a15.63 15.63 0 0 1 15.998-7.5M4.501 20.125a15.65 15.65 0 0 0-2.25-3.75c-1.034-1.94-2.285-3.482-4.112-4.636m15.998-7.5a15.63 15.63 0 0 1-15.998 7.5M19.5 10.125a15.657 15.657 0 0 0 2.25-3.75c1.034-1.94 2.285-3.482 4.112-4.636" />
                </svg>
                Perfiles
            </a>
            <a href="./observations.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
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
            <h2 class="text-xl font-semibold text-gray-800">Entrenadores</h2>
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
                        <input type="text" id="apellidos_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="deporte_filtro" class="block text-gray-600 text-sm font-medium mb-2">Deporte</label>
                        <input type="text" id="deporte_filtro" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
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
                        Lista de Entrenadores
                    </h3>
                    <button id="openNewTrainerModalBtn" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nuevo Entrenador
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
                                Apellidos
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deporte
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Eliminar</span>
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
                                Ricardo
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Pérez
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Fútbol
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="1" class="editTrainerBtn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="1" class="deleteTrainerBtn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
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
                                Laura
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Gómez
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Baloncesto
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="2" class="editTrainerBtn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="2" class="deleteTrainerBtn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
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
                                Carlos
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                López
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Natación
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="3" class="editTrainerBtn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button data-trainer-id="3" class="deleteTrainerBtn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">Eliminar</button>
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </main>

        <div id="newTrainerModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-xl font-semibold text-gray-800">Nuevo Entrenador</h2>
                    <span id="closeNewTrainerModalBtn" class="close-button">&times;</span>
                </div>
                <div class="modal-body">
                    <form class="space-y-4">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" id="apellido" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Apellido">
                        </div>
                        <div class="form-group">
                            <label for="deporte">Deporte</label>
                            <input type="text" id="deporte" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Deporte">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" id="imagen" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="cancelNewTrainerModalBtn" type="button" class="cancel-button">Cancelar</button>
                    <button id="saveNewTrainerModalBtn" type="button" class="save-button">Guardar</button>
                </div>
            </div>
        </div>

        <div id="editTrainerModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-xl font-semibold text-gray-800">Editar Entrenador</h2>
                    <span id="closeEditTrainerModalBtn" class="close-button">&times;</span>
                </div>
                <div class="modal-body">
                    <form class="space-y-4">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre</label>
                            <input type="text" id="edit_nombre" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="edit_apellido">Apellido</label>
                            <input type="text" id="edit_apellido" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Apellido">
                        </div>
                        <div class="form-group">
                            <label for="edit_deporte">Deporte</label>
                            <input type="text" id="edit_deporte" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Deporte">
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" id="edit_email" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="edit_telefono">Teléfono</label>
                            <input type="text" id="edit_telefono" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <label for="edit_imagen">Imagen</label>
                            <input type="file" id="edit_imagen" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">
                            <img id="current_imagen" src="" alt="Current Trainer Image" class="mt-2 max-h-32 object-contain">
                        </div>
                        <input type="hidden" id="edit_trainer_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="cancelEditTrainerModalBtn" type="button" class="cancel-button">Cancelar</button>
                    <button id="saveEditTrainerModalBtn" type="button" class="save-button">Guardar Cambios</button>
                </div>
            </div>
        </div>

        <div id="deleteTrainerModal" class="modal-overlay">
            <div class="delete-modal-content">
                <div class="delete-modal-header">
                    <h2 class="text-xl font-semibold text-gray-800">Eliminar Entrenador</h2>
                </div>
                <div class="delete-modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este entrenador?</p>
                    <p class="font-semibold"><span id="delete_trainer_name"></span></p>
                    <input type="hidden" id="delete_trainer_id">
                </div>
                <div class="delete-modal-actions">
                    <button id="cancelDeleteTrainerModalBtn" type="button" class="cancel-button">Cancelar</button>
                    <button id="confirmDeleteTrainerModalBtn" type="button" class="confirm-delete-button">Eliminar</button>
                </div>
            </div>
        </div>
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

        // Modal functionality for New Trainer
        const openNewTrainerModalBtn = document.getElementById('openNewTrainerModalBtn');
        const closeNewTrainerModalBtn = document.getElementById('closeNewTrainerModalBtn');
        const cancelNewTrainerModalBtn = document.getElementById('cancelNewTrainerModalBtn');
        const newTrainerModal = document.getElementById('newTrainerModal');
        const saveNewTrainerModalBtn = document.getElementById('saveNewTrainerModalBtn');

        openNewTrainerModalBtn.addEventListener('click', () => {
            newTrainerModal.style.display = 'block';
        });

        const closeNewTrainerModal = () => {
            newTrainerModal.style.display = 'none';
        };

        closeNewTrainerModalBtn.addEventListener('click', closeNewTrainerModal);
        cancelNewTrainerModalBtn.addEventListener('click', closeNewTrainerModal);

        window.addEventListener('click', (event) => {
            if (event.target === newTrainerModal) {
                closeNewTrainerModal();
            }
        });

        saveNewTrainerModalBtn.addEventListener('click', () => {
            // Collect data from the form
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const deporte = document.getElementById('deporte').value;
            const email = document.getElementById('email').value;
            const telefono = document.getElementById('telefono').value;
            const imagen = document.getElementById('imagen').files[0];

            console.log('Guardar Entrenador:', { nombre, apellido, deporte, email, telefono, imagen });

            // Here you would typically send this data to your server

            // Close the modal after saving
            closeNewTrainerModal();
        });

        // Modal functionality for Edit Trainer
        const editTrainerModal = document.getElementById('editTrainerModal');
        const closeEditTrainerModalBtn = document.getElementById('closeEditTrainerModalBtn');
        const cancelEditTrainerModalBtn = document.getElementById('cancelEditTrainerModalBtn');
        const saveEditTrainerModalBtn = document.getElementById('saveEditTrainerModalBtn');
        const editTrainerButtons = document.querySelectorAll('.editTrainerBtn');

        editTrainerButtons.forEach(button => {
            button.addEventListener('click', () => {
                const trainerId = button.dataset.trainerId;
                // Fetch trainer data based on ID and populate the edit form
                document.getElementById('edit_trainer_id').value = trainerId;
                document.getElementById('edit_nombre').value = `Nombre del Entrenador ${trainerId}`; // Replace with actual data
                document.getElementById('edit_apellido').value = `Apellido del Entrenador ${trainerId}`; // Replace with actual data
                document.getElementById('edit_deporte').value = 'Deporte Ejemplo'; // Replace with actual data
                document.getElementById('edit_email').value = `email${trainerId}@example.com`; // Replace with actual data
                document.getElementById('edit_telefono').value = '123456789'; // Replace with actual data
                document.getElementById('current_imagen').src = 'https://via.placeholder.com/30'; // Replace with actual image path

                editTrainerModal.style.display = 'block';
            });
        });

        const closeEditTrainerModal = () => {
            editTrainerModal.style.display = 'none';
        };

        closeEditTrainerModalBtn.addEventListener('click', closeEditTrainerModal);
        cancelEditTrainerModalBtn.addEventListener('click', closeEditTrainerModal);

        window.addEventListener('click', (event) => {
            if (event.target === editTrainerModal) {
                closeEditTrainerModal();
            }
        });

        saveEditTrainerModalBtn.addEventListener('click', () => {
            const trainerId = document.getElementById('edit_trainer_id').value;
            const nombre = document.getElementById('edit_nombre').value;
            const apellido = document.getElementById('edit_apellido').value;
            const deporte = document.getElementById('edit_deporte').value;
            const email = document.getElementById('edit_email').value;
            const telefono = document.getElementById('edit_telefono').value;
            const imagen = document.getElementById('edit_imagen').files[0];

            console.log('Guardar Cambios Entrenador:', { trainerId, nombre, apellido, deporte, email, telefono, imagen });

            // Here you would typically send the updated data to your server

            closeEditTrainerModal();
        });

        // Modal functionality for Delete Trainer
        const deleteTrainerModal = document.getElementById('deleteTrainerModal');
        const closeDeleteTrainerModalBtn = document.getElementById('cancelDeleteTrainerModalBtn');
        const confirmDeleteTrainerModalBtn = document.getElementById('confirmDeleteTrainerModalBtn');
        const deleteTrainerButtons = document.querySelectorAll('.deleteTrainerBtn');
        const deleteTrainerName = document.getElementById('delete_trainer_name');
        const deleteTrainerIdInput = document.getElementById('delete_trainer_id');

        deleteTrainerButtons.forEach(button => {
            button.addEventListener('click', () => {
                const trainerId = button.dataset.trainerId;
                const trainerRow = button.closest('tr');
                const trainerName = trainerRow.querySelector('td:nth-child(3)').textContent + ' ' + trainerRow.querySelector('td:nth-child(4)').textContent;

                deleteTrainerIdInput.value = trainerId;
                deleteTrainerName.textContent = trainerName;
                deleteTrainerModal.style.display = 'block';
            });
        });

        const closeDeleteTrainerModal = () => {
            deleteTrainerModal.style.display = 'none';
        };

        closeDeleteTrainerModalBtn.addEventListener('click', closeDeleteTrainerModal);

        window.addEventListener('click', (event) => {
            if (event.target === deleteTrainerModal) {
                closeDeleteTrainerModal();
            }
        });

        confirmDeleteTrainerModalBtn.addEventListener('click', () => {
            const trainerIdToDelete = document.getElementById('delete_trainer_id').value;
            console.log('Eliminar Entrenador con ID:', trainerIdToDelete);

            // Here you would typically send the delete request to your server

            closeDeleteTrainerModal();
            // Optionally, remove the table row from the UI after successful deletion
            const rowToDelete = document.querySelector(`.deleteTrainerBtn[data-trainer-id="${trainerIdToDelete}"]`).closest('tr');
            if (rowToDelete) {
                rowToDelete.remove();
            }
        });
    </script>

</body>
</html>