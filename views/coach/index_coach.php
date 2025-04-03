<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mockup con Slider y Modal de Nueva Rúbrica</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Existing slider styles */
        .slider-container { overflow: hidden; position: relative; }
        .slider-wrapper { display: flex; transition: transform 0.5s ease-in-out; }
        .slide { flex: 0 0 100%; width: 100%; }
        .slider-controls { position: absolute; top: 50%; transform: translateY(-50%); width: 100%; display: flex; justify-content: space-between; padding: 0 1rem; }
        .slider-controls button { background: none; border: none; color: #9ca3af; cursor: pointer; font-size: 1.5rem; padding: 0.5rem; }
        .slider-dots { position: absolute; bottom: 1rem; left: 50%; transform: translateX(-50%); display: flex; gap: 0.5rem; }
        .slider-dots button { background-color: #d1d5db; border: none; border-radius: 50%; width: 0.75rem; height: 0.75rem; cursor: pointer; opacity: 0.7; }
        .slider-dots button.active { background-color: #6b7280; opacity: 1; }

        /* Modal styles */
        .modal-overlay { display: none; position: fixed; z-index: 20; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 90%; max-width: 600px; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-title { font-size: 1.5rem; font-weight: bold; }
        .close-button { color: #aaa; font-size: 2rem; font-weight: bold; cursor: pointer; }
        .close-button:hover, .close-button:focus { color: black; text-decoration: none; }
        .modal-body { margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151; }
        .form-group input[type="text"],
        .form-group textarea { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; box-sizing: border-box; font-size: 1rem; color: #374151; focus:outline-none focus:ring-2 focus:ring-indigo-500; }
        .form-group textarea { min-height: 80px; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 0.75rem; }
        .modal-footer button { padding: 0.75rem 1.5rem; border-radius: 0.375rem; font-weight: bold; color: white; cursor: pointer; transition: background-color 0.2s ease-in-out; }
        .modal-footer .cancel-button { background-color: #6b7280; }
        .modal-footer .cancel-button:hover { background-color: #4a5568; }
        .modal-footer .save-button { background-color: #6366f1; }
        .modal-footer .save-button:hover { background-color: #4f46e5; }
        .add-section-button { background-color: #4f46e5; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.2s ease-in-out; }
        .add-section-button:hover { background-color: #3730a3; }
        .section-item { background-color: #f3f4f6; padding: 1rem; border-radius: 0.375rem; margin-bottom: 0.75rem; display: grid; grid-template-columns: 1fr 1fr 0.1fr; gap: 1rem; align-items: center; }
        .section-item label { font-weight: normal; }
        .remove-section-button { color: #ef4444; cursor: pointer; font-size: 1.25rem; }
        .remove-section-button:hover { color: #b91c1c; }
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
                        <a href="./categories.php" class="flex items-center py-2 px-3 rounded-md bg-gray-200 text-gray-800 mb-1">
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

            <main class="flex-1 flex flex-col">
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <div class="slider-container">
                        <div class="slider-wrapper" id="sliderWrapper">
                            <div class="slide">
                                <h2 class="text-xl font-semibold mb-2">Categorias</h2>
                                <h3 class="text-gray-600 mb-4">Categoria Sub17</h3>
                                <div class="flex justify-center">
                                    <img src="../img/coach/slider.png" alt="Equipo Sub17" class="rounded-md">
                                </div>
                            </div>

                            <div class="slide">
                                <h2 class="text-xl font-semibold mb-4">Estadisticas</h2>
                                <div class="bg-gray-200 rounded-md p-4 text-center">
                                    <div class="relative">
                                        <h3 class="font-semibold text-lg">Juan Jose</h3>
                                        <button class="absolute top-0 right-0 bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex justify-center gap-2 my-4">
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm text-gray-600">FI</span>
                                            <p class="font-semibold text-lg">3</p>
                                        </div>
                                        <div class="bg-indigo-500 text-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm">Es</span>
                                            <p class="font-semibold text-lg">4</p>
                                        </div>
                                        <div class="bg-white rounded-md p-2 shadow-sm">
                                            <span class="text-sm text-gray-600">Def</span>
                                            <p class="font-semibold text-lg">5</p>
                                        </div>
                                    </div>
                                    <p class="text-2xl font-semibold">23%</p>
                                </div>
                            </div>
                        </div>

                        <div class="slider-controls">
                            <button onclick="prevSlide()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button onclick="nextSlide()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <div class="slider-dots" id="sliderDots">
                            <button class="active" onclick="goToSlide(0)"></button>
                            <button onclick="goToSlide(1)"></button>
                        </div>
                    </div>
                    </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold mb-4 flex items-center justify-between">
                        Rúbricas
                        <button id="openRubricaModalBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Nueva Rúbrica
                        </button>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-indigo-600 text-white rounded-md p-6 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-semibold">Rubrica Entrenamiento n1</span>
                        </div>
                        </div>
                </div>
                <div class="flex-grow"></div>
            </main>
        </div>
    </div>

    <div id="nuevaRubricaModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Nueva Rúbrica</h2>
                <span class="close-button" id="closeRubricaModalBtn">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rubricaNombre">Nombre</label>
                    <input type="text" id="rubricaNombre" placeholder="Buscar...">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="form-group">
                        <label for="rubricaPuntaje">Puntaje</label>
                        <input type="text" id="rubricaPuntaje" placeholder="Max 100">
                    </div>
                    <div class="form-group">
                        <label for="rubricaDescripcion">Descripción</label>
                        <textarea id="rubricaDescripcion" placeholder="Prto Magno"></textarea>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block font-bold mb-2 text-gray-700">Apartados</label>
                    <div id="apartadosContainer" class="mb-2">
                        </div>
                    <button type="button" id="addApartadoBtn" class="add-section-button">Agregar Apartado</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelRubricaModalBtn" class="cancel-button">Cancelar</button>
                <button type="button" class="save-button">Guardar</button>
            </div>
        </div>
    </div>

    <script>
        // Existing slider script
        const sliderWrapper = document.getElementById('sliderWrapper');
        const slides = document.querySelectorAll('.slide');
        const sliderDots = document.getElementById('sliderDots');
        const numSlides = slides.length;
        let currentIndex = 0;

        function updateSlider() {
            const translateValue = -currentIndex * 100 + '%';
            sliderWrapper.style.transform = 'translateX(' + translateValue + ')';
            const dots = sliderDots.querySelectorAll('button');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % numSlides;
            updateSlider();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + numSlides) % numSlides;
            updateSlider();
        }

        function goToSlide(index) {
            currentIndex = index;
            updateSlider();
        }

        updateSlider();

        // Modal script for Nueva Rúbrica
        const openRubricaModalBtn = document.getElementById('openRubricaModalBtn');
        const closeRubricaModalBtn = document.getElementById('closeRubricaModalBtn');
        const cancelRubricaModalBtn = document.getElementById('cancelRubricaModalBtn');
        const nuevaRubricaModal = document.getElementById('nuevaRubricaModal');
        const addApartadoBtn = document.getElementById('addApartadoBtn');
        const apartadosContainer = document.getElementById('apartadosContainer');
        let apartadoCounter = 0;

        openRubricaModalBtn.addEventListener('click', () => {
            nuevaRubricaModal.style.display = 'block';
        });

        closeRubricaModalBtn.addEventListener('click', () => {
            nuevaRubricaModal.style.display = 'none';
        });

        cancelRubricaModalBtn.addEventListener('click', () => {
            nuevaRubricaModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target == nuevaRubricaModal) {
                nuevaRubricaModal.style.display = 'none';
            }
        });

        addApartadoBtn.addEventListener('click', () => {
            apartadoCounter++;
            const apartadoDiv = document.createElement('div');
            apartadoDiv.classList.add('section-item');
            apartadoDiv.innerHTML = `
                <div class="form-group">
                    <label for="apartadoNombre${apartadoCounter}">Nombre</label>
                    <input type="text" id="apartadoNombre${apartadoCounter}" placeholder="Ej: Ataque">
                </div>
                <div class="form-group">
                    <label for="apartadoPuntaje${apartadoCounter}">Puntaje (Max 100)</label>
                    <input type="text" id="apartadoPuntaje${apartadoCounter}" placeholder="Ej: 30">
                </div>
                <button type="button" class="remove-section-button" onclick="removeApartado(this)">
                    &times;
                </button>
            `;
            apartadosContainer.appendChild(apartadoDiv);
        });

        function removeApartado(button) {
            const apartadoToRemove = button.parentNode;
            apartadosContainer.removeChild(apartadoToRemove);
        }
    </script>
</body>
</html>