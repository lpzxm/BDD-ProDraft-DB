<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Evaluación - Mockup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados para iconos */
        .icon {
            width: 16px;
            height: 16px;
            fill: currentColor;
            margin-right: 0.5rem;
            cursor: pointer;
        }
        /* Estilos para el modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none; /* Cambiado a 'none' para que esté oculto al inicio */
            justify-content: center;
            align-items: center;
            z-index: 50;
        }
        .modal {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            width: 90%;
            max-width: 600px;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .modal-close-button {
            cursor: pointer;
            border: none;
            background: none;
            font-size: 1.25rem;
            color: gray;
        }
        .modal-body {
            margin-bottom: 2rem;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
        }
        .modal-actions button {
            margin-left: 0.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            text-gray-700 text-sm font-bold mb-2;
        }
        .form-group input[type="text"],
        .form-group input[type="number"] {
            shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="container mx-auto p-4 h-screen overflow-hidden flex">
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
                    <a href="./observations.php" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
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

        <main class="flex-1 flex flex-col bg-gray-50 overflow-y-auto">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Rubricas</h2>
                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    + Nueva Evaluar
                </button>
            </header>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex justify-end mb-4">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Categoria
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Hora
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jugadores
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block w-3 h-3 rounded-full bg-green-500 mr-2"></span>
                                        Activo
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        Entrenamiento 1
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        Sub17
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        10 am
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        11.06.2019
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        35
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 open-evaluation-modal" data-modal-id="evaluation-modal">
                                            Evaluar
                                        </button>
                                        <button class="hover:bg-gray-200 text-gray-600 font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline open-edit-modal-rubrica" data-modal-id="edit-rubrica-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93a3.5 3.5 0 01-4.95-4.95l7.93-7.93zM10 6v3h3l4-4-3-3z" />
                                            </svg>
                                        </button>
                                        <button class="hover:bg-gray-200 text-gray-600 font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline open-delete-modal-rubrica" data-modal-id="delete-rubrica-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4h5.236l-.724-1.447A1 1 0 0011 2H9zm7 8a1 1 0 01-1 1H3a1 1 0 01-1-1V5a1 1 0 011-1h1c.286 0 .532.105.707.293L6.866 7h6.268l.707-1.707A1 1 0 0116 4h1a1 1 0 011 1v5zm-8 3a1 1 0 01-1-1v-3a11 0 012 0v3a1 1 0 01-1 1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block w-3 h-3 rounded-full bg-red-500 mr-2"></span>
                                        Inactivo
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        Entrenamiento 4
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        Sub15
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        2 pm
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        12.02.2019
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        65
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 open-evaluation-modal" data-modal-id="evaluation-modal">
                                            Evaluar
                                        </button>
                                        <button class="hover:bg-gray-200 text-gray-600 font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline open-edit-modal-rubrica" data-modal-id="edit-rubrica-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-7.93 7.93a3.5 3.5 0 01-4.95-4.95l7.93-7.93zM10 6v3h3l4-4-3-3z" />
                                            </svg>
                                        </button>
                                        <button class="hover:bg-gray-200 text-gray-600 font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline open-delete-modal-rubrica" data-modal-id="delete-rubrica-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="icon">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4h5.236l-.724-1.447A1 1 0 0011 2H9zm7 8a1 1 0 01-1 1H3a1 1 0 01-1-1V5a1 1 0 011-1h1c.286 0 .532.105.707.293L6.866 7h6.268l.707-1.707A1 1 0 0116 4h1a1 1 0 011 1v5zm-8 3a1 1 0 01-1-1v-3a1 1 0 012 0v3a1 1 0 01-1 1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="flex-grow"></div>
        </main>
    </div>

    <div id="evaluation-modal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Evaluación de a: &lt;Jugador 1&gt;</h3>
                <button type="button" class="modal-close-button" onclick="closeModal('evaluation-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label for="tiro" class="block text-gray-700 text-sm font-bold mb-2">TIRO</label>
                    <input type="text" id="tiro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Buscar...">
                </div>
                <div class="mb-4">
                    <label for="ataque" class="block text-gray-700 text-sm font-bold mb-2">ATAQUE</label>
                    <input type="text" id="ataque" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="Prto Magno">
                </div>
                <div class="mb-4">
                    <label for="pase" class="block text-gray-700 text-sm font-bold mb-2">PASE</label>
                    <input type="text" id="pase" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Buscar...">
                </div>
                <div class="mb-4">
                    <label for="defensa" class="block text-gray-700 text-sm font-bold mb-2">DEFENSA</label>
                    <input type="text" id="defensa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Buscar...">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal('evaluation-modal')">
                    Cancelar
                </button>
                <button type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar
                </button>
            </div>
        </div>
    </div>

    <div id="edit-rubrica-modal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Editar Rúbrica</h3>
                <button type="button" class="modal-close-button" onclick="closeModal('edit-rubrica-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-rubrica-nombre">Nombre</label>
                    <input type="text" id="edit-rubrica-nombre" value="Entrenamiento 1">
                </div>
                <div class="form-group">
                    <label for="edit-rubrica-categoria">Categoría</label>
                    <input type="text" id="edit-rubrica-categoria" value="Sub17">
                </div>
                <div class="form-group">
                    <label for="edit-rubrica-hora">Hora</label>
                    <input type="text" id="edit-rubrica-hora" value="10 am">
                </div>
                <div class="form-group">
                    <label for="edit-rubrica-fecha">Fecha</label>
                    <input type="text" id="edit-rubrica-fecha" value="11.06.2019">
                </div>
                <div class="form-group">
                    <label for="edit-rubrica-jugadores">Jugadores</label>
                    <input type="number" id="edit-rubrica-jugadores" value="35">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal('edit-rubrica-modal')">
                    Cancelar
                </button>
                <button type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar Cambios
                </button>
            </div>
        </div>
    </div>

    <div id="delete-rubrica-modal" class="modal-overlay hidden">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Eliminar Rúbrica</h3>
                <button type="button" class="modal-close-button" onclick="closeModal('delete-rubrica-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar la rúbrica "Entrenamiento 1"? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal('delete-rubrica-modal')">
                    Cancelar
                </button>
                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'flex'; // Cambiado a 'flex' para mostrarlo
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'none'; // Cambiado a 'none' para ocultarlo
        }

        // Agregar event listeners para abrir el modal de evaluación
        const openEvaluationModalButtons = document.querySelectorAll('.open-evaluation-modal');
        openEvaluationModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-id');
                openModal(modalId);
            });
        });

        // Agregar event listeners para abrir el modal de edición de rúbrica
        const openEditModalButtons = document.querySelectorAll('.open-edit-modal-rubrica');
        openEditModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-id');
                openModal(modalId);
            });
        });

        // Agregar event listeners para abrir el modal de eliminación de rúbrica
        const openDeleteModalButtons = document.querySelectorAll('.open-delete-modal-rubrica');
        openDeleteModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-id');
                openModal(modalId);
            });
        });
    </script>
</body>
</html>