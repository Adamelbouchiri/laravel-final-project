<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classes calendar</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <style>

        .fc-header-toolbar .fc-button {
            background-color: #94c4c6;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            margin: 0 5px;
            font-weight: bold;
            transition: .3s
        }

        .fc-header-toolbar .fc-button:hover {
            background-color: #6dc1c4;
        }

        .fc-header-toolbar .fc-button.fc-state-active {
            background-color: #94c4c6;
            color: white;
        }

        .fc-daygrid-day.fc-day-today {
            background-color: #94c4c6;
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
    </style>
    @include('layouts.navigation')
    <form action="{{ route('classe.join') }}" method="post" class="hidden">
        @csrf
        <input id="class_id" type="hidden" name="class_id">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <button id="submitEvent" type="submit">submit</button>
    </form>
    <a id="pay" href="" class="hidden"></a>
    <div class="flex mt-8 px-[50px] items-center h-[75vh] justify-center gap-32 mb-20">
        <div class="w-[420px]">
            <h1 class="text-3xl font-bold text-[#94c4c6] tracking-wider mb-4">Trainding and Toprated Classes</h1>
            <p class="text-gray-400 tracking-wider mb-8">Learn new skills anytime with Top rated classes and coachs</p>
            <a href="#classes"
                class="px-6 py-3 bg-white text-[#94c4c6] font-semibold rounded-lg shadow-md hover:bg-[#94c4c6] hover:text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#94c4c6] transition-all duration-300">Check
                Available Classes</a>
        </div>
        <img class="up-down w-[500px] rounded-lg" src="{{ asset('storage/images/register.png') }}" alt="landing">
    </div>
    <h1 class="text-4xl font-semibold text-center text-[#94c4c6] py-4 tracking-wider">Available Classes</h1>
    <div id="classes" class="fade-in flex justify-center items-center">
        <div id="calendar"
            class="my-8 bg-white p-4 text-zinc-800 w-3/4 text-center h-[90vh] border-2 border-zinc-600 rounded">

        </div>
    </div>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            let response = await axios.get('/calendar/create');
            let classes = response.data.classes

            var myCalendar = document.getElementById('calendar');


            var calendar = new FullCalendar.Calendar(myCalendar, {

                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',

                    right: 'listMonth,listWeek,listDay'
                },


                views: {
                    listDay: {
                        buttonText: 'Day Classes',

                    },
                    listWeek: {
                        buttonText: 'Week Classes'
                    },
                    listMonth: {
                        buttonText: 'Month Classes'
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

                initialView: "dayGridMonth",
                nowIndicator: true,
                selectMirror: true,
                selectOverlap: false,
                weekends: true,

                events: classes,

                eventColor: '#94c4c6',

                eventClick: function(info) {
                    info.el.style.borderColor = 'white';

                    payClassId = info.event.id;

                    if (info.event.extendedProps.premium == true) {
                        pay.href = `{{ route('classe.pay', ':payClassId') }}`.replace(':payClassId',
                            payClassId);
                        pay.click();
                    }

                    if (info.event.extendedProps.premium == false) {
                        class_id.value = info.event.id;
                        submitEvent.click();
                    }
                },

                eventContent: function(info) {
                    return {
                        html: `<div class='cursor-pointer'>
                                    <strong class=''>${info.event.title}</strong>
                                    <br/>
                                    <p class='mt-2'>Available Seats: <span class='font-bold text-md'>${info.event.extendedProps.seats}</span></p>
                                    <p class='mt-2 font-semibold'>${info.event.extendedProps.premium ? 'Premium <i class="fa-solid fa-money-bill"></i>' : ''}</p>
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
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.2,
                }
            );

            sections.forEach((section) => observer.observe(section));
        })
    </script>
</body>

</html>
