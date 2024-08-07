@extends('layouts.app')

@section('content')
    <h1>Transaction Area</h1>

    <form action="{{ route('transactions.update', ['transaction' => $transactionId]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="payment_method">Payment Method</label>
            <input type="text" id="payment_method" name="payment_method" value="{{ $paymentMethod }}" readonly>
        </div>

        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{ $description }}" readonly>
        </div>

        <div>
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" value="{{ $amount }}" readonly>
        </div>

        <div>
            <label for="transfer_amount">Transfer Amount</label>
            <input type="number" id="transfer_amount" name="dt_trc_transfer_amount" value="{{ old('dt_trc_transfer_amount', $trf_amount) }}" step="1" required>
            @if ($errors->has('dt_trc_transfer_amount'))
                <div class="text-danger">{{ $errors->first('dt_trc_transfer_amount') }}</div>
            @endif
        </div>

        <div>
            <button type="submit" class="btn btn-success">Pay</button>
            <a href="{{ route('transactions.index') }}" class="btn btn-info">Back</a>
        </div>
    </form>
@endsection
