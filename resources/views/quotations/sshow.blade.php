
<div class="container">
    <h1>Quotation Details</h1>

    <!-- Quotation Information -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Client Information</h5>
            <p><strong>Name:</strong> {{ $quotation->client_name }}</p>
            <p><strong>Address:</strong> {{ $quotation->client_address }}</p>
            <p><strong>Email:</strong> {{ $quotation->email }}</p>
            <p><strong>Client TPIN:</strong> {{ $quotation->client_tpin }}</p>
            <p><strong>Quotation Note:</strong> {{ $quotation->quotation_note }}</p>
            <p><strong>Tax Name:</strong> {{ $quotation->tax_name ?? 'N/A' }}</p>
            <p><strong>Tax Percentage:</strong> {{ $quotation->tax_percentage }}%</p>
            <p><strong>Grand Total:</strong> ${{ number_format($quotation->grand_total, 2) }}</p>
        </div>
    </div>

    <!-- Product Items Table -->
    <h5>Products</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Back to Quotations List -->
    <a href="{{ route('quotations.index') }}" class="btn btn-primary">Back to Quotations</a>
</div>

