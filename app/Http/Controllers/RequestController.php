<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController 
{
    public function index()
    {
        return response()->json(Request::all());
    }

    public function store(HttpRequest $request)
    {
        
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:requests,email',
                'phone_number' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'agency_type' => 'required|in:Sales,Rental,Consulting,Multi-service',
                'password' => 'required|string|min:8|confirmed',  // The password confirmation rule
                'manager_name' => 'required|string|max:255',
                'tax_identifier' => 'required|string|max:50',
                'trade_register' => 'required|string|max:50|unique:requests,trade_register',
                'website' => 'nullable|url',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
            ]);
            
            // Store the validated data
            $newRequest = Request::create($validatedData);
            
            return response()->json(['message' => 'Request submitted successfully!', 'request' => $newRequest]);
      
    }
// Approve a request
public function approve(Request $request)
{
    $request->status = 'approved';
    $request->save();

    return response()->json(['message' => 'Request approved successfully!', 'request' => $request]);
}

// Reject a request
public function reject(Request $request)
{
    $request->status = 'rejected';
    $request->save();

    return response()->json(['message' => 'Request rejected successfully!', 'request' => $request]);
}

    public function update(HttpRequest $request, Request $requestModel)
    {
        $requestModel->update($request->all());
        return response()->json(['message' => 'Request updated successfully!', 'request' => $requestModel]);
    }

    public function destroy(Request $request)
    {
        $request->delete();
        return response()->json(['message' => 'Request deleted successfully!']);
    }
}
