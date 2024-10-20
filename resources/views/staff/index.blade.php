<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Staff Members</h1>
    
        <!-- Trigger Button to Open Modal -->
        <button id="openModalBtn" class="inline-block px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Add New Staff
        </button>
    
        <!-- Modal (Hidden by Default) -->
        <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Staff</h1>
                    
                    <!-- Form for Adding New Staff -->
                    <form id="staffForm" action="{{ route('staff.store') }}" method="POST" class="space-y-6">
                        @csrf
    
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div>
                            <button type="submit" class="inline-block px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add Staff</button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="closeModalBtn" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
          </div>
        </div>
    
        <!-- Table for Staff Members -->
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($staff as $member)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 whitespace-nowrap">{{ $member->name }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $member->email }}</td>
                            <td class="py-3 px-6 text-right">
                                <a href="{{ route('staff.edit', $member->id) }}" class="ml-3 text-yellow-600 hover:text-yellow-500 transition duration-150 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 11l2 2m0 0l-2 2m2-2H6m0 0l2-2M9 4H4a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-5"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('staff.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Include this script at the bottom -->
    <script>
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
    
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
    
        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
    </x-app-layout>
    