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
        .form-group textarea,
        .form-group select {
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
        <a href="./observations.php" class="sidebar-link flex items-center p-3 -mx-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 active">
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
                <div class="flex-grow text-right space-x-2">
                    <button class="text-gray-500 hover:text-indigo-700 focus:outline-none edit-observation-btn" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93c-1.18 1.18-3.106 1.18-4.285 0L1.414 11.414a2 2 0 010-2.828l7.93-7.93c1.18-1.18 3.106-1.18 4.285 0z" />
                            <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-red-700 focus:outline-none delete-observation-btn" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-gray-800 mb-2 observation-text" data-observation-id="1">No presento un Excelente Comportamiento</p>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 observation-category">Categoria sub15 futbol</span>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="https://via.placeholder.com/40" alt="Sophey Paul" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="text-sm font-semibold text-gray-700">Sophey Paul</h4>
                    <p class="text-xs text-gray-500">Hace 1 hora</p>
                </div>
                <div class="flex-grow text-right space-x-2">
                    <button class="text-gray-500 hover:text-indigo-700 focus:outline-none edit-observation-btn" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93c-1.18 1.18-3.106 1.18-4.285 0L1.414 11.414a2 2 0 010-2.828l7.93-7.93c1.18-1.18 3.106-1.18 4.285 0z" />
                            <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-red-700 focus:outline-none delete-observation-btn" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-gray-800 mb-2 observation-text" data-observation-id="2">No presento un Excelente Comportamiento</p>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 observation-category">Categoria sub15 futbol</span>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center space-x-3 mb-4">
                <img src="https://via.placeholder.com/40" alt="John Selee" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="text-sm font-semibold text-gray-700">John Selee</h4>
                    <p class="text-xs text-gray-500">Hace 1 hora</p>
                </div>
                <div class="flex-grow text-right space-x-2">
                    <button class="text-gray-500 hover:text-indigo-700 focus:outline-none edit-observation-btn" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93c-1.18 1.18-3.106 1.18-4.285 0L1.414 11.414a2 2 0 010-2.828l7.93-7.93c1.18-1.18 3.106-1.18 4.285 0z" />
                            <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                    <button class="text-gray-500 hover:text-red-700 focus:outline-none delete-observation-btn" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h12a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <p class="text-gray-800 mb-2 observation-text" data-observation-id="3">No presento un Excelente Comportamiento</p>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 observation-category">Categoria sub15 futbol</span>
        </div>

        <div class="lg:col-span-3 bg-indigo-700 shadow-md rounded-lg p-6 text-white flex items-center justify-center">
            <button id="openNewObservationModalBtn" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Nueva Observacion
            </button>
        </div>
    </main>

    <div id="newObservationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-semibold text-gray-800">Nueva Observacion para Entrenadores</h2>
                <span id="closeNewObservationModalBtn" class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <form class="space-y-4">
                    <div class="form-group">
                        <label for="observacion">Observacion</label>
                        <textarea id="observacion" rows="4" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Ingrese la observación"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="de">De</label>
                            <select id="de" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">
                                <option>Prof. Magno</option>
                                <option>Otro Entrenador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="para">Para</label>
                            <input type="text" id="para" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Buscar Entrenador...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="cancelNewObservationModalBtn" type="button" class="cancel-button">Cancelar</button>
                <button id="saveNewObservationModalBtn" type="button" class="save-button">Guardar</button>
            </div>
        </div>
    </div>

    <div id="editObservationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-semibold text-gray-800">Editar Observacion</h2>
                <span id="closeEditObservationModalBtn" class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <form class="space-y-4">
                    <div class="form-group">
                        <label for="edit-observacion">Observacion</label>
                        <textarea id="edit-observacion" rows="4" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Ingrese la observación"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="edit-de">De</label>
                            <select id="edit-de" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">
                                <option>Prof. Magno</option>
                                <option>Otro Entrenador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-para">Para</label>
                            <input type="text" id="edit-para" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" placeholder="Buscar Entrenador...">
                        </div>
                    </div>
                    <input type="hidden" id="edit-observation-id"> </form>
            </div>
            <div class="modal-footer">
                <button id="cancelEditObservationModalBtn" type="button" class="cancel-button">Cancelar</button>
                <button id="saveEditObservationModalBtn" type="button" class="save-button">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <div id="deleteConfirmationModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-semibold text-gray-800">Confirmar Eliminación</h2>
                <span id="closeDeleteModalBtn" class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta observación?</p>
                <input type="hidden" id="delete-observation-id"> </div>
            <div class="modal-footer">
                <button id="cancelDeleteModalBtn" type="button" class="cancel-button">Cancelar</button>
                <button id="confirmDeleteModalBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-red-400">Eliminar</button>
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

    // Modal functionality for New Observation
    const openNewObservationModalBtn = document.getElementById('openNewObservationModalBtn');
    const closeNewObservationModalBtn = document.getElementById('closeNewObservationModalBtn');
    const cancelNewObservationModalBtn = document.getElementById('cancelNewObservationModalBtn');
    const newObservationModal = document.getElementById('newObservationModal');
    const saveNewObservationModalBtn = document.getElementById('saveNewObservationModalBtn');

    openNewObservationModalBtn.addEventListener('click', () => {
        newObservationModal.style.display = 'block';
    });

    const closeNewObservationModal = () => {
        newObservationModal.style.display = 'none';
    };

    closeNewObservationModalBtn.addEventListener('click', closeNewObservationModal);
    cancelNewObservationModalBtn.addEventListener('click', closeNewObservationModal);

    window.addEventListener('click', (event) => {
        if (event.target === newObservationModal) {
            closeNewObservationModal();
        }
    });

    saveNewObservationModalBtn.addEventListener('click', () => {
        // Collect data from the form
        const observacion = document.getElementById('observacion').value;
        const de = document.getElementById('de').value;
        const para = document.getElementById('para').value;

        console.log('Guardar Observacion:', { observacion, de, para });

        // Here you would typically send this data to your server

        // Close the modal after saving
        closeNewObservationModal();
    });

    const editObservationBtns = document.querySelectorAll('.edit-observation-btn');
    const deleteObservationBtns = document.querySelectorAll('.delete-observation-btn');

    // Edit Modal Elements
    const editObservationModal = document.getElementById('editObservationModal');
    const closeEditObservationModalBtn = document.getElementById('closeEditObservationModalBtn');
    const cancelEditObservationModalBtn = document.getElementById('cancelEditObservationModalBtn');
    const saveEditObservationModalBtn = document.getElementById('saveEditObservationModalBtn');
    const editObservacionInput = document.getElementById('edit-observacion');
    const editDeSelect = document.getElementById('edit-de');
    const editParaInput = document.getElementById('edit-para');
    const editObservationIdInput = document.getElementById('edit-observation-id');

    // Delete Modal Elements
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
    const cancelDeleteModalBtn = document.getElementById('cancelDeleteModalBtn');
    const confirmDeleteModalBtn = document.getElementById('confirmDeleteModalBtn');
    const deleteObservationIdInput = document.getElementById('delete-observation-id');

    // Function to close a modal
    const closeModal = (modal) => {
        modal.style.display = 'none';
    };

    // Event listeners for opening the Edit Modal
    editObservationBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            const observationCard = btn.closest('.bg-white');
            const observationText = observationCard.querySelector('.observation-text').textContent;
            const observationCategory = observationCard.querySelector('.observation-category').textContent;
            const observationId = observationCard.querySelector('.observation-text').dataset.observationId;// Populate the edit modal with the current observation data
            editObservacionInput.value = observationText;
            // You might need to dynamically set the 'De' and 'Para' values based on your data structure
            editParaInput.value = ''; // Necesitarás lógica más específica aquí
            editObservationIdInput.value = observationId;

            editObservationModal.style.display = 'block';
        });
    });

    // Event listeners for closing the Edit Modal
    closeEditObservationModalBtn.addEventListener('click', () => closeModal(editObservationModal));
    cancelEditObservationModalBtn.addEventListener('click', () => closeModal(editObservationModal));
    window.addEventListener('click', (event) => {
        if (event.target === editObservationModal) {
            closeModal(editObservationModal);
        }
    });

    // Event listener for saving changes from the Edit Modal
    saveEditObservationModalBtn.addEventListener('click', () => {
        const observationId = editObservationIdInput.value;
        const updatedObservation = editObservacionInput.value;
        const updatedDe = editDeSelect.value;
        const updatedPara = editParaInput.value;

        console.log('Guardar Cambios Observacion:', { observationId, updatedObservation, updatedDe, updatedPara });
        // Aquí normalmente enviarías los datos actualizados a tu servidor

        closeModal(editObservationModal);
    });

    // Event listeners for opening the Delete Confirmation Modal
    deleteObservationBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            const observationCard = btn.closest('.bg-white');
            const observationId = observationCard.querySelector('.observation-text').dataset.observationId;
            deleteObservationIdInput.value = observationId;
            deleteConfirmationModal.style.display = 'block';
        });
    });

    // Event listeners for closing the Delete Confirmation Modal
    closeDeleteModalBtn.addEventListener('click', () => closeModal(deleteConfirmationModal));
    cancelDeleteModalBtn.addEventListener('click', () => closeModal(deleteConfirmationModal));
    window.addEventListener('click', (event) => {
        if (event.target === deleteConfirmationModal) {
            closeModal(deleteConfirmationModal);
        }
    });

    // Event listener for confirming deletion
    confirmDeleteModalBtn.addEventListener('click', () => {
        const observationIdToDelete = deleteObservationIdInput.value;
        console.log('Eliminar Observacion con ID:', observationIdToDelete);
        // Aquí normalmente enviarías el ID a tu servidor para eliminar la observación

        closeModal(deleteConfirmationModal);
        // Opcionalmente, puedes remover la tarjeta de la UI después de la eliminación exitosa
        const observationCardToRemove = document.querySelector(`.observation-text[data-observation-id="${observationIdToDelete}"]`).closest('.bg-white');
        if (observationCardToRemove) {
            observationCardToRemove.remove();
        }
    });
</script>

</body>
</html>