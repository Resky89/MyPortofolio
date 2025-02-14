<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>@yield('title', 'Resky')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font (Optional - Gunakan font yang modern) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        main {
            min-height: calc(100vh - 4rem);
            padding-top: 2rem;
            background-color: #f8fafc;
        }
        .page-enter-active,
        .page-leave-active {
            transition: opacity 0.5s ease;
        }

        .page-enter-from,
        .page-leave-to {
            opacity: 0;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen overflow-x-hidden"></body>
    <!-- Navbar -->
    @include('layout.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="page-wrapper">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layout.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>
