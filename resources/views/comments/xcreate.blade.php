
<div class="container">
    <h2>Submit a Comment</h2>
    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div class="mb-3">
            <label for="comment">Comment:</label>
            <textarea name="comment" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Choose Signature Method:</label>
            <select id="signature_type" class="form-control">
                <option value="upload">Upload Signature</option>
                <option value="draw">Draw Signature</option>
            </select>
        </div>

        <!-- Upload Signature -->
        <div id="upload_signature" class="mb-3">
            <label for="signature">Upload Signature:</label>
            <input type="file" name="signature" class="form-control">
        </div>

        <!-- Draw Signature -->
        <div id="draw_signature" class="mb-3" style="display: none;">
            <label>Draw Signature:</label>
            <canvas id="signature-pad" class="border"></canvas>
            <input type="hidden" name="signature_pad" id="signature-pad-data">
            <button type="button" id="clear-signature" class="btn btn-danger">Clear</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Signature Pad Script -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
<script>
    let signaturePad = new SignaturePad(document.getElementById('signature-pad'));
    let signaturePadData = document.getElementById('signature-pad-data');

    document.getElementById('clear-signature').addEventListener('click', function() {
        signaturePad.clear();
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        if (!signaturePad.isEmpty()) {
            signaturePadData.value = signaturePad.toDataURL();
        }
    });

    document.getElementById('signature_type').addEventListener('change', function() {
        if (this.value === 'upload') {
            document.getElementById('upload_signature').style.display = 'block';
            document.getElementById('draw_signature').style.display = 'none';
        } else {
            document.getElementById('upload_signature').style.display = 'none';
            document.getElementById('draw_signature').style.display = 'block';
        }
    });
</script>

