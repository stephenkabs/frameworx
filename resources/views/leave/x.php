
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Leave Request</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('leave.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="type" class="form-label">Leave Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="Annual Leave">Annual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Maternity Leave">Maternity Leave</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="worker_id" class="form-label">Select Worker</label>
                            <select name="worker_id" id="worker_id" class="form-control" required>
                                @foreach(App\Models\Worker::all() as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optional)</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('leave.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
