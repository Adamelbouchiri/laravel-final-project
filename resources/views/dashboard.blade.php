<x-app-layout>
    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 2rem;
            right: -50px;
            background-color: #31c9ce;
            color: white;
            border-radius: 15px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .scroll-to-top:hover {
            background-color: #24a4a9;
        }


        .up-down {
            background-color: #94c4c6;
            animation: upDown 3s infinite;
        }

        @keyframes upDown {
            0%, 100% {
                transform: translateY(5px);
            }
            50% {
                transform: translateY(-40px);
            }
        }
    </style>
    <div class="flex mt-8 px-[50px] items-center h-[80vh] justify-center gap-32">
        <div class="w-[400px]">
            <h1 class="text-4xl font-bold text-[#94c4c6] tracking-wider mb-4">Welcome To Our <br> E-Learning Platform</h1>
            <p class="text-gray-400 tracking-wider mb-8">Learn new skills anytime with our flexible and engaging e-learning platform.</p>
            <a href="#about" class="px-6 py-3 bg-white text-[#94c4c6] font-semibold rounded-lg shadow-md hover:bg-[#94c4c6] hover:text-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#94c4c6] transition-all duration-300">About Us</a>
        </div>
        <img class="up-down w-[500px] rounded-lg" src="{{ asset('storage/images/landing.png') }}" alt="landing">
    </div>

    {{-- About Us --}}

    <div id="about" class="pt-[150px] px-[50px]">
        <h1 class="text-[#94c4c6] text-start text-5xl tracking-wider font-bold mb-20">About Us</h1>
        <div class="flex flex-col justify-center items-center pb-20">
            <h1 class="text-3xl text-[#94c4c6] tracking-wider font-bold mb-10">Our Vision</h1>
            <p class="w-[800px] text-gray-400 leading-8 text-center">- We are dedicated to transforming education through innovative digital solutions, offering a comprehensive and accessible e-learning platform that empowers learners worldwide. Our goal is to bridge knowledge gaps by delivering personalized, engaging, and quality learning experiences for all</p>
        </div>
        <div class="flex flex-col justify-center items-center pb-20">
            <h1 class="text-3xl text-[#94c4c6] tracking-wider font-bold mb-10">What We Offer</h1>
            <p class="w-[800px] text-gray-400 leading-8 text-center">- Our platform provides a wide range of courses across diverse disciplines, taught by expert instructors. With interactive tools, flexible schedules, and a supportive community, we help learners achieve their personal and professional goals, fostering lifelong learning and growth</p>
        </div>
    </div>

    {{-- Our Target --}}

    <div id="our-target" class="pt-[150px] px-[50px]">
        <h1 class="text-[#94c4c6] text-start text-5xl tracking-wider font-bold mb-20">What's Our Target?</h1>
        <div class="flex justify-center gap-10">
            <div class="w-[400px] p-5">
                <img class="w-[300px] h-[250px] rounded-lg pb-10" src="{{ asset('storage/images/youtube_tutorial.png') }}" alt="teaching">
                <p class="text-gray-400 leading-8 text-center">We aim to make education accessible to everyone, breaking barriers of geography and affordability.
                    Our goal is to empower learners of all backgrounds with opportunities to expand their knowledge and skills.
                </p>
            </div>
            <div class="w-[400px] p-5">
                <img class="w-[300px] h-[250px] rounded-lg pb-10" src="{{ asset('storage/images/teaching.png') }}" alt="teaching">
                <p class="text-gray-400 leading-8 text-center">By fostering a collaborative learning environment, 
                    we encourage curiosity and help individuals grow both personally and professionally.
                </p>
            </div>
            <div class="w-[400px] p-5">
                <img class="w-[300px] h-[250px] rounded-lg pb-10" src="{{ asset('storage/images/learning.png') }}" alt="teaching">
                <p class="text-gray-400 leading-8 text-center">Ultimately, we strive to bridge the gap between education and opportunity, 
                    creating a global community of lifelong learners prepared for the future.
                </p>
            </div>
        </div>
    </div>

    {{-- contact us  --}}

    <div id="contact-us" class="flex flex-col md:flex-row items-center justify-center p-6 py-[150px]">
        <!-- Contact Form -->
        <div class="bg-white rounded px-8 pt-6 pb-8 mb-4 md:w-1/2">
            <h2 class="text-4xl font-bold mb-4 text-[#94c4c6]">Contact Us</h2>
            <!-- Name Input -->
            <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input
                class="shadow rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-[#94c4c6]"
                id="name"
                type="text"
                placeholder="Your Name"
            />
        </div>
        <!-- Email Input -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input
                class="shadow rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-[#94c4c6]"
                id="email"
                type="email"
                placeholder="Your Email"
            />
        </div>
        <!-- Message Text Area -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                Message
            </label>
            <textarea
                class="shadow rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none "
                id="message"
                placeholder="Your Message"
                rows="6"
            ></textarea>
        </div>
        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button
                class="bg-[#94c4c6] hover:bg-[#71b6b8] transition duration-300 text-white font-bold py-2 px-8 rounded focus:outline-none focus:shadow-outline"
                type="submit"
            >
                Send
            </button>
        </div>
        </div>
        <!-- Image Section -->
        <div class="md:w-[400px]">
            <img
                src="{{ asset('storage/images/contract.png') }}"
                alt="Contact Us"
                class=" w-[400px]  rounded-lg"
            />
        </div>
    </div>

    @include("layouts.footer")

    <button id="scrollToTopBtn" class="transition duration-300 scroll-to-top flex items-center justify-center">
        ↑
    </button>

    <script>
        // Get the button element
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Show the button when the user scrolls down
        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopBtn.style.right = "20px";
            } else {
                scrollToTopBtn.style.right = "-50px";
            }
        };

        // Scroll to the top when the button is clicked
        scrollToTopBtn.onclick = function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>
</x-app-layout>
