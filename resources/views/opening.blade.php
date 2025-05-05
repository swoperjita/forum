@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: rgb(185, 168, 214);
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            margin-top: 50px; /* Adjust this value as needed */
        }
        .relative {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }
        .profile-button {
            background-color: #420a494d;
            border: 1px solid rgb(23, 11, 29);
            color: rgb(255, 255, 255);
            padding: 10px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            margin: 10px 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .profile-button:hover {
            background-color: #420a49;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-white-900 selection:bg-red-500 selection:text-white">
            <h1>ফোরাম এ আপনাদের স্বাগতম</h1>
            <ul>
                @auth
                <button onclick="window.location.href='{{ route('home') }}'" class="profile-button">হোম</button>
                <button onclick="window.location.href='{{ url('/profile') }}'" class="profile-button">আমার প্রোফাইল</button>
                @endauth
            </ul>
        </div>
    </div>
</body>
</html>
@endsection