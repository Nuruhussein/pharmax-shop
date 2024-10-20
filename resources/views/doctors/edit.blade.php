<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Doctor</h1>

        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ $doctor->name }}" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ $doctor->email }}" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div>
                <button type="submit" class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update Doctor</button>
            </div>
        </form>
    </div>
</x-app-layout>
