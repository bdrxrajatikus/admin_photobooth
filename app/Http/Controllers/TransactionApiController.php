<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'phone_number' => 'required|string',
            'price' => 'required|numeric',
            'promo_code_id' => 'nullable|numeric',
            'final_price' => 'required|numeric',
            'status' => 'required|in:success,pending,failed',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $request->validate([
            'transaction_date' => 'required|date',
            'phone_number' => 'required|string',
            'price' => 'required|numeric',
            'promo_code_id' => 'nullable|numeric',
            'final_price' => 'required|numeric',
            'status' => 'required|in:success,pending,failed',
        ]);

        $transaction->update($request->all());

        return response()->json($transaction, 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted'], 204);
    }
}
