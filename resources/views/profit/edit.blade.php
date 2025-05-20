<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sales</title>
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
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/profit"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                    <form class="row needs-validation"
                                        action="{{ route('profit.update', $profit->slug) }}" novalidate method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label class="form-label">Select From Quotations</label>
                                            <select name="quotation_id_display" id="quotationSelect" class="form-select" disabled>
                                                <option value="" disabled>Select a Client</option>
                                                @foreach ($quotation as $item)
                                                    <option value="{{ $item->id }}" data-grand-total="{{ $item->grand_total }}"
                                                        {{ $item->id == $profit->quotation_id ? 'selected' : '' }}>
                                                        {{ $item->client->client_name }} - {{ formatCurrency($item->grand_total) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!-- Hidden input to submit the selected value -->
                                            <input type="hidden" name="quotation_id" value="{{ $profit->quotation_id }}">
                                        </div>


                                        <div class="mb-3 position-relative">
                                            {{-- <label class="form-label" for="amount-spent">Amount Spent</label> --}}
                                            <input type="hidden" name="amount_spent" id="amount-spent"
                                                class="form-control" placeholder="Enter Amount"
                                                value="{{ $profit->amount_spent }}" required>
                                        </div>
                                        @if(false) {{-- Set condition to true or false based on your requirement --}}
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Payment Note</label>
                                            <div>
                                                <textarea name="note" class="form-control" rows="5" >{{ $profit->note }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                        {{--
                                    <div class="mb-3 position-relative">
                                        <button type="button" id="addBalanceButton" class="btn btn-sm btn-info waves-effect waves-light">
                                            Add Amount Paid
                                        </button>
                                    </div> --}}

                                        <!-- Balance Amount Field -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Balance Amount <strong>({{ formatCurrency($profit->quotation->grand_total - $profit->amount_paid )}})</strong></label>
                                            <input id="balanceAmount" type="text" class="form-control"
                                                placeholder="Balance Amount" readonly />
                                        </div>


                                        <!-- Dynamic inputs for balance and date -->
                                        <div id="balanceDateFields"
                                            style="display: {{ $profit->amount_paid ? 'block' : 'none' }};">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Total Paid Amount</label>
                                                <input name="amount_paid" id="balanceInput" type="number"
                                                    class="form-control" value="{{ $profit->amount_paid }}" readonly />
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Enter New Payment</label>
                                                <input id="additionalAmountInput" type="number" class="form-control"
                                                    placeholder="Enter New Payment" />
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <button type="button" id="updateAmountButton"
                                                    class="btn btn-sm btn-info waves-effect waves-light">
                                                    Add Payment
                                                </button>
                                            </div>



                                            {{-- <div class="mb-3 position-relative">
                                            <label class="form-label">Balance Amount To Pay</label>
                                            <div>
                                                <input  id="calculatedBalance" type="text" class="form-control" placeholder="Calculated Balance" readonly />
                                            </div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Actual Remaining Balance</label>
                                            <div>
                                                <input id="actualBalance" type="text" class="form-control" placeholder="Actual Remaining Balance" readonly />
                                            </div>
                                        </div> --}}

                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Select Date of Payment</label>
                                                <div>
                                                    <input name="date" id="dateInput" type="date"
                                                        class="form-control" value="{{ $profit->date }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light">Update</button>
                                                <a href="{{ route('profit.index') }}"
                                                    class="btn btn-secondary waves-effect ms-1">Cancel</a>
                                            </div>
                                        </div>
                                    </form>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const balanceInput = document.getElementById("balanceInput"); // Total amount paid (readonly)
                                            const additionalAmountInput = document.getElementById("additionalAmountInput"); // New payment input
                                            const balanceAmount = document.getElementById("balanceAmount"); // Balance field
                                            const updateAmountButton = document.getElementById("updateAmountButton"); // Update button
                                            const quotationSelect = document.getElementById("quotationSelect"); // Quotation select dropdown

                                            // Function to calculate and display the balance
                                            const updateBalance = () => {
                                                const selectedOption = quotationSelect.options[quotationSelect.selectedIndex];
                                                const grandTotal = parseFloat(selectedOption.getAttribute("data-grand-total")) ||
                                                0; // Get grand total from the selected quotation
                                                const currentAmountPaid = parseFloat(balanceInput.value) || 0; // Get current amount_paid
                                                const additionalAmount = parseFloat(additionalAmountInput.value) || 0; // Get new payment value

                                                const totalPaid = currentAmountPaid + additionalAmount; // Calculate total paid
                                                const balance = grandTotal - totalPaid; // Calculate balance
                                                balanceAmount.value = balance.toFixed(2); // Update the balance field
                                            };

                                            // Function to update the value of amount_paid
                                            const updateAmountPaid = () => {
                                                const additionalAmount = parseFloat(additionalAmountInput.value) || 0; // Get new payment value
                                                if (additionalAmount > 0) {
                                                    const currentAmountPaid = parseFloat(balanceInput.value) || 0; // Get current amount_paid
                                                    const updatedAmountPaid = currentAmountPaid +
                                                    additionalAmount; // Add new payment to total paid
                                                    balanceInput.value = updatedAmountPaid.toFixed(
                                                    2); // Update the readonly field with the new total
                                                    additionalAmountInput.value = ''; // Clear the additional payment input field
                                                    updateBalance(); // Update the balance
                                                } else {
                                                    alert('Please enter a valid amount.');
                                                }
                                            };

                                            // Event listeners
                                            updateAmountButton.addEventListener("click", updateAmountPaid);
                                            additionalAmountInput.addEventListener("input", updateBalance);
                                            quotationSelect.addEventListener("change", updateBalance);
                                        });
                                    </script>









                                </div>
                            </div>
                        </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addDutyBtn = document.getElementById('add-duty-btn');
            const dutiesContainer = document.getElementById('duties-container');

            // Add event listener to the 'Add Duty' button
            addDutyBtn.addEventListener('click', function() {
                // Create a new input element for the duty
                const newDutyInput = document.createElement('input');
                newDutyInput.type = 'text';
                newDutyInput.name = 'duties[]'; // Make sure the name is an array to handle multiple inputs
                newDutyInput.classList.add('form-control', 'mb-2');
                newDutyInput.placeholder = 'Enter Duty Name';
                newDutyInput.required = true;

                // Append the new duty input to the container
                dutiesContainer.appendChild(newDutyInput);
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addBalanceButton = document.getElementById("addBalanceButton");
            const balanceDateFields = document.getElementById("balanceDateFields");

            addBalanceButton.addEventListener("click", function() {
                if (balanceDateFields.style.display === "none") {
                    balanceDateFields.style.display = "block";
                } else {
                    balanceDateFields.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>
