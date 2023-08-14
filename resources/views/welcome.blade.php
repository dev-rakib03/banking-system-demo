<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bank</title>
  <!-- Include Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Include Font Awesome icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
  <div class="grid grid-cols-1 @auth @else md:grid-cols-2 lg:grid-cols-2 @endauth gap-4 max-w-md">
    @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="bg-purple-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-purple-600">
                <i class="fas fa-chart-line text-xl"></i>
                <span>Dashboard</span>
            </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-blue-600">
                    <i class="fas fa-sign-in-alt text-xl"></i>
                    <span>Login</span>
                </a>
                @if (Route::has('register'))
                    <a  href="{{ route('register') }}" class="bg-green-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-green-600">
                        <i class="fas fa-user-plus text-xl"></i>
                        <span>Register</span>
                    </a>
                @endif
            @endauth
    @endif
  </div>
</body>
</html>

