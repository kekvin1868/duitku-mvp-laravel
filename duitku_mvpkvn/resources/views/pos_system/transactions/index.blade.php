@extends('layouts.app')

@section('content')
    <h1>Transactions</h1>

    <!-- Form to add new transaction -->
    <div>
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>
        <label for="item_price">Price:</label>
        <input type="number" id="item_price" name="item_price" step="0.01" required>
        <button type="button" id="add-transaction">Add New Transaction</button>
    </div>

    <!-- Success/Error message -->
    <div id="message"></div>

    <!-- Table to display transactions -->
    <table>
        <thead>
            <tr>
                <th>Number</th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody id="transactions-body">
            <!-- Transactions will be appended here -->
        </tbody>
    </table>

    <button type="button" id="pay-all">Pay</button>

    <!-- Link to the compiled JavaScript file -->
    <script src="{{ asset('js/transactions/trc.js') }}"></script>
@endsection
