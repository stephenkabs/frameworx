<form action="{{ route('document.assign') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="user_id" class="form-label">Select User</label>
        <select name="user_id" class="form-select" required>
            <option value="" disabled selected>Select a user</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Select Documents</label>
        @foreach($documents as $document)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="document_ids[]" value="{{ $document->id }}">
                <label class="form-check-label">
                    {{ $document->supplier_name }} (Invoice No: {{ $document->invoice_no }})
                </label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Assign Documents</button>
</form>
