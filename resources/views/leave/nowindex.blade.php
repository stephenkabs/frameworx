<table id="tech-companies-1" class="table table-striped">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Used Days</th>
            <th>Remaining Annual Leave</th>
            <th>Leave in Monetary</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($workers->isEmpty())
            <tr>
                <td colspan="8" class="text-center">
                    <div style="margin-top: 20px;">
                        <h5>No Leave Records Found</h5>
                    </div>
                </td>
            </tr>
        @else
            @foreach ($workers as $worker)
                @php
                    $totalAnnualLeave = 24; // Fixed annual leave days
                    $usedAnnualLeaveDays = $worker->leaves->where('type', 'Annual Leave')->sum(function ($leave) {
                        return \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                    });
                    $remainingAnnualLeaveDays = max($totalAnnualLeave - $usedAnnualLeaveDays, 0);
                @endphp

                @foreach ($worker->leaves as $leave)
                    @php
                        $usedLeaveDays = \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                        $leaveMonetaryValue = $usedLeaveDays * $worker->salary->daily_earnings;
                    @endphp

                    <tr>
                        <td>
                            <b>{{ $worker->name }}</b>
                        </td>
                        <td>{{ $leave->type }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                        <td>
                            <b>{{ $usedLeaveDays }} days</b>
                        </td>
                        <td>
                            @if($leave->type === 'Annual Leave')
                                <b>{{ $remainingAnnualLeaveDays }} days</b>
                            @else
                                <span style="color: gray;">N/A</span>
                            @endif
                        </td>
                        <td>
                            <b>{{ number_format($leaveMonetaryValue, 2) }}</b>
                        </td>
                        <td>
                            <a href="{{ route('leave.edit', $leave->slug) }}" class="btn btn-info">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger delete-leave-btn"
                                data-bs-toggle="modal" data-bs-target="#deleteMinistryModal"
                                data-route="{{ route('leave.destroy', $leave->slug) }}">
                                <i class="dripicons-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endif
    </tbody>
</table>
