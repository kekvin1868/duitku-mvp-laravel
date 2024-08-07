<?php

namespace App\Http\Controllers;

use App\Models\Ms_Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    private function generateUniqueInvoiceId()
    {
        do
        {
            $letters = strtoupper(Str::random(3));
            $numbers = random_int(100, 999);
            $invoiceId = "SS-" . $letters . $numbers;
        } while (Ms_Transaction::where('dt_trc_invoice_id', $invoiceId)->exists());

        return $invoiceId;
    }

    public function showPaymentMenu($id)
    {
        $transaction = Ms_Transaction::findOrFail($id);

        return view('transactions.pay', [
            'transactionId' => $transaction->id,
            'paymentMethod' => $transaction->dt_trc_payment,
            'description' => $transaction->dt_trc_description,
            'amount' => $transaction->dt_trc_amount,
            'trf_amount' => $transaction->dt_trc_transfer_amount,
        ]);
    }

    public function index()
    {
        $transactions = Ms_Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $invoiceId = $this->generateUniqueInvoiceId();
        return view('transactions.create', compact('invoiceId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'v_amount' => 'required|integer',
            'v_type' => 'required|in:' . implode(',', Ms_Transaction::getTransactionTypes()),
            'v_description' => 'nullable|string',
            'v_invoice' => 'nullable|string',
            'v_pay_type' => 'required|in:' . implode(',', Ms_Transaction::getPaymentTypes()),
            'v_bank' => 'required|in:' . implode(',', Ms_Transaction::getBankTypes()),
        ]);

        $transactionData = [
            'dt_trc_amount' => (int)$validated['v_amount'],
            'dt_trc_type' => $validated['v_type'],
            'dt_trc_description' => $validated['v_description'],
            'dt_trc_invoice_id' => $validated['v_invoice'],
            'dt_trc_payment' => $validated['v_pay_type'],
            'dt_trc_bank' => $validated['v_bank'],
        ];

        try {
            Ms_Transaction::create($transactionData);
            return redirect()->route('transactions.index')->with('status', 'Transaction created successfully.');
        } catch (\Exception $e) {
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
        Log::info('Update attempt for transaction ID: ' . $transaction->id);

        $transaction = Ms_Transaction::findOrFail($transaction->id);

        $validatedData = $request->validate([
            'dt_trc_transfer_amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($transaction) {
                    $trcAmount = (float) $transaction->dt_trc_amount;
                    $inputAmount = (float) $value;

                    if ($inputAmount !== $trcAmount) {
                        $fail('The ' . $attribute . ' must be exactly ' . $transaction->dt_trc_amount . '.');
                    }
                }
            ],
        ]);

        try {
            $transaction->dt_trc_transfer_amount = $request->input('dt_trc_transfer_amount');
            $transaction->dt_trc_status = 'SUCCESS';
            $transaction->save();

            // Log success
            Log::info('Transaction ID ' . $transaction->id . ' updated successfully.');
            // Redirect with a success message
            return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to update transaction ID ' . $transaction->id . '. Error: ' . $e->getMessage());
            // Redirect with an error message
            return redirect()->back()->with('error', 'Failed to update transaction. Please try again.');
        }
    }

    public function destroy(Ms_Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}

?>
