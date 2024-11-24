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
        <div class="bg-[#59c5c9] rounded-md p-6 flex w-[400px] flex-col fixed left-[80px] top-[80px]">
            <a href="{{ route('classe.show',$course->classe->id) }}" class="text-white text-md font-bold">Return to class</a>
            <div class=" text-white  me-10">
                <h1 class="text-3xl font-bold">{{ $course->name }}</h1>
                <p class="text-lg mt-2 font-bold">Course ID: {{ $course->id }}</p>
            </div>
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
                    @foreach ($lessons as $lesson)
                        <div
                            class="bg-gray-100 p-4 rounded-md shadow {{ $firstLesson || $lesson->pivot->current ? '' : 'opacity-50' }}">
                            <h3 class="text-lg font-medium">{{ $lesson->name }}</h3>
                            <p class="text-gray-600 mt-1">{{ $lesson->description }}.</p>


                            @if ($lesson->id == $firstLesson || $lesson->pivot->current)
                                <a href="{{ route('myLesson.show', $lesson->id) }}"
                                    class="transition duration-200 bg-[#94c4c6] mt-4 block w-fit hover:bg-[#59b4b7] text-white font-bold py-2 px-4 rounded">Show</a>
                            @endif

                        </div>
                    @endforeach

                    @if ($isTrue)
                        <div class="bg-[#59c5c9] rounded-md p-4 {{ $isTrue ? '' : 'hidden' }}">
                            <h1 class="text-white text-2xl tracking-wider font-bold text-center ">Final Project</h1>
                            <form action="{{ route('course.checkProject') }}" method="POST" class="w-full">
                                @csrf

                                <div class="p-2 text-white">
                                    <h1 class="text-xl mb-2">- Question Number : {{ $course->project->id }}</h1>
                                    <h1 class="text-2xl mb-4 font-semibold">{{ $course->project->question }}?</h1>
                                    <input type="hidden" name="project_id" value="{{ $course->project->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="text" name="answer"
                                        class="w-full px-4 py-2 text-zinc-700 font-semibold rounded"
                                        placeholder="Enter an answer">
                                </div>

                                <button
                                    class="bg-zinc-700 text-white rounded-md px-4 py-2 mt-4 w-fit mx-auto block">Check
                                    Answers</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @include('layouts.scrollToTop')

    </script>
</body>

</html>
