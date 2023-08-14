@extends('auth.authlayout')
@section('title','Login')
@section('content')
<div class="bg-white p-8 rounded shadow-md w-96">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @endforeach
    @endif
    <h2 class="text-2xl font-semibold mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
        @csrf
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="mt-1 px-4 py-2 w-full border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="mt-1 px-4 py-2 w-full border rounded-lg focus:ring focus:ring-blue-200" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Login</button>
    </form>
</div>
@endsection
