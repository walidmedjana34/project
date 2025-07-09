<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController 
{
    public function index()
    {
        return response()->json(Transaction::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $transaction = Transaction::create($request->all());
        return response()->json(['message' => 'Transaction created successfully!', 'transaction' => $transaction]);
    }
}
