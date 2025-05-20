@foreach ($comments as $comment)
    <p><strong>{{ $comment->user->name }}s</strong>: {{ $comment->comment }}</p>

    @if ($comment->signature)
        <p>Uploaded Signature:</p>
        <img src="{{ asset('storage/' . $comment->signature) }}" width="200">
    @elseif ($comment->signature_pad)
        <p>Drawn Signature:</p>
        <img src="{{ $comment->signature_pad }}">
    @endif
@endforeach
