<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-md flex w-3/4 max-w-2xl">
        <div class="p-10 w-1/2">
            <h2 class="text-2xl font-semibold mb-6">Sign in</h2>
            <div class="mb-4">
                <input type="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-700" placeholder="Enter email or user name">
            </div>
            <div class="mb-6 relative">
                <input type="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-700" placeholder="Password">
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.036 12.322 3.19-3.182a1.5 1.5 0 0 1 2.122 0l3.182 3.182a3 3 0 0 0 4.243 4.243l3.182-3.182a1.5 1.5 0 0 1 2.122 0l3.19 3.182a3 3 0 0 0-4.243 4.243l-3.182-3.182a1.5 1.5 0 0 1-2.122 0L3.037 16.364a3 3 0 0 0-4.243-4.242z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                </button>
            </div>
            <div class="flex justify-between items-center mb-4">
                <div></div>
                <a href="#" class="text-sm text-blue-500 hover:underline focus:outline-none">Forget password?</a>
            </div>
            <button class="w-full bg-indigo-500 text-white py-3 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">Login</button>
            <div class="mt-4 text-center text-gray-600">
                If you don't have an account register
                <p class="mt-2"><a href="#" class="text-blue-500 hover:underline focus:outline-none">You can <span class="text-indigo-500">Register here</span> !</a></p>
            </div>
        </div>

        <div class="w-1/2 bg-gray-50 rounded-r-lg flex flex-col justify-center items-center p-8">
            <div class="text-center">
                <h2 class="text-3xl font-semibold text-gray-800 mb-2">Sign in to</h2>
                <p class="text-gray-600 mb-6">Lorem Ipsum is simply</p>
            </div>
            <img src="../img/player/childrens.png" alt="Kids Playing" class="max-w-full h-auto rounded-md">
        </div>
    </div>
</body>
</html>