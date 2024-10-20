<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Doctors</h1>
    
        <!-- Trigger Button to Open Modal for Creating New Doctor -->
        <button id="openCreateModalBtn" class="inline-block px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Add New Doctor
        </button>
    
        <!-- Modal for Create/Edit Doctor (Hidden by Default) -->
        <div id="doctorModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h1 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-6">Add New Doctor</h1>
                    
                    <!-- Form for Adding/Editing Doctor -->
                    <form id="doctorForm" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="_method" value="POST" id="methodField">

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        </div>
    
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        </div>

                        <div id="passwordFields" class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div id="passwordConfirmationFields" class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
    
                        <div>
                            <button type="submit" class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" id="submitBtn">
                                Add Doctor
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="closeModalBtn" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
          </div>
        </div>
    
        <!-- Table for Doctors -->
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
                    @foreach ($doctors as $doctor)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 whitespace-nowrap">{{ $doctor->name }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $doctor->email }}</td>
                            <td class="py-3 px-6 text-right">
                                <!-- Edit Button -->
                                <button class="inline-block px-4 py-2 text-white bg-yellow-600 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 editDoctorBtn" data-id="{{ $doctor->id }}" data-name="{{ $doctor->name }}" data-email="{{ $doctor->email }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');" class="inline-block">
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
        const doctorModal = document.getElementById('doctorModal');
        const openCreateModalBtn = document.getElementById('openCreateModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const doctorForm = document.getElementById('doctorForm');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const methodField = document.getElementById('methodField');
        const editDoctorBtns = document.querySelectorAll('.editDoctorBtn');
        const passwordFields = document.getElementById('passwordFields');
        const passwordConfirmationFields = document.getElementById('passwordConfirmationFields');

        // Open modal for creating a new doctor
        openCreateModalBtn.addEventListener('click', () => {
            doctorForm.action = "{{ route('doctors.store') }}";
            methodField.value = 'POST';
            modalTitle.innerText = 'Add New Doctor';
            submitBtn.innerText = 'Add Doctor';
            doctorForm.reset(); // Clear all fields
            passwordFields.style.display = 'block';
            passwordConfirmationFields.style.display = 'block';
            doctorModal.classList.remove('hidden');
        });

        // Open modal for editing a doctor
        editDoctorBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-id');
                const name = e.target.getAttribute('data-name');
                const email = e.target.getAttribute('data-email');

                doctorForm.action = `/doctors/${id}`;
                methodField.value = 'PUT';
                modalTitle.innerText = 'Edit Doctor';
                submitBtn.innerText = 'Update Doctor';
                document.getElementById('name').value = name;
                document.getElementById('email').value = email;

                // Hide password fields when editing
                passwordFields.style.display = 'none';
                passwordConfirmationFields.style.display = 'none';

                doctorModal.classList.remove('hidden');
            });
        });

        // Close modal
        closeModalBtn.addEventListener('click', () => {
            doctorModal.classList.add('hidden');
        });
    </script>
</x-app-layout>
