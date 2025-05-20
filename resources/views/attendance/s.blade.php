<style>
    .container {
    max-width: 900px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.summary-container {
    margin-top: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 5px solid #007bff;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
}

.summary-container h4 {
    text-align: left;
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
    font-weight: bold;
}

.summary-container h5 {
    font-size: 16px;
    color: #555;
    margin: 5px 0;
}


h2 {
    text-align: center;
    color: #333;
}

.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

.table th {
    background: #007bff;
    color: white;
}

.table-striped tbody tr:nth-child(odd) {
    background: #f9f9f9;
}

.table-striped tbody tr:hover {
    background: #f1f1f1;
}

.btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.btn-warning {
    background: #ffc107;
    color: #fff;
}

.btn-warning:hover {
    background: #e0a800;
}

.text-muted {
    color: #6c757d;
}

</style>
<div class="container">
    <h2>Attendance Records</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Clock In</th>
                <th>Clock Out</th>
                <th>Hours Worked</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attendance->employee->name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->clock_in }}</td>
                <td>{{ $attendance->clock_out ?? 'N/A' }}</td>
                <td>{{ $attendance->hours_worked ?? 'N/A' }}</td>
                <td>{{ $attendance->status }}</td>
                <td>
                    @if(is_null($attendance->clock_out))
                        <form action="{{ route('attendance.clockOut', $attendance->employee_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Clock Out</button>
                        </form>
                    @else
                        <span class="text-muted">Completed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

