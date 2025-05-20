<!-- Modal -->
<style>/* Slide up animation */
    /* Set the modal background to be transparent */
    .modal-transparent-content {
        background: rgba(237, 246, 255, 0.8); /* Semi-transparent white */
        border-radius: 20px;
        backdrop-filter: blur(100px); /* Optional: Adds a nice blur effect */
    }

    /* Set the modal to only cover half the screen */
    .modal-half-screen {
        height: 50%; /* Make the modal half the screen height */
        max-height: 50%;
    }

    /* Optional: Add some margin and padding for better presentation */
    .modal-header, .modal-body {
        padding: 20px;
    }

    /* Customize the modal fade up animation */
    .modal.fade .modal-dialog {
        transform: translateY(100%);
        transition: transform 0.4s ease-out;
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
    }

        </style>
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-half-screen">
        <div class="modal-content modal-transparent-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Quick Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center" class="card-title">

                    <a class="btn btn-info waves-effect waves-light" href="/testimony/create"><b>Send Testimony</b></a>
                    <a class="btn btn-info waves-effect waves-light" href="/program"><b>Church Programes</b></a>
                    {{-- <a class="btn btn-info waves-effect waves-light" href="/donations/create"><b>Give</b></a> --}}
                    <br><br>
                    <a class="btn btn-info waves-effect waves-light" href="/attendances/create"><b>Attend Service</b></a>
                    <a class="btn btn-info waves-effect waves-light" href="/member/create"><b>Register Member</b></a>
                    {{-- <a class="btn btn-info waves-effect waves-light" href="/donations/create">Donate Now</a> --}}
                </h4>
            </div>
        </div>
    </div>
</div>
