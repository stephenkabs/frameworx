
<div class="container">
    <h2>My Assigned Documents</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Name</th>
                <th>Supplier Name</th>
                <th>Assigned At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $assign)
                <tr>
                    <td>{{ $assign->document->name ?? 'N/A' }}</td>
                    <td>{{ $assign->document->supplier_name ?? 'N/A' }}</td>
                    <td>{{ $assign->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No documents assigned to you.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

