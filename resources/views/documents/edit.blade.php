<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Invoice</title>
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

    @include('includes.validation')
@include('toast.success_toast')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"><a class="btn btn-info waves-effect waves-light" href="/documents"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                @if ( session('status'))

                                <div class="alert alert-success">{{ session('status') }}</div>

                                @endif

                                <form class="row needs-validation" action="{{ route('documents.update', $document->slug) }}" novalidate method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Left Column -->
                                    <div class="col-lg-6">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="supplier_name">Supplier Name</label>
                                            <input type="text" name="supplier_name" class="form-control" id="supplier_name"
                                                value="{{ old('supplier_name', $document->supplier_name) }}" placeholder="Supplier Name" required />
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="tpin">TPIN</label>
                                            <input type="text" name="tpin" class="form-control" id="tpin"
                                                value="{{ old('tpin', $document->tpin) }}" placeholder="TPIN" required />
                                            <a href="https://portal.zra.org.zm/searchTaxpayer#!" target="_blank" class="text-primary mt-2 d-block">
                                                Search Tax Payers to Confirm TPIN
                                            </a>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Currency</label>
                                            <select name="currency" class="form-select" required>
                                                <option value="" disabled>Select Currency</option>
                                                <option value="ZMW" {{ $document->currency == 'ZMW' ? 'selected' : '' }}>ZMW</option>
                                                <option value="USD" {{ $document->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                <option value="EUR" {{ $document->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="invoice_date">Invoice Date</label>
                                            <input type="date" name="invoice_date" class="form-control" id="invoice_date"
                                                value="{{ old('invoice_date', $document->invoice_date) }}" required />
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="invoice_no">Invoice No.</label>
                                            <input type="text" name="invoice_no" class="form-control" id="invoice_no"
                                                value="{{ old('invoice_no', $document->invoice_no) }}" required />
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="invoice_amount">Invoice Amount</label>
                                            <input type="number" name="invoice_amount" class="form-control" id="invoice_amount"
                                                value="{{ old('invoice_amount', $document->invoice_amount) }}" required />
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="vat_withheld">VAT Withheld</label>
                                            <input type="number" name="vat_withheld" class="form-control" id="vat_withheld"
                                                value="{{ old('vat_withheld', $document->vat_withheld) }}" required />
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="amount_nv">Amount Net of VAT</label>
                                            <input type="number" name="amount_nv" class="form-control" id="amount_nv"
                                                value="{{ old('amount_nv', $document->amount_nv) }}" readonly />
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Description of Goods Supplied</label>
                                            <textarea name="description" class="form-control" rows="5">{{ old('description', $document->description) }}</textarea>
                                        </div>

                                        <div class="mb-0">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            <a href="{{ route('documents.index') }}" class="btn btn-secondary waves-effect ms-1">Cancel</a>
                                        </div>
                                    </div>
                                </form>


                                <style>
                                    .form-control {
                                        background-color: #edeaea;
                                    }

                                    .form-select {
                                        background-color: #edeaea;
                                    }

                                    textarea.form-control {
                                        background-color: #edeaea;
                                    }
                                </style>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->

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

<script>
    document.getElementById('invoiceAmount').addEventListener('input', calculateNetAmount);
    document.getElementById('vatWithheld').addEventListener('input', calculateNetAmount);

    function calculateNetAmount() {
        var invoiceAmount = parseFloat(document.getElementById('invoiceAmount').value) || 0;
        var vatWithheld = parseFloat(document.getElementById('vatWithheld').value) || 0;
        var tax = invoiceAmount * (vatWithheld /100);
        var netAmount = invoiceAmount - tax;
        document.getElementById('amountNV').value = netAmount.toFixed(2);
    }
    </script>

    <script>

function showSuccessMessage() {
    // Create the success message element
    const message = document.createElement('div');
    message.className = 'success-message';
    message.textContent = 'Operation successful!';

    // Append the message to the container
    const container = document.getElementById('message-container');
    container.appendChild(message);

    // Set a timer to remove the message after 3 minutes (180,000 milliseconds)
    setTimeout(() => {
        container.removeChild(message);
    }, 180000); // 3 minutes
}
    </script>

    @include('toast.error_success_js')

</body>

</html>
