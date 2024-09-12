<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Doctors</h1>

        @if(session('success'))
            <div class="text-green-600 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('doctors.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
            <i class="fas fa-plus mr-2"></i> Add New Doctor
        </a>

        <div class="mt-8 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-400 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left border-b">Name</th>
                        <th class="py-3 px-4 text-left border-b">Email</th>
                        <th class="py-3 px-4 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                    @foreach($doctors as $doctor)
                        <tr>
                            <td class="py-3 px-4 border-b text-gray-800">{{ $doctor->name }}</td>
                            <td class="py-3 px-4 border-b text-gray-800">{{ $doctor->email }}</td>
                            <td class="py-3 px-4 border-b text-gray-800">
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
