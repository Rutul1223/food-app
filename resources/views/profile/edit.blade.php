<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <style>
        body {
            background-color: #1a1a1a; /* Dark background for Elegencia theme */
            color: #ffffff; /* Light text for contrast */
            font-family: 'Baskervville';
            margin: 0;
            padding: 0;
        }
        .header {
            padding: 20px 0;
            text-align: center;
            background-color: #2c2c2c; /* Slightly lighter dark shade */
            border-bottom: 1px solid #FFD28D; /* Gold accent */
        }
        .header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: #FFD28D; /* Gold accent */
            margin: 0;
        }
        .container {
            max-width: 1200px; /* Matches max-w-7xl */
            margin: 0 auto;
            padding: 48px 24px; /* Matches py-12, sm:px-6 */
            display: flex;
            flex-direction: column;
            gap: 24px; /* Matches space-y-6 */
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr; /* Single column for mobile */
            gap: 24px; /* Matches gap-6 */
        }
        .card {
            background-color: #2c2c2c; /* Dark card background */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            padding: 32px; /* Matches p-4 sm:p-8 */
        }
        .card-inner {
            max-width: 600px; /* Matches max-w-xl */
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: 1fr 1fr; /* Two columns for md and up */
            }
        }
        @media (min-width: 1024px) {
            .container {
                padding: 48px; /* Matches lg:px-8 */
            }
        }
        /* Ensure partials inherit consistent styling */
        .card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            color: #FFD28D;
            margin-bottom: 10px;
        }
        .card p {
            color: #cccccc;
            font-size: 1rem;
        }
        .card input[type="text"],
        .card input[type="email"],
        .card input[type="password"],
        .card input[type="file"] {
            width: 100%;
            padding: 12px;
            background-color: #3a3a3a;
            border: 1px solid #555;
            border-radius: 5px;
            color: #ffffff;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .card input:focus {
            outline: none;
            border-color: #FFD28D;
        }
        .card label {
            color: #FFD28D;
            font-family: 'Baskervville', serif;
            font-size: 1rem;
            margin-bottom: 8px;
            display: block;
        }
        .card .error {
            color: #ff6b6b;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        .card button {
            background-color: #FFD28D;
            color: #1a1a1a;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .card button:hover {
            background-color: #ffd18da4;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="header">
                <h2>{{ __('Profile') }}</h2>
            </div>
        </x-slot>

        <div class="container">
            <!-- Grid layout for Update Profile and Update Password -->
            <div class="grid">
                <div class="card">
                    <div class="card-inner">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card">
                    <div class="card-inner">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete User section -->
            <div class="card">
                <div class="card-inner">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
