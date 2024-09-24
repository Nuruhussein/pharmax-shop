<x-app-layout>
    <div class="container mx-auto mt-4">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Edit Message</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('messages.update', $message->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT') <!-- This is important for PUT method -->
                
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" id="message" rows="4" class="mt-1 block w-full border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>{{ old('message', $message->message) }}</textarea>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Update</button>
                <a href="{{ route('messages.inbox') }}" class="text-blue-500 hover:underline mt-2 block text-center">Cancel</a>
            </form>
        </div>
    </div>
</x-app-layout>
