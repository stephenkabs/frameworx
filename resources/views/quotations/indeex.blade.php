
<div class="container mt-4">
    <h2 class="mb-3">Quotations List</h2>

    {{-- Display success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table to display quotations --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Client TPIN</th>
                    <th>Quotation Note</th>
                    <th>Tax Amount</th>
                    <th>Grand Total</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotations as $index => $quotation)
                    <tr>
                        <td>{{ $index + 1 }}</td> {{-- Index starts from 1 --}}
                        <td>{{ $quotation->client_name }}</td>
                        <td>{{ $quotation->email }}</td>
                        <td>{{ $quotation->client_tpin }}</td>
                        <td>{{ Str::limit($quotation->quotation_note, 50) }}</td> {{-- Short note preview --}}
                        <td>{{ number_format($quotation->tax_amount, 2) }}</td>
                        <td>{{ number_format($quotation->grand_total, 2) }}</td>
                        <td>{{ $quotation->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            {{-- Actions --}}
                            <a href="{{ route('quotations.show', $quotation->slug) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('quotations.edit', $quotation->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('quotation.exportToPDF', $quotation->slug) }}" class="btn btn-info btn-sm waves-effect waves-light">Download</a>
                            <form action="{{ route('quotations.destroy', $quotation->slug) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No quotations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link to create a new quotation --}}
    <a href="{{ route('quotations.create') }}" class="btn btn-success mt-3">Create New Quotation</a>
</div>

