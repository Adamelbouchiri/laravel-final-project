<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    @include('layouts.navigation')
    <div class="flex justify-end p-4 relative">
        <div class="bg-[#59c5c9] rounded-md py-4 px-6 h-[260px] w-[450px] flex flex-col fixed left-[80px] top-[80px]">
            <a href="{{ route('classe.show',$course->classe->id) }}" class="text-white text-md font-bold">Return to class</a>
            <div class=" text-white  me-10">
                <p class="text-lg mt-2 font-bold">Course name :</p>
                <h1 class="text-3xl ps-4 font-bold">{{ $course->name }}</h1>
            </div>
            {{-- Modal Button  --}}
            <button
                class="mt-8 bg-zinc-700 text-white rounded-md px-4 py-2 duration-200 mb-4 hover:bg-zinc-800 transition"
                onclick="openModal('modelConfirm')">
                Add Lessons For This Course
            </button>
            <button class=" bg-zinc-700 text-white rounded-md px-4 py-2 duration-200 mb-4 hover:bg-zinc-800 transition"
                onclick="openModal('modelConfirm2')">
                Add Final Project For This Course
            </button>
        </div>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-3xl w-full me-[150px]">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Course Lessons</h2>
                @include('layouts.flash')
                @if ($course->lessons->isEmpty())
                    <h1 class="text-sm mt-4 ms-4">No Available Lessons Yet <span><i
                                class="fa-solid fa-heart-crack"></i></span> </h1>
                @endif
                <div id="lessons" class="space-y-4">
                    @foreach ($course->lessons as $lesson)
                        <div class="bg-gray-100 p-4 rounded-md shadow">
                            <h3 class="text-lg font-medium">{{ $lesson->name }}</h3>
                            <p class="text-gray-600 mt-1">{{ $lesson->description }}.</p>


                            <a href="{{ route('lesson.show', $lesson->id) }}"
                                class="transition duration-200 bg-[#94c4c6] mt-4 block w-fit hover:bg-[#59b4b7] text-white font-bold py-2 px-4 rounded">Check
                                Your Lessons</a>
                        </div>
                    @endforeach

                    @if ($course->project == true)
                        <div class="bg-[#59c5c9] rounded-md p-4">
                            <h1 class="text-white text-2xl tracking-wider font-bold text-center ">Final Project</h1>

                            <div class="p-2 text-white">
                                <h1 class="text-xl mb-2">- Question </h1>
                                <h1 class="text-2xl mb-4 font-semibold">{{ $course->project->question }}?</h1>
                                <input type="hidden" name="project_id" value="{{ $course->project->id }}">
                                <input type="text" name="answer"
                                    class="w-full px-4 py-2 text-zinc-700 font-semibold rounded"
                                    placeholder="Enter an answer">
                            </div>

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- lesson modal --}}
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
                <form action="{{ route('lesson.store') }}" method="POST" class="text-start"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="text-zinc-600 font-bold text-lg tracking-wider mb-2 block" for="name">Lesson
                            Name:
                        </label>
                        <input id="name" type="text" name="name" placeholder="Enter lesson name"
                            class="w-full rounded">
                    </div>
                    <div class="mb-4">
                        <label class="text-zinc-600 font-bold text-lg tracking-wider mb-2 block"
                            for="name">Description:</label>
                        <input id="name" type="text" name="description" placeholder="Enter lesson description"
                            class="w-full rounded">
                    </div>
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="mb-4">
                        <label class="text-zinc-600 font-bold text-lg tracking-wider mb-2 block" for="name">Enter
                            Lesson File(Image,Pdf,Video):</label>
                        <label for="content"
                            class="text-zinc-50 py-2 px-6 mx-auto cursor-pointer w-fit rounded-md bg-blue-500 text-center font-bold text-lg tracking-wider mb-2 block"
                            for="name"><i class="fa-solid fa-upload"></i></label>
                        <input id="content" type="file" accept="image/*,video/*,application/pdf" name="content"
                            placeholder="Enter lesson files" class="hidden">
                        <div id="fileName"></div>
                        <img class="w-[150px]" id="filePreview" />
                    </div>
                    <button
                        class="mt-4 block px-6 py-2 text-white bg-[#94c4c6] rounded-md shadow transition duration-200 hover:bg-[#51a9ac]"
                        onclick="closeModal('modelConfirm')">Add</button>
                </form>
            </div>

        </div>
    </div>

    {{-- final project modal --}}
    <div id="modelConfirm2"
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">

            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelConfirm2')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 pt-0 text-center">
                <h1 class="text-2xl text-zinc-700 font-bold mb-4"> Final project for this course</h1>
                <form action="{{ route('course.projectStore') }}" method="POST" class="text-start">
                    @csrf
                    <div class="mb-4">
                        <label class="text-zinc-600 font-bold text-md tracking-wider mb-2 block" for="question">
                            Enter a question to be answered in the final project:</label>
                        <input id="question" type="text" name="question" placeholder="Enter a question"
                            class="w-full rounded">
                    </div>
                    <div class="mb-4">
                        <label class="text-zinc-600 font-bold text-md tracking-wider mb-2 block" for="answer">
                            Enter an answer to the question in the final project:</label>
                        <input id="answer" type="text" name="answer" placeholder="Enter the answer"
                            class="w-full rounded">
                    </div>
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button
                        class="mt-4 block px-6 py-2 text-white bg-[#94c4c6] rounded-md shadow transition duration-200 hover:bg-[#51a9ac]"
                        onclick="closeModal('modelConfirm2')">Add</button>
                </form>
            </div>

        </div>
    </div>

    @include('layouts.scrollToTop')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

        });


        // Modal Logic
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


        const fileInput = document.getElementById('content');
        const fileNameDisplay = document.getElementById('fileName');
        const filePreview = document.getElementById('filePreview');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            fileNameDisplay.textContent = file.name;

            if (file.type.startsWith('image/') || file.type.startsWith('video/')) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    filePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                filePreview.textContent = 'Only images and videos are supported.';
            }
        });
    </script>
</body>

</html>
