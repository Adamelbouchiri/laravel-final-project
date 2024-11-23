<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classes calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')
    <form action="{{ route('classe.join') }}" method="post" class="hidden">
        @csrf
        <input id="class_id" type="hidden" name="class_id">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <button id="submitEvent" type="submit">submit</button>
    </form>
    <a id="pay" href="" class="hidden"></a>
    <h1 class="text-4xl font-semibold text-center text-[#94c4c6] py-4 tracking-wider">Available Classes</h1>
    <div class="flex justify-center items-center">
        <div id="calendar"
            class="my-8 bg-white p-4 text-zinc-800 w-3/4 text-center h-[90vh] border-2 border-zinc-600 rounded">

        </div>
    </div>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            let response = await axios.get('/calendar/create');
            let classes = response.data.classes

            console.log(classes);

            var myCalendar = document.getElementById('calendar');


            var calendar = new FullCalendar.Calendar(myCalendar, {

                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',

                    right: 'listMonth,listWeek,listDay'
                },


                views: {
                    listDay: { // Customize the name for listDay
                        buttonText: 'Day Classes',

                    },
                    listWeek: { // Customize the name for listWeek
                        buttonText: 'Week Classes'
                    },
                    listMonth: { // Customize the name for listMonth
                        buttonText: 'Month Classes'
                    },
                    timeGridWeek: {
                        buttonText: 'Week', // Customize the button text
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
                selectMirror: true,
                selectOverlap: false, 
                weekends: true,

                events: classes,

                eventColor: '#94c4c6',

                eventClick: function(info) {
                    info.el.style.borderColor = 'white';

                    payClassId = info.event.id;

                    if(info.event.extendedProps.premium == true) {
                        pay.href = `{{ route('classe.pay', ':payClassId') }}`.replace(':payClassId', payClassId);
                        pay.click();
                    }
                    console.log('test');
                    
                    // class_id.value = info.event.id;
                    // submitEvent.click();
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
        })
    </script>
</body>

</html>
