<?php

namespace App\Http\Controllers;

use App\Models\MessageSupport;
use Illuminate\Http\Request;

class MessageSupportController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = MessageSupport::latest()->get();
        return view('laravel-examples.message-management',compact('messages')); // Your view with the form
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store in database
        MessageSupport::create($validatedData);
        // Redirect back with success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(MessageSupport $messageSupport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageSupport $messageSupport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MessageSupport $messageSupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageSupport $messageSupport)
    {
        //
    }
}
