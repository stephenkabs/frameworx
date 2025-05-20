<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DEO-Detailed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- Button to trigger Submit Comment modal -->


                    <!-- Submit Comment Modal -->
                    <div class="modal fade" id="submitCommentModal" tabindex="-1"
                        aria-labelledby="submitCommentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitCommentModalLabel">Submit a Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('comments.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="mb-3">
                                            <label for="comment">Comment:</label>
                                            <textarea name="comment" class="form-control" required></textarea>
                                        </div>
                                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                                        <div class="mb-3">
                                            <label>Choose Signature Method:</label>
                                            <select id="signature_type" class="form-control">
                                                <option value="upload">Upload Signature</option>
                                                <option value="draw">Draw Signature</option>
                                            </select>
                                        </div>
                                        <div id="upload_signature" class="mb-3">
                                            <label for="signature">Upload Signature:</label>
                                            <input type="file" name="signature" class="form-control">
                                        </div>
                                        <div id="draw_signature" class="mb-3" style="display: none;">
                                            <label>Draw Signature:</label>
                                            <canvas id="signature-pad" class="border"></canvas>
                                            <input type="hidden" name="signature_pad" id="signature-pad-data">
                                            <button type="button" id="clear-signature"
                                                class="btn btn-danger">Clear</button>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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

                    <!-- Modal Section -->
                    {{-- <div id="clearanceModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Generate Clearance Letter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row needs-validation" action="{{ route('letter.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                    <input type="hidden" name="document_id" value="{{ $document->id }}">

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Letter To</label>
                                        <input id="letterTo" name="director" type="text" class="form-control" placeholder="Recipient's Name"  required />
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Bank Name</label>
                                        <input name="bank_name" type="text" class="form-control" placeholder="Enter Bank Name" required />
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Bank Address</label>
                                        <input name="bank_address" type="text" class="form-control" placeholder="Enter Bank Address" required />
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Letter From Name</label>
                                        <input name="prepared_by" type="text" class="form-control" placeholder="Enter Name" required />
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Letter From Position</label>
                                        <input name="position" type="text" class="form-control" placeholder="Enter Position" required />
                                    </div>

                                    <input type="hidden" name="date" value="{{ now()->format('Y-m-d') }}" />

                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Generate Clearance Letter</button>
                                            <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    <!-- Modal -->
                    <div class="modal fade" id="garnishModal" tabindex="-1" aria-labelledby="garnishModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="garnishModalLabel">Garnish Invoice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('garnish.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        {{-- <div class="mb-3">
                                            <label for="document_id" class="form-label">Select Document</label>
                                            <select name="document_id" id="document_id" class="form-control" required>
                                                <option value="">-- Select a Document --</option>
                                                @foreach($documents as $document)
                                                    <option value="{{ $document->id }}">{{ $document->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('document_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div> --}}
                                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="number" name="amount" id="amount" class="form-control" required value="{{ old('amount') }}" placeholder="Amount Garnished">
                                            @error('amount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="signature" class="form-label">Upload Signature</label>
                                            <input type="file" name="signature" id="signature" class="form-control">
                                            @error('signature')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="signature_pad" class="form-label">Signature Pad (Optional)</label>
                                            <textarea name="signature_pad" id="signature_pad" class="form-control" rows="2">{{ old('signature_pad') }}</textarea>
                                            @error('signature_pad')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div> --}}

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('garnishForm').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent default form submission
                            alert('Invoice garnished successfully!'); // Replace with actual submission logic
                            var modal = bootstrap.Modal.getInstance(document.getElementById('garnishModal'));
                            modal.hide();
                        });
                    </script>

                    <!-- View Comments Modal -->
                    <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentsModalLabel">Invoice Comments</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Comment</th>
                                                <th>Signature</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userComments as $comment)
                                                <tr>


                                                    <td style="font-size: 12px">{{ $comment->comment }}<br>
                                                    <span style="font-size: 8px; color: #6f6f6f;">{{ $comment->user->name }}</span></td>
                                                    <td>

                                                        @if ($comment->signature)

                                                            <img src="{{ asset('storage/' . $comment->signature) }}"
                                                                alt="Signature" width="100px">
                                                        @elseif ($comment->signature_pad)
                                                            <img src="{{ $comment->signature_pad }}" alt="Signature" width="100px">

                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">

                            <div class="card">
                                <div class="card-body"
                                    style="padding: 30px; background-color: #f9f9f9; border-radius: 10px;">
                                    <h4 class="card-title">

                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/documents"> <i
                                                class="dripicons-arrow-thin-left"></i>
                                        </a>
                                        {{-- <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="assign/create">Garnish This Invoice</a> --}}

                                        <a class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#garnishModal">
                                            Garnish This Invoice
                                        </a>
                                        <!-- Button to trigger View Comments modal -->
                                        <a class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#commentsModal">
                                            View Comments
                                        </a>
                                        @php
                                        // Check if the logged-in user has commented on this document
                                        $userHasCommented = $userComments->where('user_id', auth()->user()->id)->isNotEmpty();
                                    @endphp

                                    <!-- Show the comment form only if the logged-in user has NOT commented -->
                                    @if (!$userHasCommented)
                                        {{-- <a class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#submitCommentModal">
                                            Submit a Comment
                                        </a> --}}

                                        <a class="btn btn-sm waves-effect waves-light"
   data-bs-toggle="modal"
   data-bs-target="#submitCommentModal"
   style="background-color: #e4c586; color: rgb(8, 52, 105);">
    Submit a Comment
</a>

                                        @endif
                                    </h4>
                                    <div class="container">
                                        <!-- Top Image -->
                                        <div class="row mt-3">
                                            <div class="col-lg-12 text-left">
                                                <img src="/assets/images/logo-dark.png"
                                                    alt="Zambia Revenue Authority Logo" style="max-height: 100px;">
                                            </div>
                                        </div>

                                        <!-- Invoice Details -->
                                        <div class="row mt-4">
                                            <!-- Client Details -->
                                            <div class="col-lg-6">
                                                <h5 class="fw-bold">INVOICE CLIENT DETAIL</h5>
                                                <p style="color: #6f6f6f" class="mb-0">
                                                    {{ $document->supplier_name }}
                                                </p>
                                                <p style="color: #6f6f6f" class="mb-0">TPIN: {{ $document->tpin }}
                                                </p>
                                                <p style="color: #6f6f6f"class="mb-0">Invoice Date:
                                                    {{ \Carbon\Carbon::parse($document->invoice_date)->format('F j, Y') }}
                                                </p>
                                                <p style="color: #6f6f6f" class="mb-0">Invoice NO:
                                                    {{ $document->invoice_no }}</p>
                                            </div>
                                            <!-- Agent Details -->
                                            {{-- <div class="col-lg-6 text-end">
                                            <h5 class="fw-bold">AGENT DETAILS</h5>
                                            <p style="color: #6f6f6f" class="mb-0"> Company Name: {{ $document->user->company_name }}</p>
                                            <p style="color: #6f6f6f" class="mb-0"> Sent By: {{ $document->user->name }}</p>
                                            <p style="color: #6f6f6f" class="mb-0"> Sent By: {{ $document->user->name }}</p>
                                            <p style="color: #6f6f6f" style="color: #6f6f6f" class="mb-0">TPIN: {{ $document->user->tpin }}</p>
                                            <p style="color: #6f6f6f" class="mb-0">Address:  {{ $document->user->address }}</p>
                                            <p style="color: #6f6f6f" class="mb-0"> {{ $document->user->country_id }}</p>
                                        </div> --}}
                                        </div>

                                        <!-- Table Section -->
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th style="font-size: 12px">DESCRIPTION OF GOODS SUPPLIED
                                                            </th>
                                                            <th style="font-size: 12px">INVOICE AMOUNT</th>
                                                            <th style="font-size: 12px">VAT WITHHELD:</th>
                                                            <th style="font-size: 12px">AMOUNT NET OF VAT:</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $document->description }}</td>
                                                            <td>{{ $document->invoice_amount }}</td>
                                                            <td>{{ $document->vat_withheld ?? '0' }} %</td>
                                                            <td>{{ $document->amount_nv }}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        @php
                            // Check if the logged-in user has commented on this document
                            $userHasCommented = $userComments->where('user_id', auth()->user()->id)->isNotEmpty();
                        @endphp

                        <!-- Show the comment form only if the logged-in user has NOT commented -->
                        @if (!$userHasCommented)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="container">

                                            <form action="{{ route('comments.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="user_id"
                                                    value="{{ auth()->user()->id }}">

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
                                                    <input type="hidden" name="signature_pad"
                                                        id="signature-pad-data">
                                                    <button type="button" id="clear-signature"
                                                        class="btn btn-danger">Clear</button>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                        <!-- Signature Pad Script -->


                                    </div>
                                </div>
                        @endif

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div id="commentCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- First Comment -->
                                @foreach ($userComments as $comment)
                                    <div class="carousel-item active">
                                        <div class="comment-card">
                                            <div class="comment-content">
                                                <span class="quote-icon">❝</span>
                                                <p class="comment-text">
                                                    {{ $comment->comment }}
                                                </p>
                                                <p class="comment-author"><em>{{ $comment->user->name }} - DRU</em>
                                                </p>
                                            </div>
                                            @if ($comment->signature)
                                                <div class="comment-signature">
                                                    <img src="{{ asset('storage/' . $comment->signature) }}"
                                                        alt="Signature">
                                                </div>
                                            @elseif ($comment->signature_pad)
                                                <div class="comment-signature">
                                                    <img src="{{ $comment->signature_pad }}" alt="Signature">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <!-- Small Bottom Indicators -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#commentCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true"></button>
                                <button type="button" data-bs-target="#commentCarousel"
                                    data-bs-slide-to="1"></button>
                            </div>
                        </div>



                    </div>

                </div>
                <style>
                    .comment-card {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        background-color: #0e6eb8;
                        border-radius: 10px;
                        padding: 20px;
                        color: white;
                        min-height: 150px;
                    }

                    .comment-content {
                        flex: 1;
                        padding-right: 20px;
                    }

                    .quote-icon {
                        font-size: 24px;
                        color: #f1c40f;
                    }

                    .comment-text {
                        font-size: 18px;
                        font-weight: bold;
                        margin: 10px 0;
                    }

                    .comment-author {
                        font-size: 14px;
                    }

                    .comment-signature {
                        background-color: #fff0d3;
                        padding: 10px;
                        border-radius: 10px;
                    }

                    .comment-signature img {
                        width: 100px;
                        height: auto;
                    }

                    .carousel-indicators {
                        position: absolute;
                        bottom: -10px;
                        /* Move indicators below */
                        left: 50%;
                        transform: translateX(-50%);
                    }

                    .carousel-indicators button {
                        width: 8px;
                        height: 30px;
                        background-color: #c4a05d;
                        border-radius: 50%;
                        border: none;
                        margin: 5px;
                        opacity: 0.5;
                        transition: opacity 0.3s;
                    }

                    .carousel-indicators .active {
                        opacity: 1;
                        background-color: #f1c40f;
                    }
                </style>




                <!-- end col -->
                {{-- Here --}}
                <!-- end col -->
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('includes.footer')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>
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

</body>



</html>
