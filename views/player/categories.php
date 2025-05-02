<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub17 Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-color: #f7f7f7;
        }

        .work-item {
            background-color: #ede7f6;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .work-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
            padding: 10px;
        }

        .line {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: 0.4s;
        }

        .open .line1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .open .line2 {
            opacity: 0;
        }

        .open .line3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 6rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-gray-700 hover: text-indigo-500 transition-colors;
        }

        @media (max-width: 768px) {
            .main-nav {
                padding: 1rem;
            }

            .nav-links {
                display: none;
                /* Hide links on smaller screens */
                flex-direction: column;
                position: absolute;
                top: 60px;
                /* Adjust based on header height */
                right: 0;
                background-color: #fff;
                width: 100%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                z-index: 10;
                gap: 1rem;
            }

            .nav-links.open {
                display: flex;
            }

            .hamburger-menu {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="main-nav flex justify-between items-center px-4 py-3">
    <div class="font-bold text-xl text-gray-800">Our Brand</div>
    <div class="flex items-center">
        <!-- HACER CODE QUE CUANDO ESTE LOGEADO DESAPAREZCA O ESTE EL LOGPUT -->
        <a href="login.php" class="mr-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-300">
            Login
        </a>
        
        <nav>
            <div class="hamburger-menu" id="hamburger">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </div>
            <div class="nav-links" id="navLinks">
                <a href="index.php">Home</a>
                <a href="categories.php">Cattegories</a>
                <a href="statistics.php">Stadisticas</a>
                <a href="profile.php">Profile</a>
            </div>
        </nav>
    </div>
</header>
    <div class="container mx-auto p-8">
        <section class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Categoria Sub17</h2>
            <p class="text-gray-600 mb-6">Ovend is a digital solution for a product agency that relates people,
                solutions, story development. Ovend is a digital solution for a product agency that relates people,
                solutions, story development.</p>
            <div class="flex justify-end">
                <div class="text-center">
                    <img src="https://i.ibb.co/tZqX88W/profile-image.png" alt="Magno Rodriguez"
                        class="w-24 h-24 rounded-full object-cover mb-2 shadow-md">
                    <p class="font-semibold text-indigo-500">Magno Rodriguez</p>
                    <p class="text-sm text-gray-500">Entrenador</p>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Integrantes</h2>
            <p class="text-gray-600 mb-6 text-center">Ovend is a digital solution for a product agency that relates
                people, solutions, story development.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 border rounded-md">
                    <img src="https://i.ibb.co/Y88yF1W/player-1.png" alt="Player 1"
                        class="w-32 h-32 rounded-full object-cover mx-auto mb-2 shadow-sm">
                    <p class="font-semibold text-indigo-500">**** ****</p>
                    <p class="text-sm text-gray-500">Sub17</p>
                </div>
                <div class="text-center p-4 border rounded-md">
                    <img src="https://i.ibb.co/Y88yF1W/player-1.png" alt="Player 2"
                        class="w-32 h-32 rounded-full object-cover mx-auto mb-2 shadow-sm">
                    <p class="font-semibold text-indigo-500">**** ****</p>
                    <p class="text-sm text-gray-500">Sub17</p>
                </div>
                <div class="text-center p-4 border rounded-md">
                    <img src="https://i.ibb.co/Y88yF1W/player-1.png" alt="Player 3"
                        class="w-32 h-32 rounded-full object-cover mx-auto mb-2 shadow-sm">
                    <p class="font-semibold text-indigo-500">**** ****</p>
                    <p class="text-sm text-gray-500">Sub17</p>
                </div>
            </div>
            <div class="text-center mt-6">
                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 px-6 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-400">VER
                    MÁS</button>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Fechas Importantes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-indigo-200 rounded-md p-4 flex items-center">
                    <div class="bg-indigo-500 text-white rounded-md p-2 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-indigo-700">Evaluacion 1</p>
                </div>
                <div class="bg-indigo-200 rounded-md p-4 flex items-center">
                    <div class="bg-indigo-500 text-white rounded-md p-2 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-indigo-700">Evaluacion 1</p>
                </div>
                <div class="bg-purple-200 rounded-md p-4 flex items-center">
                    <div class="bg-purple-500 text-white rounded-md p-2 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-purple-700">Evaluacion 1</p>
                </div>
                <div class="bg-green-200 rounded-md p-4 flex items-center">
                    <div class="bg-green-500 text-white rounded-md p-2 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-green-700">Evaluacion 1</p>
                </div>
            </div>
        </section>
    </div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            hamburger.classList.toggle('open');
        });
    </script>
</body>

</html>