<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Work & Statistics</title>
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
            /* Hidden by default on larger screens */
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
            /* Adjust padding as needed */
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-gray-700 hover: text-indigo-500 transition-colors;
        }

        /* Responsive Styles */
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
                /* Show hamburger menu on smaller screens */
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="main-nav flex justify-between items-center px-4 py-3">
        <div class="font-bold text-xl text-gray-800">Our Brand</div>
        <div class="flex items-center">
            <!-- HACER CODE QUE CUANDO ESTE LOGEADO DESAPAREZCA O ESTE EL LOGPUT -->
            <a href="login.php"
                class="mr-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-300">
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

    <div class="container mx-auto p-8 mt-8 md:mt-0">
        <section class="hero-section py-16 rounded-lg shadow-md mb-8">
            <div class="container mx-auto px-6 flex items-center justify-between">
                <div class="text-left">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Let's build products together for life</h1>
                    <p class="text-gray-600 mb-6">Our award-winning platform is a product agency that refines people,
                        unlocks value, & drives development.</p>
                    <a href="#"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 px-6 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-400">Our
                        services</a>
                </div>
                <img src="https://i.ibb.co/zQ1yTfC/basketball-boy.png" alt="Boy with Basketball"
                    class="max-w-sm rounded-lg shadow-lg">
            </div>
        </section>

        <section class="py-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Our Latest Work</h2>
            <p class="text-gray-600 mb-4">Shared is a digital solution for a product agency that refines people, unlocks
                value, & drives development.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="work-item rounded-lg p-6">
                    <div class="bg-black aspect-w-16 aspect-h-9 rounded-md mb-4">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player"
                            frameborder="0"
                            allow="accelerate; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-700 mb-2">Candle - Mobile App</h3>
                    <p class="text-gray-500 text-sm">UI/UX Design</p>
                </div>
                <div class="work-item rounded-lg p-6">
                    <div class="bg-gray-300 aspect-w-16 aspect-h-9 rounded-md mb-4 flex items-center justify-center">
                        <span class="text-gray-500">Image Placeholder</span>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-700 mb-2">Quartz - Web App</h3>
                    <p class="text-gray-500 text-sm">Product Development</p>
                </div>
                <div class="work-item rounded-lg p-6">
                    <div class="bg-gray-300 aspect-w-16 aspect-h-9 rounded-md mb-4 flex items-center justify-center">
                        <span class="text-gray-500">Image Placeholder</span>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-700 mb-2">Studio - Mobile App</h3>
                    <p class="text-gray-500 text-sm">Interaction Design</p>
                </div>
            </div>
        </section>

        <section class="py-8 rounded-lg shadow-md bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Estadisticas Generales</h2>
                <div class="mb-6">
                    <button class="bg-purple-500 text-white py-2 px-4 rounded-full focus:outline-none">Mes -</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="stats-card rounded-lg p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Bounce Rate</h3>
                        <div class="relative inline-block w-24 h-24 rounded-full bg-gray-200">
                            <div
                                class="absolute top-1/4 left-1/4 w-1/2 h-1/2 rounded-full bg-yellow-400 flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-800">23%</span>
                            </div>
                        </div>
                        <p class="text-gray-500 mt-2">23%</p>
                        <p class="text-gray-400 text-sm">Lower than last day</p>
                    </div>
                    <div class="stats-card rounded-lg p-6 text-center">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Bounce Rate</h3>
                        <div class="relative inline-block w-24 h-24 rounded-full bg-gray-200">
                            <div
                                class="absolute top-1/4 left-1/4 w-1/2 h-1/2 rounded-full bg-yellow-400 flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-800">23%</span>
                            </div>
                        </div>
                        <p class="text-gray-500 mt-2">23%</p>
                        <p class="text-gray-400 text-sm">Lower than last day</p>
                    </div>
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