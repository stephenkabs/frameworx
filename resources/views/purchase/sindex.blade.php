


<div class="container">
    <h1>Purchase History</h1>

    {{-- <h2>Welcome, {{ $user->name }}</h2> --}}

    <table class="table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Ticket Type</th>
                <th>Quantity</th>
                <th>Transaction Number</th>
                <th>Status</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase as $purchase)
                <tr>
                    <td>{{ $purchase->event->name ?? 'N/A' }}</td>
                    <td>{{ $purchase->ticket->type ?? 'N/A' }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ $purchase->transaction_number }}</td>
                    <td>{{ ucfirst($purchase->status) }}</td>
                    <td>{{ $purchase->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

