<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes Informations</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-center text-[#37abaf] mb-6">Classes</h1>
        @if (Auth::user()->classes->isEmpty())
            <div class="bg-gray-100 flex items-center justify-center">
                <div class="bg-white shadow-xl rounded-lg p-8 text-center max-w-md">
                    <div class="text-[#94c4c6] mb-4">
                        <i class="fas fa-info-circle text-4xl"></i>
                    </div>
                    <p class="text-gray-800 text-lg font-semibold mb-2">No Class Enrollments Found</p>
                    <p class="text-gray-600 text-sm">
                        It seems you are not enrolled in any classes at the moment. Please check back later or contact
                        support for assistance.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('classesCalendar.show') }}"
                            class="bg-[#94c4c6] text-white transition duration-300 px-4 py-2 rounded-lg shadow hover:bg-[#5eb7ba] focus:outline-none focus:ring focus:ring-blue-300">
                            Join a class
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Class Card -->
            @foreach ($classes as $class)
                <div
                    class="cursor-pointer bg-white rounded-lg shadow-md p-4 transition duration-300 hover:translate-y-[-5px] hover:shadow-lg">
                    <h2 class="text-2xl font-semibold text-[#37abaf] mb-4">{{ $class->name }}</h2>
                    <p class="text-gray-600 text-lg pb-4 font-bold">Seats: <span
                            class="font-medium text-md">{{ $class->seats }}</span></p>
                    @if ($class->isPremium == true)
                        <p class="text-gray-600 text-lg pb-4 font-bold">Premium: <span
                                class="font-medium text-lg text-[#59c5c9]">yes <i class="fa-solid fa-money-bill"></i></span>
                        </p>
                    @else
                        <p class="text-gray-600 text-lg pb-4 font-bold">Premium: <span
                                class="font-medium text-lg text-[#59c5c9]">Free <i
                                    class="fa-solid fa-face-smile-beam"></i></span></p>
                    @endif
                    <p class="text-gray-600 text-lg pb-4 font-bold">Coach: <span
                            class="font-medium text-md text-gray-400"> {{ $class->coach->name }}</span>
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t-2 border-[#59c5c9] mt-2">
                        <p class="text-gray-600 font-bold">Start: <span
                                class="font-medium text-[#94c4c6]">{{ $class->start }}</span>
                        </p>

                        <a class="text-white transition duration-300 bg-zinc-600 px-4 py-2 hover:bg-zinc-700 rounded-lg"
                            href="{{ route('myClass.show', $class->id) }}">Start Your Class</a>
                        <p class="text-gray-600 font-bold">End: <span
                                class="font-medium text-[#94c4c6]">{{ $class->end }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.scrollToTop')
</body>

</html>
