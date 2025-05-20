<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">

    <!-- Loader -->
    @include('loader.loader')
    @include('toast.success_toast')

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Card for General Event Details -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a class="btn btn-info waves-effect waves-light" href="/quotations">
                                            <i class="dripicons-arrow-thin-left"></i>
                                        </a>
                                    </h4><br>

                                    <form class="row needs-validation" action="{{ route('quotations.update', $quotation->slug) }}" novalidate method="POST" enctype="multipart/form-data" id="event-form">
                                        @csrf
                                        @method('PUT') <!-- Use PUT for updating -->
                                        <div class="mb-3">
                                            <label class="form-label">Our Addresses on Quotation</label>
                                            <select name="detail_id" class="form-select" required>
                                                <option value="" disabled>Select an Address</option>
                                                @foreach ($detail as $item)
                                                    <option value="{{ $item->id }}" {{ old('detail_id', $currentDetailId ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->address }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <input type="hidden" name="status" value="{{ $quotation->status }}" >
                                        <input type="hidden" name="delivery_status" value="{{ $quotation->delivery_status }}" >

                                        <div class="mb-3">
                                            <label class="form-label">Account Number</label>
                                            <select name="account_id" class="form-select" required>
                                                <option value="" disabled>Select an Address</option>
                                                @foreach ($account as $item)
                                                    <option value="{{ $item->id }}" {{ old('account_id', $currentAccountId ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->account_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Quotation Type</label>
                                            <select name="type" id="type" class="form-select">
                                                <option value="" disabled>Select Quotation Type</option>
                                                <option value="Qty" {{ $quotation->type == 'Qty' ? 'selected' : '' }}>Product</option>
                                                <option value="Hourly" {{ $quotation->type == 'Hourly' ? 'selected' : '' }}>Service</option>
                                                <option value="Daily" {{ $quotation->type == 'Daily' ? 'selected' : '' }}>Daily Service</option>
                                                <option value="Monthly" {{ $quotation->type == 'Monthly' ? 'selected' : '' }}>Monthly Service</option>
                                                <option value="other" {{ $quotation->type == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>



                                        <!-- Client Details -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-name">Client Name</label>
                                            <input type="text" name="client_name" id="client-name" class="form-control" placeholder="Enter Client Name" value="{{ $quotation->client_name }}" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-address">Client Address</label>
                                            <input type="text" name="client_address" id="client-address" class="form-control" placeholder="Enter Client Address" value="{{ $quotation->client_address }}" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-email">Client Email</label>
                                            <input type="email" name="email" id="client-email" class="form-control" placeholder="Enter Client Email" value="{{ $quotation->email }}" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-tpin">Client TPIN</label>
                                            <input type="text" name="client_tpin" id="client-tpin" class="form-control" placeholder="Enter Client TPIN" value="{{ $quotation->client_tpin }}" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="quotation-note">Quotation Note</label>
                                            <textarea name="quotation_note" id="quotation-note" class="form-control" rows="4" placeholder="Enter Quotation Note" required>{{ $quotation->quotation_note }}</textarea>
                                        </div>

                                        <!-- Product Table -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Products</h5>
                                                <div id="ticket-container">
                                                    @foreach($quotation->items as $index => $item)
                                                    <div class="row mb-2 ticket-row">
                                                        <div class="col-md-4">
                                                            <input type="text" name="products[{{ $index }}][product_name]" class="form-control" placeholder="Product Name" value="{{ $item->product_name }}" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="products[{{ $index }}][quantity]" class="form-control quantity" placeholder="Quantity" value="{{ $item->quantity }}" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="products[{{ $index }}][price]" class="form-control price" placeholder="Price" value="{{ $item->price }}" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="products[{{ $index }}][total]" class="form-control total" placeholder="Total" value="{{ $item->total }}" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" id="add-ticket" class="btn btn-primary btn-sm mt-2">Add Product</button>

                                                <!-- Grand Total -->
                                                <div class="mt-4">
                                                    <!-- Tax Name -->
                                                    <div class="mb-2">
                                                        <label for="tax-name" class="form-label">Tax Name</label>
                                                        <input type="text" name="tax_name" id="tax-name" class="form-control" placeholder="Enter Tax Name (e.g., VAT)" value="{{ $quotation->tax_name }}">
                                                    </div>

                                                    <!-- Tax Percentage -->
                                                    <div class="mb-2">
                                                        <label for="tax-percentage" class="form-label">Tax Percentage (%)</label>
                                                        <input type="number" name="tax_percentage" id="tax-percentage" class="form-control" placeholder="Enter Tax Percentage" value="{{ $quotation->tax_percentage }}" min="0" step="0.01">
                                                    </div>


                                                    <!-- Tax Amount -->
                                                    <div class="mb-2">
                                                        <label for="tax-amount" class="form-label">Tax Amount</label>
                                                        <input type="text" name="tax_amount" id="tax-amount" class="form-control" placeholder="Tax Amount" value="{{ $quotation->tax_amount }}" readonly>
                                                    </div>

                                                    <!-- Grand Total -->
                                                    <div class="mb-2">
                                                        <label for="grand-total" class="form-label">Grand Total</label>
                                                        <input type="text" name="grand_total" id="grand-total" class="form-control" placeholder="Grand Total" value="{{ $quotation->grand_total }}" readonly>
                                                    </div>
                                                </div>

                                                <!-- Submit and Reset Buttons -->
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                                    <a href="{{ route('quotations.index') }}" class="btn btn-secondary waves-effect ms-1">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



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

    @include('includes.taskbar')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
                <a href="javascript:void(0);" class="right-bar-toggle float-end">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
                <h5 class="m-0">Settings</h5>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Demo</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"
                        data-bsStyle="/assets/css/bootstrap-dark.min.css"
                        data-appStyle="/assets/css/app-dark.min.css" />
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch"
                        data-appStyle="/assets/css/app-rtl.min.css" />
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>

                <h6 class="mt-4">Select Custom Colors</h6>
                <div class="d-flex">

                    <ul class="list-unstyled mb-0">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-default" value="default"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                            <label class="form-check-label" for="theme-default">Default</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-orange" value="orange"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                            <label class="form-check-label" for="theme-orange">Orange</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-teal" value="teal"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                            <label class="form-check-label" for="theme-teal">Teal</label>
                        </li>
                    </ul>

                    <ul class="list-unstyled mb-0 ms-4">
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-purple" value="purple"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                            <label class="form-check-label" for="theme-purple">Purple</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-green" value="green"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                            <label class="form-check-label" for="theme-green">Green</label>
                        </li>
                        <li class="form-check">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-red" value="red"
                                onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                            <label class="form-check-label" for="theme-red">Red</label>
                        </li>
                    </ul>

                </div>
                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                <label class="form-check-label" for="theme-default">Default</label>
            </div> -->

                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                <label class="form-check-label" for="theme-teal">Teal</label>
            </div> -->

                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                <label class="form-check-label" for="theme-orange">Orange</label>
            </div> -->

                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                <label class="form-check-label" for="theme-purple">Purple</label>
            </div> -->

                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                <label class="form-check-label" for="theme-green">Green</label>
            </div> -->

                <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                <label class="form-check-label" for="theme-red">Red</label>
            </div> -->
            </div>

        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

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

    {{-- <script>
    document.getElementById('add-ticket').addEventListener('click', function () {
        const container = document.getElementById('ticket-container');
        const index = container.children.length;
        const ticketRow = document.createElement('div');
        ticketRow.className = 'ticket-row';
        ticketRow.innerHTML = `
            <input type="text" name="tickets[${index}][type]" placeholder="Ticket Type (e.g., VIP)" required>
            <input type="number" name="tickets[${index}][price]" placeholder="Price" required>
            <input type="number" name="tickets[${index}][quantity]" placeholder="Quantity" required>
        `;
        container.appendChild(ticketRow);
    });
</script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ticketContainer = document.getElementById('ticket-container');
            const addTicketButton = document.getElementById('add-ticket');
            let ticketCount = 1;

            addTicketButton.addEventListener('click', function() {
                const newTicketRow = document.createElement('div');
                newTicketRow.className = 'row mb-2 ticket-row';

                newTicketRow.innerHTML = `
                <div class="col-md-4">
                    <input
                        type="text"
                        name="tickets[${ticketCount}][type]"
                        class="form-control"
                        placeholder="Ticket Type (e.g., VIP)"
                        required>
                </div>
                <div class="col-md-4">
                    <input
                        type="number"
                        name="tickets[${ticketCount}][price]"
                        class="form-control"
                        placeholder="Price"
                        required>
                </div>
                <div class="col-md-4">
                    <input
                        type="number"
                        name="tickets[${ticketCount}][quantity]"
                        class="form-control"
                        placeholder="Quantity"
                        required>
                </div>
            `;
                ticketContainer.appendChild(newTicketRow);
                ticketCount++;
            });
        });
    </script> --}}

    <script>
document.getElementById('add-ticket').addEventListener('click', function () {
    const container = document.getElementById('ticket-container');
    const index = container.getElementsByClassName('ticket-row').length;

    // Add a new product row dynamically
    const newRow = document.createElement('div');
    newRow.className = 'row mb-2 ticket-row';
    newRow.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="products[${index}][product_name]" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="products[${index}][quantity]" class="form-control quantity" placeholder="Quantity" min="1" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="products[${index}][price]" class="form-control price" placeholder="Price" min="0" step="0.01" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="products[${index}][total]" class="form-control total" placeholder="Total" readonly>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-row">Remove</button>
        </div>
    `;
    container.appendChild(newRow);
});

// Function to calculate totals for all product rows
function calculateTotals() {
    let totalSum = 0;

    document.querySelectorAll('.ticket-row').forEach(row => {
        const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;

        // Calculate row total
        const rowTotal = quantity * price;
        row.querySelector('.total').value = rowTotal.toFixed(2);

        totalSum += rowTotal;
    });

    // Update tax and grand total
    updateTaxAndGrandTotal(totalSum);
}

// Function to calculate and update tax and grand total
function updateTaxAndGrandTotal(totalSum) {
    const taxInput = document.getElementById('tax-percentage');
    const taxAmountField = document.getElementById('tax-amount');
    const grandTotalField = document.getElementById('grand-total');

    const taxPercentage = parseFloat(taxInput.value) || 0;
    const taxAmount = (totalSum * taxPercentage) / 100;
    const grandTotal = totalSum + taxAmount;

    // Update tax and grand total fields
    taxAmountField.value = taxAmount.toFixed(2);
    grandTotalField.value = grandTotal.toFixed(2);
}

// Event listeners for dynamic input fields
document.addEventListener('input', function (e) {
    const target = e.target;
    if (target.classList.contains('quantity') || target.classList.contains('price') || target.id === 'tax-percentage') {
        calculateTotals();
    }
});

// Event listener to remove rows
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.ticket-row').remove();
        calculateTotals();
    }
});

        </script>




</body>

</html>
