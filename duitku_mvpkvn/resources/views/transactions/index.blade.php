@extends('layouts.app')

@section('content')
    <h1>Transactions</h1>
    <a href="{{ route('transactions.create') }}">Add New Transaction</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->dt_trc_amount }}</td>
                <td>{{ $transaction->dt_trc_type }}</td>
                <td>{{ $transaction->dt_trc_description }}</td>
                <td>{{ $transaction->dt_trc_invoice_id }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>
                    <a href="{{ route('transactions.edit', $transaction) }}">Pay</a>
                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
