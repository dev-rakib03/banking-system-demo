<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Include Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Include Font Awesome icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="h-screen bg-gray-100">
    <nav class="bg-blue-500 p-4">
        <div class="flex items-center justify-between">
          <div class="text-white font-semibold">My Bank</div>
          <div class="text-white font-semibold"><label>Balance: BDT {{ Auth::user()->balance }} | User Id: {{ Auth::user()->id }}</label></div>
          <div class="flex space-x-4">
            <a href="{{ url('/dashboard') }}" class="text-white hover:underline-none flex items-center space-x-1">
              <i class="fas fa-chart-line"></i>
              <span>Dashboard</span>
            </a>
            <a href="#" onclick="document.getElementById('logout').submit();" class="text-white hover:underline-none flex items-center space-x-1">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <form hidden id="logout" method="POST" action="{{ asset('/logout') }}">
                @csrf
            </form>
          </div>
        </div>
    </nav>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-2" role="alert">
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @endforeach
    @endif
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-2" role="alert">
            <span class="block sm:inline">{{ session()->get('success') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-2" role="alert">
            <span class="block sm:inline">{{ session()->get('error') }}</span>
        </div>
    @endif
    @yield('content')
</body>
</html>
