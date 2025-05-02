<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Dashboard</title>
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
            z-index: 20; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; /* Adjusted top margin */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 500px; /* Added a maximum width */
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
        .form-group textarea,
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
    </style>
</head>
<body class="bg-gray-100 h-screen flex font-sans">

<aside class="bg-indigo-700 text-white w-64 flex flex-col p-4">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold">Your Brand</h1>
    </div>
    <nav class="flex-1">
        <a href="./index.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
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
        <a href="./categories.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
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

<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
    <header class="bg-white py-4 px-6 shadow-md flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800">Categorias</h2>
        <div class="flex items-center space-x-4">
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
        <section class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Filtro</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                    <input type="text" id="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
                </div>
                <div>
                    <label for="entrenador" class="block text-gray-700 text-sm font-bold mb-2">Entrenador</label>
                    <select id="entrenador" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option>Prof. Magno</option>
                        <option>Otro Entrenador</option>
                    </select>
                </div>
                <div>
                    <label for="deporte" class="block text-gray-700 text-sm font-bold mb-2">Deporte</label>
                    <input type="text" id="deporte" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
                </div>
                <div>
                    <label for="categoria" class="block text-gray-700 text-sm font-bold mb-2">Categoria</label>
                    <input type="text" id="categoria" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search...">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                    Borrar
                </button>
                <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                    Borrar
                </button>
            </div>
        </section>

        <section class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Lista de Categorias</h3>
                <button id="openNewCategoryModalBtn" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nueva Categoria
                </button>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Participantes
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Encargado
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Ver</span>
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1 fill-current text-green-500" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Activo
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-name" data-category-id="1">
                            Futbol sub17
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-participants">
                            14
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-trainer">
                            Michael Bluemans
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">Ver</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 focus:outline-none edit-category-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93c-1.18 1.18-3.106 1.18-4.285 0L1.414 11.414a2 2 0 010-2.828l7.93-7.93c1.18-1.18 3.106-1.18 4.285 0z" />
                                    <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-red-600 hover:text-red-900 focus:outline-none delete-category-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V7a1 1 0 00-1-1zm7 9h-4a1 1 0 010-2h4a1 1 0 110 2z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1 fill-current text-green-500" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Activo
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-name" data-category-id="2">
                            Futbol sub18
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-participants">
                            7
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 category-trainer">
                            Michael Bluemans
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">Ver</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 focus:outline-none edit-category-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93c-1.18 1.18-3.106 1.18-4.285 0L1.414 11.414a2 2 0 010-2.828l7.93-7.93c1.18-1.18 3.106-1.18 4.285 0z" />
                                    <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-red-600 hover:text-red-900 focus:outline-none delete-category-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V7a1 1 0 00-1-1zm7 9h-4a1 1 0 010-2h4a1 1 0 110 2z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>

<div id="newCategoryModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Nueva Categoria</h2>
            <span class="close-button" id="closeNewCategoryModalBtn">&times;</span>
        </div>
        <div class="modal-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="categoryName">Nombre</label>
                    <input type="text" id="categoryName" placeholder="Ej: Sub 15">
                </div>
                <div class="form-group">
                    <label for="categoryDescription">Descripción</label>
                    <input type="text" id="categoryDescription" placeholder="Ej: Jugadores menores de 15 años">
                </div>
                <div class="form-group">
                    <label for="categoryRules">Reglas</label>
                    <textarea id="categoryRules" placeholder="Ingrese las reglas de la categoría"></textarea>
                </div>
                <div class="form-group">
                    <label for="categoryImage">Imagen</label>
                    <input type="file" id="categoryImage">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="cancelNewCategoryModalBtn" class="cancel-button">Cancelar</button>
            <button type="button" id="saveNewCategoryModalBtn" class="save-button">Guardar</button>
        </div>
    </div>
</div>

<div id="editCategoryModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-semibold text-gray-800">Editar Categoria</h2>
            <span id="closeEditCategoryModalBtn" class="close-button">&times;</span>
        </div>
        <div class="modal-body">
            <form class="space-y-4">
                <div class="form-group">
                    <label for="edit-category-name">Nombre</label>
                    <input type="text" id="edit-category-name" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Nombre de la categoría">
                </div>
                <div class="form-group">
                    <label for="edit-category-description">Descripción</label>
                    <input type="text" id="edit-category-description" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Descripción de la categoría">
                </div>
                <div class="form-group">
                    <label for="edit-category-rules">Reglas</label>
                    <textarea id="edit-category-rules" rows="3" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Reglas de la categoría"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-category-image">Imagen</label>
                    <input type="file" id="edit-category-image" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">
                </div>
                <input type="hidden" id="edit-category-id">
            </form>
        </div>
        <div class="modal-footer">
            <button id="cancelEditCategoryModalBtn" type="button" class="cancel-button">Cancelar</button>
            <button id="saveEditCategoryModalBtn" type="button" class="save-button">Guardar Cambios</button>
        </div>
    </div>
</div>

<div id="deleteCategoryConfirmationModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-xl font-semibold text-gray-800">Confirmar Eliminación</h2>
            <span id="closeDeleteCategoryModalBtn" class="close-button">&times;</span>
        </div>
        <div class="modal-body">
            <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
            <input type="hidden" id="delete-category-id">
        </div>
        <div class="modal-footer">
            <button id="cancelDeleteCategoryModalBtn" type="button" class="cancel-button">Cancelar</button>
            <button id="confirmDeleteCategoryModalBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-red-400">Eliminar</button>
        </div>
    </div>
</div>

<script>
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const openNewCategoryModalBtn = document.getElementById('openNewCategoryModalBtn');
    const closeNewCategoryModalBtn = document.getElementById('closeNewCategoryModalBtn');
    const cancelNewCategoryModalBtn = document.getElementById('cancelNewCategoryModalBtn');
    const newCategoryModal= document.getElementById('newCategoryModal');
    const editCategoryBtns = document.querySelectorAll('.edit-category-btn');
    const deleteCategoryBtns = document.querySelectorAll('.delete-category-btn');

    // Edit Modal Elements
    const editCategoryModal = document.getElementById('editCategoryModal');
    const closeEditCategoryModalBtn = document.getElementById('closeEditCategoryModalBtn');
    const cancelEditCategoryModalBtn = document.getElementById('cancelEditCategoryModalBtn');
    const saveEditCategoryModalBtn = document.getElementById('saveEditCategoryModalBtn');
    const editCategoryNameInput = document.getElementById('edit-category-name');
    const editCategoryDescriptionInput = document.getElementById('edit-category-description');
    const editCategoryRulesTextarea = document.getElementById('edit-category-rules');
    const editCategoryImageInput = document.getElementById('edit-category-image');
    const editCategoryIdInput = document.getElementById('edit-category-id');

    // Delete Modal Elements
    const deleteCategoryConfirmationModal = document.getElementById('deleteCategoryConfirmationModal');
    const closeDeleteCategoryModalBtn = document.getElementById('closeDeleteCategoryModalBtn');
    const cancelDeleteCategoryModalBtn = document.getElementById('cancelDeleteCategoryModalBtn');
    const confirmDeleteCategoryModalBtn = document.getElementById('confirmDeleteCategoryModalBtn');
    const deleteCategoryIdInput = document.getElementById('delete-category-id');

    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            sidebarLinks.forEach(otherLink => {
                otherLink.classList.remove('active');
            });
            link.classList.add('active');
            // You can add logic here to load content based on the clicked link
        });
    });

    // Modal functionality for New Category
    openNewCategoryModalBtn.addEventListener('click', () => {
        newCategoryModal.style.display = 'block';
    });

    const closeNewCategoryModal = () => {
        newCategoryModal.style.display = 'none';
    };

    closeNewCategoryModalBtn.addEventListener('click', closeNewCategoryModal);
    cancelNewCategoryModalBtn.addEventListener('click', closeNewCategoryModal);

    window.addEventListener('click', (event) => {
        if (event.target === newCategoryModal) {
            closeNewCategoryModal();
        }
    });

    saveNewCategoryModalBtn.addEventListener('click', () => {
        const categoryName = document.getElementById('categoryName').value;
        const categoryDescription = document.getElementById('categoryDescription').value;
        const categoryRules = document.getElementById('categoryRules').value;
        const categoryImage = document.getElementById('categoryImage').files[0]; // Handle file upload

        console.log('Guardar Nueva Categoria:', { categoryName, categoryDescription, categoryRules, categoryImage });
        // Here you would typically send this data to your server

        closeNewCategoryModal();
    });

    // Function to close a modal
    const closeModal = (modal) => {
        modal.style.display = 'none';
    };

    // Event listeners for opening the Edit Modal
    editCategoryBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            const categoryRow = btn.closest('tr');
            const categoryId = categoryRow.querySelector('.category-name').dataset.categoryId;
            const categoryName = categoryRow.querySelector('.category-name').textContent;
            const categoryDescription = categoryRow.querySelector('.category-participants').textContent; // Using participants as a placeholder, adjust as needed
            const categoryRules = categoryRow.querySelector('.category-trainer').textContent; // Using trainer as a placeholder, adjust as needed

            editCategoryIdInput.value = categoryId;
            editCategoryNameInput.value = categoryName;
            editCategoryDescriptionInput.value = categoryDescription;
            editCategoryRulesTextarea.value = categoryRules;
            // You might need to fetch the actual description and rules from the server based on the categoryId

            editCategoryModal.style.display = 'block';
        });
    });

    // Event listeners for closing the Edit Modal
    closeEditCategoryModalBtn.addEventListener('click', () => closeModal(editCategoryModal));
    cancelEditCategoryModalBtn.addEventListener('click', () => closeModal(editCategoryModal));
    window.addEventListener('click', (event) => {
        if (event.target === editCategoryModal) {
            closeModal(editCategoryModal);
        }
    });

    // Event listener for saving changes from the Edit Modal
    saveEditCategoryModalBtn.addEventListener('click', () => {
        const categoryId = editCategoryIdInput.value;
        const updatedName = editCategoryNameInput.value;
        const updatedDescription = editCategoryDescriptionInput.value;
        const updatedRules = editCategoryRulesTextarea.value;
        const updatedImage = editCategoryImageInput.files[0]; // Handle file update

        console.log('Guardar Cambios Categoria:', { categoryId, updatedName, updatedDescription, updatedRules, updatedImage });
        // Aquí normalmente enviarías los datos actualizados a tu servidor

        closeModal(editCategoryModal);
        // Optionally, update the table row in the UI
        const categoryRowToUpdate = document.querySelector(`.category-name[data-category-id="${categoryId}"]`).closest('tr');
        if (categoryRowToUpdate) {
            categoryRowToUpdate.querySelector('.category-name').textContent = updatedName;
            categoryRowToUpdate.querySelector('.category-participants').textContent = updatedDescription; // Update placeholder
            categoryRowToUpdate.querySelector('.category-trainer').textContent = updatedRules; // Update placeholder
        }
    });

    // Event listeners for opening the Delete Confirmation Modal
    deleteCategoryBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            const categoryRow = btn.closest('tr');
            const categoryIdToDelete = categoryRow.querySelector('.category-name').dataset.categoryId;
            deleteCategoryIdInput.value = categoryIdToDelete;
            deleteCategoryConfirmationModal.style.display = 'block';
        });
    });

    // Event listeners for closing the Delete Confirmation Modal
    closeDeleteCategoryModalBtn.addEventListener('click', () => closeModal(deleteCategoryConfirmationModal));
    cancelDeleteCategoryModalBtn.addEventListener('click', () => closeModal(deleteCategoryConfirmationModal));
    window.addEventListener('click', (event) => {
        if (event.target === deleteCategoryConfirmationModal) {
            closeModal(deleteCategoryConfirmationModal);
        }
    });

    // Event listener for confirming deletion
    confirmDeleteCategoryModalBtn.addEventListener('click', () => {
        const categoryIdToDelete = deleteCategoryIdInput.value;
        console.log('Eliminar Categoria con ID:', categoryIdToDelete);
        // Aquí normalmente enviarías el ID a tu servidor para eliminar la categoría

        closeModal(deleteCategoryConfirmationModal);
        // Opcionalmente, puedes remover la fila de la tabla de la UI después de la eliminación exitosa
        const categoryRowToRemove = document.querySelector(`.category-name[data-category-id="${categoryIdToDelete}"]`).closest('tr');
        if (categoryRowToRemove) {
            categoryRowToRemove.remove();
        }
    });
</script>

</body>
</html>