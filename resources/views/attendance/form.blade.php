
<div class="container">
    <h2>Employee Attendance</h2>

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="employee_id" class="form-label">Select Employee</label>
            <select class="form-control" name="employee_id" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Attendance Status</label>
            <select class="form-control" name="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
</div>
