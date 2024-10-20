<x-app-layout>
    <div class="max-w-screen-lg mx-auto px-4 md:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit staff</h1>
        <form action="{{ route('staff.update', $member->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium mb-1">Staff Name</label>
                <input type="text" name="name" id="name" value="{{ $member->name }}" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
           
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ $member->email }}" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
           
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                    Update staff
                </button>
                <a href="{{ route('staff.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-150">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>