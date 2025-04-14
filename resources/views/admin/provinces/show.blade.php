<x-app-layout>
    
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-4xl mx-auto">
        <div class="flex justify-between items-center bg-gray-50 px-6 py-3">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.provinces.index') }}" class="text-blue-500 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Provinces
                </a>
            </div>

            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.provinces.edit', $province->id) }}" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                    Edit Province
                </a>
                <form action="{{ route('admin.provinces.destroy', $province->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this province?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $province->name }}</h1>
                <div class="text-sm text-gray-600">
                    <span>Created: {{ $province->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Province Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Statistics</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Total Posts</p>
                            <p class="text-2xl font-medium">{{ $province->posts->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Staff Members</p>
                            <p class="text-2xl font-medium">{{ $province->users->where('role', 'staff')->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pending Posts</p>
                            <p class="text-2xl font-medium text-yellow-600">{{ $province->posts->where('status', 'pending')->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Resolved Posts</p>
                            <p class="text-2xl font-medium text-green-600">{{ $province->posts->where('status', 'resolved')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Staff Members</h2>
                    @if($province->users->where('role', 'staff')->count() > 0)
                        <ul class="space-y-2">
                            @foreach($province->users->where('role', 'staff') as $staffMember)
                                <li class="p-2 border border-gray-200 rounded flex justify-between items-center">
                                    <div>
                                        <span class="font-medium">{{ $staffMember->name }}</span>
                                        <span class="text-sm text-gray-600 block">{{ $staffMember->email }}</span>
                                    </div>
                                    <a href="{{ route('admin.users.show', $staffMember->id) }}" class="text-blue-500 hover:underline">
                                        View
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">No staff members assigned to this province yet.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Recent Posts</h2>
                    <a href="{{ route('admin.posts.index', ['province_id' => $province->id]) }}" class="text-blue-500 hover:underline">
                        View All
                    </a>
                </div>

                @if($province->posts->count() > 0)
                    <div class="space-y-4">
                        @foreach($province->posts->sortByDesc('created_at')->take(5) as $post)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-medium">{{ $post->title }}</h3>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $post->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $post->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $post->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($post->content, 100) }}</p>
                                <div class="mt-2 flex justify-between items-center text-sm">
                                    <span class="text-gray-600">By: {{ $post->user->name ?? 'Anonymous' }}</span>
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="text-blue-500 hover:underline">
                                        View Post
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">No posts have been created for this province yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
