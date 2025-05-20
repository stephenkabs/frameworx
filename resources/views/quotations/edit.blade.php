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

<body data-sidebar="dark">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Modal -->
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

                                    <form class="row needs-validation"
                                        action="{{ route('quotations.update', $quotation->slug) }}" novalidate
                                        method="POST" enctype="multipart/form-data" id="event-form">
                                        @csrf
                                        @method('PUT') <!-- Use PUT for updating -->
                                        <div class="mb-3">
                                            <label class="form-label">Our Addresses on Quotation</label>
                                            <select name="detail_id" class="form-select" required>
                                                <option value="" disabled>Select an Address</option>
                                                @foreach ($detail as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('detail_id', $currentDetailId ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->address }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <input type="hidden" name="status" value="{{ $quotation->status }}">
                                        <input type="hidden" name="delivery_status"
                                            value="{{ $quotation->delivery_status }}">

                                        <div class="mb-3">
                                            <label class="form-label">Account Number</label>
                                            <select name="account_id" class="form-select">
                                                <option value="" disabled>Select an Address</option>
                                                @foreach ($account as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('account_id', $currentAccountId ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->account_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Quotation Type</label>
                                            <select name="type" id="type" class="form-select">
                                                <option value="" disabled>Select Quotation Type</option>
                                                <option value="Qty"
                                                    {{ $quotation->type == 'Qty' ? 'selected' : '' }}>Product</option>
                                                <option value="Hourly"
                                                    {{ $quotation->type == 'Hourly' ? 'selected' : '' }}>Service
                                                </option>
                                                <option value="Daily"
                                                    {{ $quotation->type == 'Daily' ? 'selected' : '' }}>Daily Service
                                                </option>
                                                <option value="Monthly"
                                                    {{ $quotation->type == 'Monthly' ? 'selected' : '' }}>Monthly
                                                    Service</option>
                                                <option value="other"
                                                    {{ $quotation->type == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>



                                        <!-- Client Details -->
                                        <div class="mb-3">
                                            <label class="form-label">Clients</label>
                                            <select name="client_id" class="form-select" required>
                                                <option value="" disabled>Select a Client</option>
                                                @foreach ($client as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('client_id', $currentClientId ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->client_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="quotation-note">Quotation Note</label>
                                            <textarea name="quotation_note" id="quotation-note" class="form-control" rows="4"
                                                placeholder="Enter Quotation Note" required>{{ $quotation->quotation_note }}</textarea>
                                        </div>

                                        <!-- Product Table -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Products</h5>
                                                <div id="ticket-container">
                                                    @foreach ($quotation->items as $index => $item)
                                                        <div class="row mb-2 ticket-row">
                                                            <div class="col-md-4">
                                                                <input type="text"
                                                                    name="products[{{ $index }}][product_name]"
                                                                    class="form-control" placeholder="Product Name"
                                                                    value="{{ $item->product_name }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number"
                                                                    name="products[{{ $index }}][quantity]"
                                                                    class="form-control quantity"
                                                                    placeholder="Quantity"
                                                                    value="{{ $item->quantity }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="number"
                                                                    name="products[{{ $index }}][price]"
                                                                    class="form-control price" placeholder="Price"
                                                                    value="{{ $item->price }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text"
                                                                    name="products[{{ $index }}][total]"
                                                                    class="form-control total" placeholder="Total"
                                                                    value="{{ $item->total }}" readonly>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button"
                                                                    class="btn btn-danger remove-row">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" id="add-ticket"
                                                    class="btn btn-primary btn-sm mt-2">Add Product</button>
                                                <!-- Tax and Grand Total Section -->
                                                <div class="mt-4">
                                                    <div class="mb-3">
                                                        <label for="tax_name" class="form-label">Tax Type</label>
                                                        <select class="form-control" name="tax_name" required>
                                                            <option value="VAT"
                                                                {{ $quotation->tax_name === 'VAT' ? 'selected' : '' }}>
                                                                VAT</option>
                                                            <option value="TOT"
                                                                {{ $quotation->tax_name === 'TOT' ? 'selected' : '' }}>
                                                                TOT</option>
                                                            <option value="PAYE"
                                                                {{ $quotation->tax_name === 'PAYE' ? 'selected' : '' }}>
                                                                PAYE</option>
                                                            <option value="WT"
                                                                {{ $quotation->tax_name === 'WT' ? 'selected' : '' }}>
                                                                Withholding Tax</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="tax-percentage" class="form-label">Tax Percentage
                                                            (%)</label>
                                                        <input type="number" name="tax_percentage"
                                                            id="tax-percentage" class="form-control"
                                                            value="{{ old('tax_percentage', $quotation->tax_percentage) }}"
                                                            placeholder="Enter Tax Percentage" min="0"
                                                            step="0.01">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="tax-amount" class="form-label">Tax Amount</label>
                                                        <input type="text" name="tax_amount" id="tax-amount"
                                                            class="form-control"
                                                            value="{{ old('tax_amount', $quotation->tax_amount) }}"
                                                            placeholder="Tax Amount" readonly>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="grand-total" class="form-label">Grand
                                                            Total</label>
                                                        <input type="text" name="grand_total" id="grand-total"
                                                            class="form-control"
                                                            value="{{ old('grand_total', $quotation->grand_total) }}"
                                                            placeholder="Grand Total" readonly>
                                                    </div>
                                                </div>


                                                <!-- Submit and Reset Buttons -->
                                                <div class="mt-4">
                                                    <button type="submit"
                                                        class="btn btn-info waves-effect waves-light">Update</button>
                                                    <a href="{{ route('quotations.index') }}"
                                                        class="btn btn-secondary waves-effect ms-1">Cancel</a>
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
            taxPercentage.closest('.mb-2').style.display = "none";
            taxAmount.closest('.mb-2').style.display = "none";
        } else {
            taxPercentage.closest('.mb-2').style.display = "block";
            taxAmount.closest('.mb-2').style.display = "block";
        }
    }

    taxName.addEventListener("change", updateTaxFields);
    updateTaxFields(); // Run on page load
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
            document.getElementById('add-ticket').addEventListener('click', function() {
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
            document.addEventListener('input', function(e) {
                const target = e.target;
                if (target.classList.contains('quantity') || target.classList.contains('price') || target.id ===
                    'tax-percentage') {
                    calculateTotals();
                }
            });

            // Event listener to remove rows
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.ticket-row').remove();
                    calculateTotals();
                }
            });
        </script>




</body>

</html>
