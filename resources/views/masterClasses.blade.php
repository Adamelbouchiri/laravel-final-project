<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Classes</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <style>
        .up-down {
            background-color: #94c4c6;
            animation: upDown 3s infinite;
        }

        @keyframes upDown {

            0%,
            100% {
                transform: translateY(5px);
            }

            50% {
                transform: translateY(-40px);
            }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    @include('layouts.navigation')
    <form action="{{ route('masterClasses.store') }}" method="post" class="hidden">
        @csrf
        <input name="start" id="start" type="datetime-local">
        <input name="end" id="end" type="datetime-local">
        <button id="submitEvent" type="submit">submit</button>
    </form>

    <div class="flex mt-8 px-[50px] items-center h-[75vh] justify-center gap-32 mb-20">
        <div class="w-[420px]">
            <h1 class="text-3xl font-bold text-[#94c4c6] tracking-wider mb-4">Check Our Master Classes</h1>
            <p class="text-gray-400 tracking-wider mb-8">You can make your own master classes and share with others, also you can make some money from it</p>
            <a href="#masterclasses"
                class="px-6 py-3 bg-white text-[#94c4c6] font-semibold rounded-lg shadow-md hover:bg-[#94c4c6] hover:text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#94c4c6] transition-all duration-300">Check
                Master Classes</a>
        </div>
        <img class="up-down w-[500px] rounded-lg" src="{{ asset('storage/images/classes.png') }}" alt="landing">
    </div>
    <h1 class="text-4xl font-semibold text-center text-[#94c4c6] py-4 tracking-wider">Master Classes</h1>

    <div id="masterclasses" class="fade-in flex justify-center items-center">
        <div id="calendar" class="my-8 bg-white p-4 text-zinc-800 w-3/4 text-center h-[90vh] border-2 border-zinc-600 rounded"></div>
    </div>

    @include('layouts.footer')
    
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            let response = await axios.get('/Master-Classes/create');
            let masterClasses = response.data.MasterClasses

            let nowDate = new Date()
            let day = nowDate.getDate()
            let month = nowDate.getMonth() + 1
            let hours = nowDate.getHours()
            let minutes = nowDate.getMinutes()
            let minTimeAllowed =
                `${nowDate.getFullYear()}-${month < 10 ? "0"+month : month}-${day < 10 ? "0"+day : day}T${hours < 10 ? "0"+hours : hours}:${minutes < 10 ? "0"+minutes : minutes}:00`
            start.min = minTimeAllowed;


            var myCalendar = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(myCalendar, {

                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',
                    right: 'listMonth,listWeek,listDay'
                },


                views: {
                    listDay: { 
                        buttonText: 'Day Events',

                    },
                    listWeek: { 
                        buttonText: 'Week Events'
                    },
                    listMonth: { 
                        buttonText: 'Month Events'
                    },
                    timeGridWeek: {
                        buttonText: 'Week', 
                    },
                    timeGridDay: {
                        buttonText: "Day",
                    },
                    dayGridMonth: {
                        buttonText: "Month",
                    },

                },


                initialView: "timeGridWeek",
                slotMinTime: "09:00:00", 
                slotMaxTime: "19:00:00",
                nowIndicator: true, 
                selectable: true, 
                selectMirror: true,
                selectOverlap: false, 
                weekends: true, 

                events: masterClasses,

                eventColor: '#94c4c6',

                selectAllow: (info) => {

                    return info.start >= nowDate;
                },

                select: (info) => {

                    if (info.end.getDate() - info.start.getDate() > 0 && !info.allDay) {
                        return
                    }

                    if (info.allDay) {
                        start.value = info.startStr + " 09:00:00"
                        end.value = info.startStr + " 19:00:00"

                    } else {
                        start.value = info.startStr.slice(0, info.startStr.length - 6)
                        end.value = info.endStr.slice(0, info.endStr.length - 6)
                    }

                    submitEvent.click()
                },

                eventContent: function(info) {
                    console.log(info);
                    
                    return {
                        html: `<div class='cursor-pointer'>
                                    <p class='text-zinc-600 font-semibold'>Master Class From: </p>
                                    <strong class=''>${info.event.extendedProps.name}</strong>
                                </div>`
                    };
                }

            });

            calendar.render();

            const sections = document.querySelectorAll(".fade-in");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("show");
                            observer.unobserve(entry.target); // Stop observing once visible
                        }
                    });
                }, {
                    threshold: 0.2, // Trigger when 20% of the section is visible
                }
            );

            sections.forEach((section) => observer.observe(section));
        })
    </script>
</body>

</html>
