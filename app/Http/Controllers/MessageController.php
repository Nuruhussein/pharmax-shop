<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Validate image
        ]);


         $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Store image
    }
    


        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
             'image' => $imagePath, // Store image path
            
        ]);

        return back()->with('success', 'Message sent!');
    }

    public function inbox(Request $request)
    {
        $authUserId = auth()->id(); 

        $selectedUserId = $request->get('receiver_id', null);

        $users = User::where('id', '!=', $authUserId)
                     ->whereIn('role', ['staff', 'doctor', 'admin','customer']) 
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
   public function delete(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        // Ensure only the sender can delete their message
        if ($message->sender_id !== Auth::id()) {
            abort(403);
        }

        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
 public function edit($id)
    {
        $message = Message::findOrFail($id);

        // Ensure only the sender can edit their message
        if ($message->sender_id !== Auth::id()) {
            abort(403);
        }

        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::findOrFail($id);

        // Ensure only the sender can update their message
        if ($message->sender_id !== Auth::id()) {
            abort(403);
        }

        $message->update([
            'message' => $request->message,
        ]);

        // Redirect back to the inbox with the correct receiver_id
    return redirect()->route('messages.inbox', ['receiver_id' => $message->receiver_id])
                     ->with('success', 'Message updated successfully.');
    }

    
}