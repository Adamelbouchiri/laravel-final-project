<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users to approve</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen">
  @include('layouts.navigation')
  <h1 class="text-2xl font-bold text-[#94c4c6] mb-6 text-center pt-8">Users to approve</h1>
  <div class="container mx-auto p-8 bg-white mt-8">
    
    @if (session('success'))
    <div class="mb-8 w-full bg-green-100 text-green-800 p-4 rounded-lg shadow-md border-l-4 border-green-500">
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

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border-collapse border border-gray-300">
        <thead>
          <tr class="bg-[#94c4c6] text-white">
            <th class="py-2 px-4 border border-gray-300 text-left">#</th>
            <th class="py-2 px-4 border border-gray-300 text-left">Name</th>
            <th class="py-2 px-4 border border-gray-300 text-left">Email</th>
            <th class="py-2 px-4 border border-gray-300 text-left">Registration Date</th>
            <th class="py-2 px-4 border border-gray-300 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
        <!-- User Row Example -->
        @foreach ($notApprovedUsers as $user)
        <tr class="odd:bg-gray-100">
            <td class="py-2 px-4 border border-gray-300">{{ $user->id - 1 }}</td>
            <td class="py-2 px-4 border border-gray-300">{{ $user->name }}</td>
            <td class="py-2 px-4 border border-gray-300">{{ $user->email }}</td>
            <td class="py-2 px-4 border border-gray-300">{{ $user->created_at->format('d-m-Y') }}</td>
            <td class="flex justify-center py-2 px-4 border border-gray-300">
                <form action="{{ route('admin.approveUser',$user->id) }}" method="POST" class="flex items-center space-x-2">
                  @csrf
                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Approve</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
</body>
</html>
