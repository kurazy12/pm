@extends('layouts.new')

@section('title', 'All Posts - Pengaduan Masyarakat')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $post->image_path }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($post->content, 100) }}
                        </p>
                        <div class="flex justify-between items-center text-gray-600 text-sm mb-4">
                            <span>{{ $post->views }} views</span>
                            <span>{{ $post->likes }} likes</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Read More
                            </a>
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center {{ in_array($post->id, session('liked_posts', [])) ? 'text-red-500' : 'text-gray-600 hover:text-red-500' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 16.828l-6.828-6.828a4 4 0 010-5.656z" />
                                    </svg>
                                    {{ in_array($post->id, session('liked_posts', [])) ? 'Liked' : 'Like' }}
                                </button>
                            </form>

                            <!-- Bottom-Right Corner -->
                            <div class="fixed bottom-6 right-6">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                                    <a href="{{route('posts.create')}}">
                                        New Post
                                    </a>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
