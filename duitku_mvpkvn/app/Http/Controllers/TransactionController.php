<?php

namespace App\Http\Controllers;

use App\Models\Ms_Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Ms_Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $invoiceId = "SS-" . Str::uuid()->toString();
        return view('transactions.create', compact('invoiceId'));
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        $validated = $request->validate([
            'v_amount' => 'required|integer',
            'v_type' => 'required|in:' . implode(',', Ms_Transaction::getTransactionTypes()),
            'v_description' => 'nullable|string',
            'v_invoice' => 'nullable|string',
        ]);

        $transactionData = [
            'dt_trc_amount' => (int)$validated['v_amount'],
            'dt_trc_type' => $validated['v_type'],
            'dt_trc_description' => $validated['v_description'],
            'dt_trc_invoice_id' => $validated['v_invoice'],
        ];

        try {
            Ms_Transaction::create($transactionData);
            return redirect()->route('transactions.index')->with('status', 'Transaction created successfully.');
        } catch (\Exception $e) {
            Log::error('Transaction creation failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create transaction.']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Ms_Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Ms_Transaction $transaction)
    {
        $request->validate([
            'u_amount' => 'required|numeric',
            'u_type' => 'required|in:debit,credit',
            'u_description' => 'nullable|string',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Ms_Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}

?>
