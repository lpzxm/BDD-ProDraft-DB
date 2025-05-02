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
            <a href="./index.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2 12 3-3m0 6-3-3M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Inicio
            </a>
            <a href="./trainers.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
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
                    <input type="text" class="bg-gray-100 border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm w-full" placeholder="Buscar">
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
                        <label for="nombre_filtro" class="block text-gray-600 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" id="nombre_filtro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label for="especialidad_filtro" class="block text-gray-600 text-sm font-bold mb-2">Especialidad</label>
                        <select id="especialidad_filtro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Todas</option>
                            <option value="musculacion">Musculación</option>
                            <option value="cardio">Cardio</option>
                            <option value="funcional">Entrenamiento Funcional</option>
                            </select>
                    </div>
                    <div>
                        <label for="estado_filtro" class="block text-gray-600 text-sm font-bold mb-2">Estado</label>
                        <select id="estado_filtro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Todos</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Filtrar
                    </button>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">
                        Limpiar Filtros
                    </button>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Especialidad
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Juan Pérez
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    juan.perez@email.com
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Musculación</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Activo</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 editTrainerBtn" data-trainer-id="1">
                                    Editar
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline deleteTrainerBtn" data-trainer-id="1">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <tr id="trainer-2">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="ml-2">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Ana Gómez
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    ana.gomez@email.com
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Cardio</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Activo</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-right text-sm">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 editTrainerBtn" data-trainer-id="2">
                                    Editar
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline deleteTrainerBtn" data-trainer-id="2">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>

            <div id="editTrainerModal" class="modal-overlay">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="text-lg font-semibold">Editar Entrenador</h5>
                        <button type="button" class="close-button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="edit_nombre">Nombre</label>
                                <input type="text" id="edit_nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" id="edit_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="form-group">
                                <label for="edit_especialidad">Especialidad</label>
                                <select id="edit_especialidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="musculacion">Musculación</option>
                                    <option value="cardio">Cardio</option>
                                    <option value="funcional">Entrenamiento Funcional</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_estado">Estado</label>
                                <select id="edit_estado" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                            <input type="hidden" id="edit_trainer_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel-button">Cancelar</button>
                        <button type="button" class="save-button" id="saveTrainerBtn">Guardar</button>
                    </div>
                </div>
            </div>

            <div id="deleteTrainerModal" class="modal-overlay">
                <div class="delete-modal-content">
                    <div class="delete-modal-header">
                        <h5 class="text-lg font-semibold">Eliminar Entrenador</h5>
                    </div>
                    <div class="delete-modal-body">
                        <p class="text-gray-700">¿Estás seguro de que deseas eliminar a este entrenador?</p>
                        <input type="hidden" id="delete_trainer_id">
                    </div>
                    <div class="delete-modal-actions">
                        <button type="button" class="cancel-button close-delete-modal-btn">Cancelar</button>
                        <button type="button" class="confirm-delete-button" id="confirmDeleteTrainerModalBtn">Eliminar</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        const editTrainerModal = document.getElementById('editTrainerModal');
        const deleteTrainerModal = document.getElementById('deleteTrainerModal');
        const editTrainerButtons = document.querySelectorAll('.editTrainerBtn');
        const deleteTrainerButtons = document.querySelectorAll('.deleteTrainerBtn');
        const closeEditTrainerModalBtn = editTrainerModal.querySelector('.close-button');
        const closeDeleteTrainerModalBtn = deleteTrainerModal.querySelector('.close-button, .close-delete-modal-btn');
        const saveTrainerBtn = document.getElementById('saveTrainerBtn');
        const confirmDeleteTrainerModalBtn = document.getElementById('confirmDeleteTrainerModalBtn');

        function openEditTrainerModal(trainerId) {
            // Fetch trainer data based on ID and populate the modal fields
            console.log('Editar Entrenador con ID:', trainerId);
            document.getElementById('edit_trainer_id').value = trainerId;
            // Example: Pre-fill the form (replace with actual data fetching)
            const row = document.querySelector(`.editTrainerBtn[data-trainer-id="${trainerId}"]`).closest('tr');
            const nombre = row.querySelector('td:nth-child(1)').textContent.trim();
            const email = row.querySelector('td:nth-child(2)').textContent.trim();
            const especialidad = row.querySelector('td:nth-child(3)').textContent.trim();
            const estadoText = row.querySelector('td:nth-child(4)').textContent.trim();
            const estado = estadoText === 'Activo' ? 'activo' : 'inactivo';

            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_especialidad').value = especialidad;
            document.getElementById('edit_estado').value = estado;

            editTrainerModal.style.display = 'block';
        }

        function closeEditTrainerModal() {
            editTrainerModal.style.display = 'none';
        }

        function openDeleteTrainerModal(trainerId) {
            console.log('Abrir modal de eliminación para ID:', trainerId);
            document.getElementById('delete_trainer_id').value = trainerId;
            deleteTrainerModal.style.display = 'block';
        }

        function closeDeleteTrainerModal() {
            deleteTrainerModal.style.display = 'none';
        }

        editTrainerButtons.forEach(button => {
            button.addEventListener('click', function() {
                const trainerId = this.getAttribute('data-trainer-id');
                openEditTrainerModal(trainerId);
            });
        });

        deleteTrainerButtons.forEach(button => {
            button.addEventListener('click', function() {
                const trainerId = this.getAttribute('data-trainer-id');
                openDeleteTrainerModal(trainerId);
            });
        });

        closeEditTrainerModalBtn.addEventListener('click', closeEditTrainerModal);
        closeDeleteTrainerModalBtn.addEventListener('click', closeDeleteTrainerModal);

        window.addEventListener('click', (event) => {
            if (event.target === editTrainerModal) {
                closeEditTrainerModal();
            }
            if (event.target === deleteTrainerModal) {
                closeDeleteTrainerModal();
            }
        });

        saveTrainerBtn.addEventListener('click', () => {
            const trainerIdToUpdate = document.getElementById('edit_trainer_id').value;
            const nombre = document.getElementById('edit_nombre').value;
            const email = document.getElementById('edit_email').value;
            const especialidad = document.getElementById('edit_especialidad').value;
            const estado = document.getElementById('edit_estado').value;
            console.log('Guardar Entrenador con ID:', trainerIdToUpdate, nombre, email, especialidad, estado);

            // Here you would typically send the update request to your server

            closeEditTrainerModal();
            // Optionally, update the table row in the UI after successful update
            const rowToUpdate = document.querySelector(`.editTrainerBtn[data-trainer-id="${trainerIdToUpdate}"]`).closest('tr');
            if (rowToUpdate) {
                rowToUpdate.querySelector('td:nth-child(1)').textContent = nombre;
                rowToUpdate.querySelector('td:nth-child(2)').textContent = email;
                rowToUpdate.querySelector('td:nth-child(3)').textContent = especialidad;
                rowToUpdate.querySelector('td:nth-child(4)').textContent = estado === 'activo' ? 'Activo' : 'Inactivo';
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