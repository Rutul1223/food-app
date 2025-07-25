<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-dark-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|poppins:300,400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/validation.js'])

    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #111827;
        }
        .bg-dark-800 {
            background-color: #1f2937;
        }
        .bg-dark-700 {
            background-color: #374151;
        }
        .bg-dark-600 {
            background-color: #4b5563;
        }
        .bg-dark-900 {
            background-color: #111827;
        }
        .text-gold-400 {
            color: #d4af37;
        }
        .text-gold-500 {
            color: #c9a227;
        }
        .bg-gold-500 {
            background-color: #d4af37;
        }
        .hover\:bg-gold-600:hover {
            background-color: #c9a227;
        }
        .border-dark-600 {
            border-color: #4b5563;
        }
        .border-dark-700 {
            border-color: #374151;
        }
        .focus\:ring-gold-500:focus {
            --tw-ring-color: #d4af37;
        }
    </style>
</head>

<body class="antialiased text-gray-300">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md px-6 py-8">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
