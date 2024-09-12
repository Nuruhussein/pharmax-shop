<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Add New Doctor</h1>

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                Add Doctor
            </button>
        </form>
    </div>
</x-app-layout>
