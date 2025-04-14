<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Province</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.provinces.show', $province->id) }}" class="text-blue-500 hover:underline">
                        View Province
                    </a>
                    <a href="{{ route('admin.provinces.index') }}" class="text-blue-500 hover:underline">
                        Back to Provinces
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.provinces.update', $province->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Province Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Province Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $province->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.provinces.index') }}" class="text-gray-500 hover:text-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Province
                    </button>
                </div>
            </form>

            <div class="mt-12 border-t border-gray-200 pt-6">
                <h2 class="text-xl font-semibold mb-4">Assign Staff Members</h2>

                <div class="mb-6">
                    <form action="{{ route('admin.provinces.assign-staff', $province->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select User to Assign as Staff</label>
                            <select name="user_id" id="user_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Select a User</option>
                                @foreach($availableUsers as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Assign as Staff
                            </button>
                        </div>
                    </form>
                </div>

                <h3 class="text-lg font-medium mb-3">Current Staff Members</h3>

                @if($province->users->where('role', 'staff')->count() > 0)
                    <div class="space-y-2">
                        @foreach($province->users->where('role', 'staff') as $staff)
                            <div class="flex justify-between items-center p-3 border border-gray-200 rounded">
                                <div>
                                    <span class="font-medium">{{ $staff->name }}</span>
                                    <span class="text-sm text-gray-600 ml-2">({{ $staff->email }})</span>
                                </div>
                                <form action="{{ route('admin.provinces.remove-staff', [$province->id, $staff->id]) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to remove this staff member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">No staff members assigned to this province yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
