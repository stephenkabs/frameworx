<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Worker Name</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($advances as $key => $advance)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $advance->worker->name }}</td>
                <td>{{ number_format($advance->amount, 2) }}</td>
                <td>{{ $advance->date }}</td>
                <td>{{ $advance->comment ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('advance.show', $advance->slug) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('advance.edit', $advance->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('advance.destroy', $advance->slug) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
