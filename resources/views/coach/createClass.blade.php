<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@include('layouts.navigation')

<body class="">
    
    <div class="flex items-center justify-center min-h-screen py-[50px]">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[900px] ">
            @include('layouts.flash')
            <h1 class="text-3xl font-bold mb-4 text-[#37abaf]">Create a Class</h1>
            <!-- Form -->
            <form action="{{ route('class.store') }}" method="POST" class="w-full">
                @csrf
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <!-- Class Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Class Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter class name"
                                class="w-full p-3 border border-gray-300 rounded " />
                        </div>

                        <!-- Seats -->
                        <div class="mb-4">
                            <label for="seats" class="block text-gray-700 font-medium mb-2">Seats</label>
                            <input type="number" min="1" max="10" id="seats" name="seats" placeholder="Enter number of seats"
                                class="w-full p-3 border border-gray-300 rounded" />
                        </div>

                        <label for="premium" class="block text-gray-700 font-medium mb-2">Premium</label>
                        <select id="premium" name="premium" class="mb-4 w-full p-3 border border-gray-300 rounded">
                            <option selected disabled value="">Select an option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>

                        <!-- Coach ID -->
                        <input type="hidden" id="coachId" name="coach_id" value="{{ Auth::user()->id }}"/>

                        <!-- Start Time -->
                    </div>
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label for="startTime" class="block text-gray-700 font-medium mb-2">Start Time</label>
                            <input type="datetime-local" id="startTime" name="startTime"
                                class="w-full p-3 border border-gray-300 rounded" />
                        </div>
                        <!-- End Time -->
                        <div class="mb-4">
                            <label for="endTime" class="block text-gray-700 font-medium mb-2">End Time</label>
                            <input type="datetime-local" id="endTime" name="endTime"
                                class="w-full p-3 border border-gray-300 rounded" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full transition duration-200 bg-[#94c4c6] hover:bg-[#68bfc2] text-white font-bold py-3 rounded focus:outline-none focus:shadow-outline">
                    Create Class
                </button>
            </form>
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>
