<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex justify-center items-center min-h-screen">

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-16 h-16 text-red-500 mx-auto mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <h1 class="text-3xl font-semibold text-gray-800">Payment Failed</h1>
            <p class="text-lg text-gray-600">Oops! Something went wrong with your payment. Please try again or use a
                different method.</p>
        </div>

        <!-- Payment Failure Details Section -->
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Reason:</span>
                <span class="text-red-500 font-semibold">Payment Declined</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Transaction ID:</span>
                <span class="text-gray-500">N/A</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Payment Method:</span>
                <span class="text-gray-500">Credit Card (Visa)</span>
            </div>
        </div>

        <!-- Suggested Actions Section -->
        <div class="mt-8">
            <p class="text-center text-gray-600 mb-4">What would you like to do next?</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-white bg-red-500 hover:bg-red-600 px-6 py-2 rounded-lg">Dashboard</a>
                <a href="/contact-support"
                    class="text-white bg-yellow-500 hover:bg-yellow-600 px-6 py-2 rounded-lg">Contact Support</a>
            </div>
        </div>
    </div>

</body>

</html>
