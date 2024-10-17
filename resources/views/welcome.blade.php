<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory-Project</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Make sure Tailwind is installed) -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset('images/landing-page.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            height: 100vh; 
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 3rem; 
            font-weight: 400; 
            margin-bottom: 2rem;
        }

        .button {
            background-color: white;
            color: #4b2cc5;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            text-decoration: none;
            margin: 10px;
        }

        .button:hover {
            background-color: #4b2cc5;
            color: white;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h1 class="font-light mb-6">Welcome to Inventory Project</h1>
        <div class="flex justify-center space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="button">Get Started</a>
                @else
                    <a href="{{ route('login') }}" class="button">Log In</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="button">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>
