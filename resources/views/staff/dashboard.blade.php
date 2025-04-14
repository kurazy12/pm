<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Posts Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Total Posts
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $totalPosts }}
                        </div>
                    </div>
                </div>

                <!-- Pending Posts Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Pending
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-yellow-600">
                            {{ $pendingPosts }}
                        </div>
                    </div>
                </div>

                <!-- In Progress Posts Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 truncate">
                            In Progress
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-blue-600">
                            {{ $inProgressPosts }}
                        </div>
                    </div>
                </div>

                <!-- Resolved Posts Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 truncate">
                            Resolved
                        </div>
                        <div class="mt-1 text-3xl font-semibold text-green-600">
                            {{ $resolvedPosts }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    {!! $postStatusChart->renderHtml() !!}
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    {!! $postsByProvinceChart->renderHtml() !!}
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Posts</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Province
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentPosts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ Str::limit($post->title, 40) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $post->province->name ?? 'Unknown' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                              {{ $post->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                              {{ $post->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                              {{ $post->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! $postStatusChart->renderChartJsLibrary() !!}
    {!! $postStatusChart->renderJs() !!}
    {!! $postsByProvinceChart->renderJs() !!}
</x-app-layout>
