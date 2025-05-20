
<div class="container">
    <h2>Assigned Documents</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->user->name ?? 'N/A' }}</td>
                    <td>{{ $assignment->document->supplier_name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

