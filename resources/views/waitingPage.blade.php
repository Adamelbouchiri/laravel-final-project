<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Approval</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
</head>
<body class="bg-[#94c4c6] min-h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Waiting for Admin Approval</h1>
    <p class="text-gray-600 mb-6">
        Your account is under review. Please wait for the admin to approve your registration.
    </p>
    <div class="flex justify-center items-center space-x-2">
        <div class="w-4 h-4 rounded-full bg-[#94c4c6] animate-bounce"></div>
        <div class="w-4 h-4 rounded-full bg-[#94c4c6] animate-bounce delay-200"></div>
        <div class="w-4 h-4 rounded-full bg-[#94c4c6] animate-bounce delay-400"></div>
    </div>
    <p class="mt-6 text-sm text-gray-500">
        If you have any questions, please contact <a href="mailto:elbouchiriadam@gmail.com" class="text-[#94c4c6] underline">elbouchiriadam@gmail.com</a>.
    </p>
</div>
</body>
</html>
