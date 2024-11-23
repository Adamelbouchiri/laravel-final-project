<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="icon" href="{{ asset('storage/images/icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex justify-center items-center min-h-screen">
    <form action="{{ route('classe.join') }}" method="post" class="hidden">
        @csrf
        <input type="hidden" name="class_id" value="{{ $class->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <button id="submitEvent" type="submit">submit</button>
    </form>
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-16 h-16 text-green-500 mx-auto mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h1 class="text-3xl font-semibold text-gray-800">Payment Successful!</h1>
            <p class="text-lg text-gray-600">Thank you for your payment. Your transaction was completed successfully.
            </p>
        </div>

        <!-- Payment Details Section -->
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Amount Paid:</span>
                <span class="text-green-500 font-semibold">$45.00</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Transaction ID:</span>
                <span class="text-gray-500">1234567890ABCDEF</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700 font-medium">Payment Method:</span>
                <span class="text-gray-500">Credit Card (Visa)</span>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            submitEvent.click();
        }, 3000);
    </script>
</body>

</html>
