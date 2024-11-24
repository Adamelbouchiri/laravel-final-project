<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-4xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-lg">
        <div class="flex items-center space-x-6">
            <div
                class="w-20 h-20 rounded-full bg-[#94c4c6] flex items-center justify-center text-white text-2xl font-semibold">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Completed Courses</h2>
            <ul class="space-y-4">
                @foreach ($courses as $course)
                    @if ($course->pivot->completed == true)
                        <li class="bg-gray-100 p-4 rounded-lg shadow-sm flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">{{ $course->name }}</h3>
                                <p class="text-sm text-gray-500">Completed on: October 15, 2024</p>
                            </div>
                            <span
                                class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Completed <i class="fa-solid fa-check"></i></span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</body>

</html>
