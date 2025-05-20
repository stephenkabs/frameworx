<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Quotation</title>
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

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('client.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="client-name" class="form-label">Client Name</label>
                        <input type="text" name="client_name" id="client-name" class="form-control" placeholder="Enter Client Name" >
                    </div>
                    <div class="mb-3">
                        <label for="client-email" class="form-label">Client Email</label>
                        <input type="email" name="email" id="client-email" class="form-control" placeholder="Enter Client Email" >
                    </div>
                    <div class="mb-3">
                        <label for="client-phone" class="form-label">Client Phone</label>
                        <input type="text" name="phone" id="client-phone" class="form-control" placeholder="Enter Client Phone" >
                    </div>
                    <div class="mb-3">
                        <label for="client-phone" class="form-label">Client TPIN</label>
                        <input type="text" name="client_tpin" id="client-phone" class="form-control" placeholder="Enter TPIN" >
                    </div>
                    <div class="mb-3">
                        <label for="client-address" class="form-label">Client Address</label>
                        <textarea name="client_address" id="client-address" class="form-control" rows="3" value="Address" >Address</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Client</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.validation')




    <!-- Loader -->

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

                                    {{-- <form class="row needs-validation" action="{{ route('quotations.store') }}" novalidate method="POST" enctype="multipart/form-data" id="event-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Our Addresses on Quotation</label>
                                            <select name="detail_id" class="form-select" required>
                                                <option value="" disabled selected>Select a Address</option>
                                                @foreach ($detail as $item)
                                                    <option value="{{ $item->id }}">{{ $item->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="hidden" name="status" value="unapproved" >
                                        <input type="hidden" name="delivery_status" value="pending" >

                                        <div class="mb-3">
                                            <label class="form-label">Account Details</label>
                                            <select name="account_id" class="form-select" >
                                                <option value="" disabled selected>Select Bank Account</option>
                                                @foreach ($account as $item)
                                                    <option value="{{ $item->id }}">{{ $item->account_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Quotation Type</label>
                                            <select name="type" class="form-select">
                                                <option value="" disabled selected>Select Qutation Type</option>
                                                <option value="Qty">Product</option>
                                                <option value="Hourly">Service</option>
                                                <option value="Daily">Daily Service</option>
                                                <option value="Monthly">Monthly Service</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <!-- Client Details -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-name">Client Name</label>
                                            <input type="text" name="client_name" id="client-name" class="form-control" placeholder="Enter Client Name" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-address">Client Address</label>
                                            <input type="text" name="client_address" id="client-address" class="form-control" placeholder="Enter Client Address" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-email">Client Email</label>
                                            <input type="email" name="email" id="client-email" class="form-control" placeholder="Enter Client Email" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-tpin">Phone Number</label>
                                            <input type="text" name="phone" id="client-tpin" class="form-control" placeholder="Enter Phone Number" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="client-tpin">Client TPIN</label>
                                            <input type="text" name="client_tpin" id="client-tpin" class="form-control" placeholder="Enter Client TPIN" required>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="quotation-note">Quotation Note</label>
                                            <textarea name="quotation_note" id="quotation-note" class="form-control" rows="4" placeholder="Enter Quotation Note" required></textarea>
                                        </div>

                                        <!-- Product Table -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Products</h5>
                                                <div id="ticket-container">
                                                    <div class="row mb-2 ticket-row">
                                                        <div class="col-md-4">
                                                            <input type="text" name="products[0][product_name]" class="form-control" placeholder="Product Name" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="products[0][quantity]" class="form-control quantity" placeholder="Quantity" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="products[0][price]" class="form-control price" placeholder="Price" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="products[0][total]" class="form-control total" placeholder="Total" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="add-ticket" class="btn btn-primary btn-sm mt-2">Add Product</button>

                                                <!-- Grand Total -->
                                                <div class="mt-4">
                                                    <!-- Tax Name -->
                                                    <div class="mb-2">
                                                        <label for="tax-name" class="form-label">Tax Name</label>
                                                        <input type="text" name="tax_name" id="tax-name" class="form-control" placeholder="Enter Tax Name (e.g., VAT)">
                                                    </div>

                                                    <!-- Tax Percentage -->
                                                    <div class="mb-2">
                                                        <label for="tax-percentage" class="form-label">Tax Percentage (%)</label>
                                                        <input type="number" name="tax_percentage" id="tax-percentage" class="form-control" placeholder="Enter Tax Percentage" min="0" step="0.01">
                                                    </div>

                                                    <!-- Tax Amount -->
                                                    <div class="mb-2">
                                                        <label for="tax-amount" class="form-label">Tax Amount</label>
                                                        <input type="text" name="tax-amount" id="tax-amount" class="form-control" placeholder="Tax Amount" readonly>
                                                    </div>

                                                    <!-- Grand Total -->
                                                    <div class="mb-2">
                                                        <label for="grand-total" class="form-label">Grand Total</label>
                                                        <input type="text" name="grand_total" id="grand-total" class="form-control" placeholder="Grand Total" readonly>
                                                    </div>
                                                </div>

                                                <!-- Submit and Reset Buttons -->
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                    <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}

                                    <form class="row needs-validation" action="{{ route('quotations.store') }}" novalidate method="POST" enctype="multipart/form-data" id="event-form">
                                        @csrf
                                        <div class="row">
                                            <!-- Column 1 -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Clients</label>
                                                    <select name="client_id" class="form-select" required>
                                                        <option value="" disabled selected>Select a Clients</option>
                                                        @foreach ($clients as $item)
                                                            <option value="{{ $item->id }}">{{ $item->client_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- Trigger Button -->
                                                    <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#clientModal">
                                                        Add New Client
                                                    </button>
                                                </div>

                                                <input type="hidden" name="status" value="unapproved">
                                                <input type="hidden" name="delivery_status" value="pending">

                                                <div class="mb-3">
                                                    <label class="form-label">Account Details</label>
                                                    <select name="account_id" class="form-select">
                                                        <option value="" disabled selected>Select Bank Account</option>
                                                        @foreach ($account as $item)
                                                            <option value="{{ $item->id }}">{{ $item->account_name }}</option>
                                                        @endforeach
                                                    </select>
                                                                              <!-- Trigger Button -->
                                                                              <a type="button" class="btn btn-primary btn-sm mt-2" href="/accounts/create">
                                                                                Add New Client
                                                                              </a>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Quotation Type</label>
                                                    <select name="type" class="form-select">
                                                        <option value="" disabled selected>Select Quotation Type</option>
                                                        <option value="Qty">Product</option>
                                                        <option value="Hourly">Service</option>
                                                        <option value="Daily">Daily Service</option>
                                                        <option value="Monthly">Monthly Service</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Column 2 -->
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label">Our Addresses on Quotation</label>
                                                    <select name="detail_id" class="form-select" required>
                                                        <option value="" disabled selected>Select an Address</option>
                                                        @foreach ($detail as $item)
                                                            <option value="{{ $item->id }}">{{ $item->address }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="quotation-note">Quotation Note</label>
                                                    <textarea name="quotation_note" id="quotation-note" class="form-control" rows="5" placeholder="Enter Quotation Note" ></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Full-width Section for Product Table -->
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5>Products</h5>
                                                    <div id="ticket-container">
                                                        <div class="row mb-2 ticket-row">
                                                            <div class="col-md-4">
                                                                <input type="text" name="products[0][product_name]" class="form-control" placeholder="Product Name" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number" name="products[0][quantity]" class="form-control quantity" placeholder="Quantity" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number" name="products[0][price]" class="form-control price" placeholder="Price" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" name="products[0][total]" class="form-control total" placeholder="Total" readonly>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-ticket" class="btn btn-primary btn-sm mt-2">Add Product</button>

                                                    <!-- Tax and Grand Total Section -->
                                                    <div class="mt-4">
                                                        <div class="mb-3">
                                                            <label for="tax_name" class="form-label">Tax Type</label>
                                                            <select class="form-control" name="tax_name" required>
                                                                <option value="VAT">VAT</option>
                                                                <option value="TOT">TOT</option>
                                                                <option value="PAYE">PAYE</option>
                                                                <option value="WT">Withholding Tax.</option>

                                                            </select>
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="tax-percentage" class="form-label">Tax Percentage (%)</label>
                                                            <input type="number" name="tax_percentage" id="tax-percentage" class="form-control" placeholder="Enter Tax Percentage" min="0" step="0.01">
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="tax-amount" class="form-label">Tax Amount</label>
                                                            <input type="text" name="tax_amount" id="tax-amount" class="form-control" placeholder="Tax Amount" readonly>
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="grand-total" class="form-label">Grand Total</label>
                                                            <input type="text" name="grand_total" id="grand-total" class="form-control" placeholder="Grand Total" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            const taxName = document.querySelector("select[name='tax_name']");
                                            const taxPercentage = document.getElementById("tax-percentage");
                                            const taxAmount = document.getElementById("tax-amount");

                                            function updateTaxFields() {
                                                if (["TOT", "PAYE", "WT"].includes(taxName.value)) {
                                                    taxPercentage.value = 0;
                                                    taxPercentage.style.display = "none";
                                                    taxAmount.style.display = "none";
                                                } else {
                                                    taxPercentage.style.display = "block";
                                                    taxAmount.style.display = "block";
                                                }
                                            }

                                            taxName.addEventListener("change", updateTaxFields);
                                            updateTaxFields(); // Run on page load to apply the correct state
                                        });
                                        </script>

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
    @include('toast.error_success_js')

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
