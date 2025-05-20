<table class="table">
    <thead>
        <tr>
            <th>Worker Name</th>
            <th>Total Leave Days</th>
            <th>Used Leave Days</th>
            <th>Remaining Leave Days</th>
        </tr>
    </thead>
    <tbody>
        @foreach($workers as $worker)
            @php
                $totalAnnualLeave = 24; // Fixed annual leave
                $usedLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function($leave) {
                    return \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                });
                $remainingLeaveDays = max($totalAnnualLeave - $usedLeaveDays, 0);
            @endphp
            <tr>
                <td>{{ $worker->name }}</td>
                <td>{{ $totalAnnualLeave }} days</td>
                <td>{{ $usedLeaveDays }} days</td>
                <td>{{ $remainingLeaveDays }} days</td>
            </tr>
        @endforeach
    </tbody>
</table>
