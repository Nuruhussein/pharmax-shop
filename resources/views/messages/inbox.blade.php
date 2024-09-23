<x-app-layout>
    <div class="container mx-auto mt-4">
        
        @role('customer')
        <nav class="flex mb-4 text-center justify-start   items-center h-24 text-gray-600 ju   rounded-lg shadow-xs dark:bg-gray-800" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="text-xl text-gray-700 hover:text-gray-900 dark:hover:text-white">
                    <svg class="h-6 w-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l7-7 7 7M5 10v10a2 2 0 002 2h10a2 2 0 002-2V10"/>
                    </svg>
                    Home
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="ml-2 text-xl">Message</span>
            </li>
        </ol>
    </nav>
    @endrole
        <div class="flex h-[80vh] border rounded-lg overflow-hidden">

            <!-- Sidebar -->
            <div class="w-1/4 bg-gray-100 p-5 border-r">
                <h2 class="text-xl font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3-7a3 3 0 116 0H7z" clip-rule="evenodd" />
                    </svg>
                    Users
                </h2>
                <div class="user-list">
                    @php
                        $currentUserRole = auth()->user()->role;
                        $customerUsers = [];
                        $nonCustomerUsers = [];
                    @endphp

                    @foreach ($users as $user)
                        @php
                            $showUser = false;

                            // Logic to filter users based on roles
                            if ($currentUserRole == 'admin' && in_array($user->role, ['staff', 'customer', 'doctor'])) {
                                $showUser = true;
                            } elseif ($currentUserRole == 'staff' && in_array($user->role, ['customer', 'doctor', 'admin'])) {
                                $showUser = true;
                            } elseif ($currentUserRole == 'doctor' && in_array($user->role, ['staff', 'admin'])) {
                                $showUser = true;
                            } elseif ($currentUserRole == 'customer' && in_array($user->role, ['admin', 'staff'])) {
                                $showUser = true;
                            }
                        @endphp

                        @if ($showUser)
                            @if ($user->role == 'customer')
                                @php
                                    $customerUsers[] = $user;
                                @endphp
                            @else
                                @php
                                    $nonCustomerUsers[] = $user;
                                @endphp
                            @endif
                        @endif
                    @endforeach

                    <!-- Non-customer users list -->
                    @foreach ($nonCustomerUsers as $user)
                        <a href="{{ route('messages.inbox', ['receiver_id' => $user->id]) }}" class="flex items-center p-2 mb-2 bg-white hover:bg-blue-50 rounded-lg border {{ $selectedUserId == $user->id ? 'bg-blue-100' : '' }}">
                            <div>
                                <div class="font-semibold">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ ucfirst($user->role) }}</div>
                            </div>
                        </a>
                    @endforeach

                    <!-- Dropdown for customers -->
                    @if (count($customerUsers) > 0)
                        <div class="mt-4">
                            <label for="customerDropdown" class="block text-sm font-medium text-gray-700">Select a Customer:</label>
                            <select id="customerDropdown" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="if (this.value) window.location.href=this.value;">
                                <option value="">Choose a customer...</option>
                                @foreach ($customerUsers as $user)
                                    <option value="{{ route('messages.inbox', ['receiver_id' => $user->id]) }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} (Customer)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Chat Main Area -->
            <div class="w-3/4 flex flex-col justify-between p-6 bg-white">
                <h1 class="text-2xl font-bold mb-6">Conversation</h1>

                @if ($selectedUserId)
                    <div class="message-area flex-1 overflow-y-auto mb-6 pr-2">
                        @if ($messages->isEmpty())
                            <div class="flex items-center justify-center h-full text-gray-500">
                                <p>No messages found.</p>
                            </div>
                        @else
                            <ul class="message-list space-y-4">
                                @foreach ($messages as $message)
                                    <li class="message-item flex {{ $message->sender_id == auth()->id() ? 'justify-start' : 'justify-end' }} relative">
                                        @if ($message->sender_id == auth()->id())
                                            <div class="bg-blue-50 shadow-lg text-xl text-gray-800 p-3 rounded-lg max-w-xs text-right relative message-container">
                                                <p>{{ $message->message }}</p>

                                                <!-- Hidden Delete and Edit Buttons -->
                                                <div class="hidden buttons absolute top-0 right-0 transform translate-x-3 -translate-y-3  space-x-2">
                                                    <div class="flex ">
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('messages.edit', $message->id) }}" class="text-white text-sm p-1 mx-1 rounded-md bg-green-200 hover:bg-green-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4v16m8-8H4" />
                                                        </svg>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('messages.delete', $message->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-white text-sm p-1 mx-1 bg-red-200 rounded-md hover:bg-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6.293 7.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414L11.414 11l2.293 2.293a1 1 0 01-1.414 1.414L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 11 6.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <!-- Received Message -->
                                            <div class="bg-gray-50 shadow-lg text-xl text-black p-3 rounded-lg max-w-xs">
                                                <p>{{ $message->message }}</p>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Message Input -->
                    <div class="message-input border-t pt-4">
                        <h3 class="text-lg font-semibold mb-3">Send a Message</h3>
                        <form action="{{ route('messages.send') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $selectedUserId }}">
                            <textarea name="message" id="message" rows="4" class="w-full border rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required placeholder="Type your message..."></textarea>
                            <button type="submit" class="w-60 flex justify-center bg-blue-500 text-2xl text-white py-2 shadow-2xl rounded-lg hover:bg-gray-500">Send</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center justify-center h-full text-gray-500">
                        <p>Select a user to start the conversation.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
 

    <!-- Right Click Logic Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const messageContainers = document.querySelectorAll('.message-container');

            messageContainers.forEach(container => {
                container.addEventListener('contextmenu', function (event) {
                    event.preventDefault(); // Prevent the default right-click menu

                    // Hide all other buttons first
                    document.querySelectorAll('.buttons').forEach(buttons => {
                        buttons.classList.add('hidden');
                    });

                    // Show the buttons for this specific message
                    const buttons = container.querySelector('.buttons');
                    if (buttons) {
                        buttons.classList.remove('hidden');
                    }
                });
            });

            // Hide buttons when clicking outside the message
            document.addEventListener('click', function (event) {
                if (!event.target.closest('.message-container')) {
                    document.querySelectorAll('.buttons').forEach(buttons => {
                        buttons.classList.add('hidden');
                    });
                }
            });
        });
    </script>
</x-app-layout>
