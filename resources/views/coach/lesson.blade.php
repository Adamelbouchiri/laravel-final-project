<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lesson</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-2xl w-full p-4">
        <a href="{{ route('course.show', $lesson->course_id) }}"
            class="text-[#59c5c9] transition duration-200 px-4 py-2 rounded-lg hover:bg-[#59c5c9] hover:text-white text-md mb-4 inline-block">Back
            To course</a>
        <div class="p-4">
            @include('layouts.flash')
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Lesson: {{ $lesson->name }}</h1>
            <p class="text-gray-600 mb-6">{{ $lesson->description }}</p>

            <div class="space-y-6">
                <!-- Video Content -->
                @if ($extension == 'mp4')
                    <div class="">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Video Content</h2>
                        <div class="aspect-video">
                            <iframe class="w-full h-full rounded-lg"
                                src="{{ asset('lessons-files/' . $lesson->content) }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <!-- Image Content -->
                @if ($extension == 'jpg' || $extension == 'png' || $extension == 'peg')
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Image Content</h2>
                        <img src="{{ asset('lessons-files/' . $lesson->content) }}" alt="Web Development Concept"
                            class="w-[500px] mx-auto h-auto rounded-lg">
                    </div>
                @endif

                <!-- PDF Content -->
                @if ($extension == 'pdf')
                    <div class="flex justify-center items-center py-6 flex-col">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">PDF Content</h2>
                        <embed src="{{ asset('lessons-files/' . $lesson->content) }}" width="100%" height="500px"
                            type="application/pdf">
                    </div>
                @endif
            </div>
            @checkRole('user')
                <form action="{{ route('lesson.complete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                    <button
                        class="complete-btn mt-2 transition duration-200 bg-[#94c4c6] hover:bg-[#59b4b7] text-white font-bold py-2 px-4 rounded">Complete</button>
                </form>
            @endCheckRole
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const downloadButton = document.getElementById('downloadPdf');

            downloadButton.addEventListener('click', function() {
                // Replace this URL with your actual PDF file URL
                const pdfUrl = "";
                const fileName = 'Web_Development_Lesson.pdf';

                fetch(pdfUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                    })
                    .catch(error => {
                        console.error('Error downloading the PDF:', error);
                        alert('There was an error downloading the PDF. Please try again later.');
                    });
            });
        });
    </script> --}}
</body>

</html>
