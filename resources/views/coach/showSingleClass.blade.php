<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Info</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="">
        <div class="max-w-4xl mx-auto p-6">
            <!-- Back Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('classes.show') }}"
                    class="text-[#59c5c9] transition duration-200 px-4 py-2 rounded-lg hover:bg-[#59c5c9] hover:text-white text-md mb-4 inline-block"><i
                        class="fa-solid fa-arrow-left"></i> Back to Classes
                </a>
                <button class="bg-[#59c5c9] text-white rounded-md px-4 py-2 duration-200 mb-4 hover:bg-[#30989c] transition"
                    onclick="openModal('modelConfirm')">
                    Add Course For This Class
                </button>
            </div>

            <!-- Class Details Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                @include('layouts.flash')
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $class->name }}</h1>

                <!-- Details Section -->
                <div class="space-y-4">
                    <p class="text-gray-600 text-lg pb-4 font-bold">Seats: <span
                            class="font-medium text-md">{{ $class->seats }}</span></p>
                    @if ($class->isPremium == true)
                        <p class="text-gray-600 text-lg pb-4 font-bold">Premium: <span
                                class="font-medium text-lg text-[#59c5c9]">yes <i class="fa-solid fa-coins"></i></span>
                        </p>
                    @else
                        <p class="text-gray-600 text-lg pb-4 font-bold">Premium: <span
                                class="font-medium text-lg text-[#59c5c9]">Free <i
                                    class="fa-solid fa-face-smile-beam"></i></span></p>
                    @endif
                    <p class="text-gray-600 text-lg pb-4 font-bold">Coach: <span
                            class="font-medium text-md text-gray-400"> {{ $class->coach->name }}</span>
                    </p>
                    <div class="flex justify-between pt-4 border-t-2 border-[#59c5c9] mt-2">
                        <p class="text-gray-600 font-bold">Start: <span
                                class="font-medium text-[#94c4c6]">{{ $class->start }}</span>
                        </p>
                        <p class="text-gray-600 font-bold">End: <span
                                class="font-medium text-[#94c4c6]">{{ $class->end }}</span>
                        </p>
                    </div>
                </div>

            </div>
            @can('coach-class', $class)
                <div class="mt-6 bg-white shadow-lg py-4 px-8 rounded-lg">
                    <h2 class="text-2xl text-zinc-800 font-bold mb-4">Users To assign</h2>
                    @foreach ($users as $user)
                        <div class="flex justify-between items-center py-4">
                            <h3 class="text-lg tracking-wider font-bold capitalize text-[#94c4c6]">{{ $user->name }}</h3>
                            <h4 class="text-md tracking-wider text-gray-400">{{ $user->email }}</h4>
                            <form action="{{ route('class.assign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $class->id }}" name="">
                                <input type="hidden" name="user_id" value="{{ $user->id }}" name="">
                                <button
                                    class="px-6 py-2 bg-yellow-400 text-white font-semibold rounded-lg 
                                shadow-md hover:bg-yellow-500 hover:shadow-lg focus:outline-none focus:ring-2
                                focus:ring-offset-2 focus:ring-yellow-400 transition-all duration-300">Assign
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endcan
        </div>
    </div>



    <div id="modelConfirm"
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelConfirm')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                
            </div>

        </div>
    </div>

    <script type="text/javascript">
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };
    </script>

    @include('layouts.scrollToTop')

</body>

</html>
