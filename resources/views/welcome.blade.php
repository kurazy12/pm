@extends('layouts.new')

@section('title', 'Welcome to Pengaduan Masyarakat')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Pengaduan Masyarakat</h1>
        <p class="text-lg text-gray-600 mb-6">Your platform for reporting and resolving issues in the community.</p>
        <div class="flex justify-center space-x-4">
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">
                            Go to Dashboard
                        </a>
                    @elseif (auth()->user()->role === 'staff')
                        <a href="{{ url('/staff/dashboard') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">
                            Go to Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">
                        Log in
                    </a>
                @endauth
            @endif
            <a href="{{ route('posts.index') }}"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">
                Posts
            </a>
        </div>
    </div>
</div>
@endsection
