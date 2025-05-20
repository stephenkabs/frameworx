<form action="{{ route('payment.create') }}" method="POST">
    @csrf
    <input type="number" name="amount" placeholder="Payment Amount" required>
    <input type="text" name="currency" value="USD" readonly>
    <input type="text" name="reference" placeholder="Reference" required>
    <button type="submit">Pay Now</button>
</form>
