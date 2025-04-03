<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mockup con Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .slider-container {
            overflow: hidden;
            position: relative;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            flex: 0 0 100%;
            width: 100%;
        }

        .slider-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 1rem;
        }

        .slider-controls button {
            background: none;
            border: none;
            color: #9ca3af; /* Text gray-400 */
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0.5rem;
        }

        .slider-dots {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
        }

        .slider-dots button {
            background-color: #d1d5db; /* Gray-300 */
            border: none;
            border-radius: 50%;
            width: 0.75rem;
            height: 0.75rem;
            cursor: pointer;
            opacity: 0.7;
        }

        .slider-dots button.active {
            background-color: #6b7280; /* Gray-600 */
            opacity: 1;
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
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 4v-4m3 2v-6m2 10h.01M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Evaluacion
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Categorias
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Asistencia <span class="ml-1 text-sm text-gray-500"></span>
                        </a>
                        <a href="#" class="flex items-center py-2 px-3 rounded-md hover:bg-gray-100 text-gray-700 mb-1">
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
                    <h2 class="text-xl font-semibold mb-4">Rúbricas</h2>
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

    <script>
        const sliderWrapper = document.getElementById('sliderWrapper');
        const slides = document.querySelectorAll('.slide');
        const sliderDots = document.getElementById('sliderDots');
        const numSlides = slides.length;
        let currentIndex = 0;

        function updateSlider() {
            const translateValue = -currentIndex * 100 + '%';
            sliderWrapper.style.transform = 'translateX(' + translateValue + ')';

            // Update active dot
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

// Optional: Auto slide (you can uncomment this)
// setInterval(nextSlide, 5000);

updateSlider(); // Initialize slider
</script>
</body>
</html>