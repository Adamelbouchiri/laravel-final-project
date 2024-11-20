@if (session('success'))
    <div class="z-10 mb-8 w-full bg-green-100 text-green-800 p-4 rounded-lg shadow-md border-l-4 border-green-500">
        <div class="flex items-center">
        <!-- Success Icon -->
        <svg class="w-6 h-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="none">
          <path fill="none" d="M0 0h24v24H0z"/>
          <path d="M12 4a8 8 0 0 0 0 16A8 8 0 0 0 12 4zM11 12V7h2v5h-2zm0 4v-2h2v2h-2z"/>
        </svg>
        <!-- Message Text -->
        <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="z-10 mb-8 w-full bg-red-100 text-red-800 p-4 rounded-lg shadow-md border-l-4 border-red-500">
        <div class="flex items-center">
        <!-- Success Icon -->
        <svg class="w-6 h-6 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="none">
          <path fill="none" d="M0 0h24v24H0z"/>
          <path d="M12 4a8 8 0 0 0 0 16A8 8 0 0 0 12 4zM11 12V7h2v5h-2zm0 4v-2h2v2h-2z"/>
        </svg>
        <!-- Message Text -->
        <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif