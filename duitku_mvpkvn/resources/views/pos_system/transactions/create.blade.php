@extends('layouts.app')

@section('content')
    <h1>Create New Transaction</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <select name="v_type">
            <option value="cash-in">Cash-In</option>
            <option value="cash-out">Cash-Out</option>
        </select>

        <label for="v_pay_type">Payment Type:</label>
        <select name="v_pay_type" id="v_pay_type" onchange="updateBankOptions()" required>
            <option value="">Select Payment Type</option>
            <option value="credit_card">Credit Card</option>
            <option value="virtual_account">Virtual Account</option>
            <option value="retail">Retail</option>
            <option value="e_wallet">E-Wallet</option>
            <option value="qris">QRIS</option>
            <option value="credit">Credit</option>
        </select>

        <label for="v_bank">Bank:</label>
        <select name="v_bank" id="v_bank" required>
            <option value="">Select Bank</option>
        </select>

        <input type="number" name="v_amount" placeholder="Amount" required step="1">
        <textarea name="v_description" placeholder="Description"></textarea>

        <!-- Hidden Field -->
        <input type="hidden" name="v_invoice" value="{{ $invoiceId }}">

        <button type="submit">Submit</button>
    </form>

    <script>
        const bankOptions = {
            'credit_card': ['Visa', 'MasterCard', 'JCB'],
            'virtual_account': ['BCA', 'Mandiri', 'Maybank', 'BNI', 'CIMB', 'Permata Bank', 'ATM Bersama', 'Bank Artha Graha', 'Bank Neo', 'BRIVA', 'BSS', 'Danamon', 'BSI'],
            'retail': ['Alfa', 'Indomaret'],
            'e_wallet': ['OVO', 'Shopee', 'LinkAja (Fixed Fee)', 'LinkAja (Percentage)', 'DANA', 'Shopee Pay', 'Jenius Pay'],
            'qris': ['Shopee Pay', 'LinkAja', 'Nobu', 'DANA', 'Gudang Voucher', 'Nusapay'],
            'credit': ['Indodana Pay', 'ATOME']
        };

        function updateBankOptions() {
            const paymentType = document.getElementById('v_pay_type').value;
            const bankSelect = document.getElementById('v_bank');
            bankSelect.innerHTML = '<option value="">Select Bank</option>'; // Reset options

            if (paymentType in bankOptions) {
                bankOptions[paymentType].forEach(bank => {
                    const option = document.createElement('option');
                    option.value = bank;
                    option.textContent = bank;
                    bankSelect.appendChild(option);
                });
            }
        }
    </script>
@endsection
