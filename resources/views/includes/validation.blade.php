<!-- Modal for Validation Errors -->
<div class="modal fade" id="validationErrorsModal" tabindex="-1" aria-labelledby="validationErrorsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="validationErrorsLabel">
                    <i class="bi bi-exclamation-circle"></i> Validation Errors
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="bi bi-x-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add JavaScript to Trigger Modal -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var validationErrorsModal = new bootstrap.Modal(document.getElementById('validationErrorsModal'));
            validationErrorsModal.show();
        });
    </script>
@endif
