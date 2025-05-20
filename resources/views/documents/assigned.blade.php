<h3>Documents Assigned to {{ $user->name }}</h3>
<ul>
    @foreach($documents as $document)
        <li>{{ $document->supplier_name }} (Invoice No: {{ $document->invoice_no }})</li>
    @endforeach
</ul>
