<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent!');
    }

    public function inbox(Request $request)
    {
        $authUserId = auth()->id(); 

        $selectedUserId = $request->get('receiver_id', null);

        $users = User::where('id', '!=', $authUserId)
                     ->whereIn('role', ['staff', 'doctor', 'admin']) 
                     ->get();

        if ($selectedUserId) {
            $messages = Message::where(function ($query) use ($authUserId, $selectedUserId) {
                $query->where('sender_id', $authUserId)
                    ->where('receiver_id', $selectedUserId);
            })->orWhere(function ($query) use ($authUserId, $selectedUserId) {
                $query->where('sender_id', $selectedUserId)
                    ->where('receiver_id', $authUserId);
            })->orderBy('created_at', 'asc')->with('sender')->get();
        } else {
            $messages = collect();
        }

        return view('messages.inbox', compact('users', 'messages', 'selectedUserId'));
    }

    
}
