
<x-app-layout>
    <div class="container mt-4">
        <div class="chat-wrapper">
            
            <div class="chat-sidebar">
                <h2 class="mb-4">Users</h2>
                <div class="user-list">
    @foreach ($users as $user)
        @if (auth()->user()->role !== 'customer' || $user->role !== 'doctor')
            <a href="{{ route('messages.inbox', ['receiver_id' => $user->id]) }}" class="user-item {{ $selectedUserId == $user->id ? 'active' : '' }}">
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-role">{{ ucfirst($user->role) }}</div>
            </a>
        @endif
    @endforeach
</div>
            </div>

            
            <div class="chat-main">
                <h1 class="mb-4">Conversation</h1>

                @if ($selectedUserId)
                    <div class="message-area">
                        @if ($messages->isEmpty())
                            <div class="no-messages">
                                <p>No messages found.</p>
                            </div>
                        @else
                            <ul class="message-list">
                                @foreach ($messages as $message)
                                    <li class="message-item {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                        <div class="message-content">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="message-input">
                        <h3>Send a Message</h3>
                        <form action="{{ route('messages.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $selectedUserId }}">
                            <div class="form-group mb-3">
                                <textarea name="message" id="message" class="form-control" rows="4" required placeholder="Type your message..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                @else
                    <div class="no-messages">
                        <p>Select a user to start the conversation.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>


<style>
        .chat-wrapper {
            display: flex;
            height: 80vh;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        .chat-sidebar {
            width: 25%;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ccc;
        }

        .user-list {
            margin-top: 20px;
        }

        .user-item {
            display: block;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-decoration: none;
            color: black;
        }

        .user-item.active {
            background-color: #007bff;
            color: white;
        }

        .user-name {
            font-weight: bold;
        }

        .user-role {
            font-size: 0.9rem;
            color: #666;
        }

        .chat-main {
            width: 75%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            background-color: #fff;
        }

        .message-area {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
        }

        .message-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .message-item {
            background-color: #f8f8f8;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
        }

        .message-item.sent {
            justify-content: flex-end;
        }

        

        .message-content {
            margin-top: 5px;
            font-size: 1.1rem;
        }

        .no-messages {
            text-align: center;
            padding: 20px;
            font-size: 1.2rem;
            color: #999;
        }

        .message-input {
            border-top: 1px solid #ccc;
            padding: 10px 0;
        }

        .message-input textarea {
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
        }

        .message-input button {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</x-app-layout>
