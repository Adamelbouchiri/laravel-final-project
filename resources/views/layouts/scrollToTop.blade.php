<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="">
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
        </style>
    
        <button id="scrollToTopBtn" class="transition duration-300 scroll-to-top flex items-center justify-center">
            <i class="fa-solid fa-arrow-up"></i>
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
    </div>
</body>
</html>