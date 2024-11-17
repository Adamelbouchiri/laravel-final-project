<x-app-layout>
    <style>
        .up-down {
            background-color: #94c4c6;
            animation: upDown 3s infinite;
        }

        @keyframes upDown {
            0%, 100% {
                transform: translateY(10px);
            }
            50% {
                transform: translateY(-30px);
            }
        }
    </style>
    <div class="flex mt-8 px-[50px] items-center h-[70vh] justify-center gap-32">
        <div class="w-[400px]">
            <h1 class="text-4xl font-bold text-white tracking-wider mb-4">Welcome To Our <br> E-Learning Platform</h1>
            <p class="text-gray-600 tracking-wider mb-8">Learn new skills anytime with our flexible and engaging e-learning platform.</p>
            <a href="#about" class="px-6 py-3 bg-white text-[#94c4c6] font-semibold rounded-lg shadow-md hover:bg-zinc-100 hover:text-[#38a1a4] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fff] transition-all duration-300">About Us</a>
        </div>
        <img class="up-down w-[400px] rounded-lg" src="{{ asset('storage/images/landing.png') }}" alt="landing">
    </div>
    
</x-app-layout>
