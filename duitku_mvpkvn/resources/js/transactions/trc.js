import CryptoJS from 'crypto-js';

document.addEventListener('DOMContentLoaded', function () {
    let transactionIdCounter = 1; // Initialize a counter for transaction IDs

    document.getElementById('add-transaction').addEventListener('click', function () {
        const itemName = document.getElementById('item_name').value;
        const itemPriceValue = document.getElementById('item_price').value.trim(); // Trim whitespace

        // Validate item price
        const itemPrice = parseFloat(itemPriceValue);
        const isValidPrice = /^\d+(\.\d+)?$/.test(itemPriceValue); // Regular expression for positive decimal numbers

        if (!itemName || !isValidPrice || isNaN(itemPrice) || itemPrice <= 0) {
            document.getElementById('message').innerText = 'Please enter a valid item name and a positive number for the price.';
            return;
        }

        // Append new transaction to the table
        const tableBody = document.getElementById('transactions-body');
        const row = tableBody.insertRow();
        row.insertCell(0).innerText = transactionIdCounter++;
        row.insertCell(1).innerText = itemName;
        row.insertCell(2).innerText = itemPrice.toFixed(2);

        // Clear input fields
        document.getElementById('item_name').value = '';
        document.getElementById('item_price').value = '';
        document.getElementById('message').innerText = '';
    });

    document.getElementById('pay-all').addEventListener('click', async function () {
        var moment = require('moment');

        const rows = document.querySelectorAll('#transactions-body tr');
        const _urlPaymentMethod = 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';
        const _merchantcode = 'DS19890';
        const _timestamp = moment().format('yyyy-MM-DD HH:mm:ss');

        let totalAmount = 0;

        rows.forEach(row => {
            const priceCell = row.cells[2];
            const price = parseFloat(priceCell.innerText);
            if (!isNaN(price)) {
                totalAmount += price;
            }
        });

        if (totalAmount > 0) {
            const _amount = parseInt(totalAmount);
            const signatureParams = {
                merchantcode: _merchantcode,
                paymentAmount: _amount,
                datetime: _timestamp,
            }
            const _signature = getSignature(signatureParams);
            console.log(_signature);
            try {
                const response = await fetch(_urlPaymentMethod, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: {
                        'merchantcode': _merchantcode,
                        'amount': _amount,
                        'datetime': _timestamp,
                        'signature': _signature,
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                // console.log('Payment options saved:', result);
                window.location.href = '/pay'; // Redirect on success
            } catch (error) {
                // console.error('Error:', error);
                alert('Failed to process payment. Please try again.');
            }
        } else {
            alert('No transactions to pay for.');
        }
    });
});

function getSignature(args) {
    return CryptoJS.SHA256(args.merchantcode+args.paymentAmount+args.datetime).toString();
}
