<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class MessageController 
{
    use AuthorizesRequests;

    // Display all messages for the agency
    public function index()
    {
        $agency = Auth::guard('agency')->user();
        
        // Get all unique conversations (grouped by sender_id) for this agency
        $messages = Message::where('agency_id', $agency->id)
            ->with(['sender', 'property', 'agency'])
            ->latest()
            ->get()
            ->groupBy('sender_id');
            
        $unreadCount = Message::where('agency_id', $agency->id)
            ->where('unread', true)
            ->count();

        return view('agence.message_agence', compact('messages', 'unreadCount'));
    }

    // Store a new message from contact form
    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'content' => 'required|string|max:1000',
            'agency_id' => 'required|exists:agencies,id',
            'property_id' => 'nullable|exists:properties,id',
            'vacance_id' => 'required_without:property_id|exists:vacances,id',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => null,
            'agency_id' => $validated['agency_id'],
            'content' => $validated['content'],
            'phone' => $validated['phone'],
           'property_id' => $validated['property_id'] ?? null,
            'vacance_id' => $validated['vacance_id'] ?? null,
            'unread' => true,
            'read_status' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Votre message a été envoyé avec succès!'
        ]);
        
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue: ' . $e->getMessage()
        ], 500);
    }
}


public function getConversation($userId)
{
    $agency = Auth::guard('agency')->user();

    // Mark messages as read only for this agency
    Message::where('agency_id', $agency->id)
        ->where('sender_id', $userId)
        ->where('unread', true)
        ->update(['unread' => false]);

    // Get conversation messages only for this agency
    $messages = Message::where(function($query) use ($userId, $agency) {
            $query->where('sender_id', $userId)
                  ->where('agency_id', $agency->id);
        })
        ->orWhere(function($query) use ($userId, $agency) {
            $query->where('sender_id', $agency->id)
                  ->where('receiver_id', $userId)
                  ->where('agency_id', $agency->id);
        })
        ->with(['sender', 'property', 'agency'])
        ->orderBy('created_at', 'asc')
        ->get();
        
    $user = User::find($userId);
    $property = $messages->first()->property ?? null;
    
    return response()->json([
        'user' => $user,
        'property' => $property,
        'messages' => $messages
    ]);
}
    

    // Mark message as read
    public function markAsRead($messageId)
    {
        $agency = Auth::guard('agency')->user();
        $message = Message::where('id', $messageId)
                        ->where('agency_id', $agency->id)
                        ->firstOrFail();
                        
        $message->update(['unread' => false, 'read_status' => 1]);
        
        return response()->json(['success' => true]);
    }
}