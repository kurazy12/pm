<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">User Details</h1>
                <div>
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">
                        Edit
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:underline">
                        Back to Users
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Role</p>
                        <p>
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $user->role === 'staff' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $user->role === 'user' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Province</p>
                        <p class="font-medium">{{ $user->province->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Registered</p>
                        <p class="font-medium">{{ $user->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Last Updated</p>
                        <p class="font-medium">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- User's Posts -->
            @if ($user->posts && $user->posts->count() > 0)
                <h2 class="text-xl font-bold text-gray-800 mb-4">User Posts</h2>
                <div class="space-y-4 mb-6">
                    @foreach ($user->posts as $post)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium">{{ $post->title }}</h3>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $post->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $post->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $post->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($post->content, 100) }}</p>
                            <div class="mt-2">
                                <a href="{{ route('admin.posts.show', $post->id) }}"
                                    class="text-blue-500 hover:underline">
                                    View Post
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500 italic">
                    This user has not created any posts yet.
                </div>
            @endif

            <!-- Danger Zone -->
            <div class="mt-8 border border-red-200 rounded-lg p-4">
                <h2 class="text-lg font-bold text-red-600 mb-2">Danger Zone</h2>
                <p class="text-gray-600 mb-4">Permanently delete this user and all their data.</p>

                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
