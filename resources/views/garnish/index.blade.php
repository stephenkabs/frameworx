<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="ZRA DRU SYSTEM" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Responsive Table css -->
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

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

    <!-- Invoice Details Modal -->
    <div class="modal fade" id="invoiceDetailsModal" tabindex="-1" aria-labelledby="invoiceDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceDetailsModalLabel">Invoice Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Supplier Name:</strong> <span id="supplierName"></span></p>
                <p><strong>TPIN:</strong> <span id="tpin"></span></p>
                <p><strong>Invoice Amount:</strong> <span id="invoiceAmount"></span></p>
                <p><strong>Amount Net of VAT:</strong> <span id="amountNV"></span></p>
                <p><strong>VAT Withheld:</strong> <span id="vatWithheld"></span></p>
                <p><strong>Comment:</strong> <span id="comment"></span></p>
                <p><strong>Signature:</strong> <br> <img id="signatureImage" src="" alt="Signature" style="max-width: 100%; height: auto; display: none;"></p>
            </div>
        </div>
    </div>
</div>


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteMinistryModal" tabindex="-1" aria-labelledby="deleteMinistryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Garnished Invoice?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteMinistryForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('toast.success_toast')
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">



                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="#">
                                            <i class="dripicons-arrow-thin-left"></i></a>

                                        <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="documents">Invoices</a>
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Supplier Name</th>
                                                        <th data-priority="1">Invoice Amount</th>
                                                        <th data-priority="1">Amount Garnished</th>
                                                        {{-- <th data-priority="1">Garnished Amount</th> --}}
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($garnish->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                <div class="text-center" style="margin-top: 15px;">
                                                                    <h5>No Invoices Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($garnish as $item)
                                                            <tr>
                                                                <td><b>{{ $item->document->supplier_name }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">TPIN
                                                                        : {{ $item->document->tpin }}</span>
                                                                </td>


                                                                <td><b>
                                                                        {{ $item->document->invoice_amount }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Amount
                                                                        Net of VAT
                                                                        :
                                                                        {{ $item->document->amount_nv }}</span>
                                                                </td>





                                                                <td><b>

                                                                        {{ $item->amount }}

                                                                    </b>
                                                                    <br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Tax Amount Garnished



                                                                    </span>
                                                                </td>

                                                                <td><b>Prepared By: {{ $item->user->name }}
                                                                    </b><br>
                                                                <span
                                                                    style="font-size: 11px; color:rgb(112, 112, 112);">Email

                                                                    : {{ $item->user->email }}</span>
                                                            </td>

                                                                <td>
                                                                    <button type="button"
                                                                    class="btn btn-info show-invoice"
                                                                    data-supplier="{{ $item->document->supplier_name }}"
                                                                    data-tpin="{{ $item->document->tpin }}"
                                                                    data-invoice="{{ $item->document->invoice_amount}}"
                                                                    data-amount-nv="{{ $item->document->amount_nv}}"
                                                                    data-vat="{{ $item->document->vat_withheld }}%"
                                                                    data-comment="{{ $item->comment }}"
                                                                    data-signature="{{ $item->signature }}">
                                                                    Show
                                                                </button>




                                                                    <a href="{{ route('garnish.edit', $item->slug) }}"
                                                                        class="btn btn-info waves-effect waves-light">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('garnish.destroy', $item->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <style>
                                                .pagination-container button.active {
                                                    background-color: #043d76;
                                                    color: white;
                                                }

                                                .pagination-container {
                                                    display: flex;
                                                    justify-content: left;
                                                }
                                            </style>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const rowsPerPage = 5; // Number of rows per page
                                                    const table = document.querySelector("#tech-companies-1 tbody");
                                                    const rows = Array.from(table.querySelectorAll("tr"));
                                                    const totalRows = rows.length;
                                                    const totalPages = Math.ceil(totalRows / rowsPerPage);
                                                    const paginationContainer = document.createElement("div");

                                                    paginationContainer.className = "pagination-container mt-3";
                                                    table.parentElement.appendChild(paginationContainer);

                                                    function showPage(page) {
                                                        // Hide all rows
                                                        rows.forEach((row, index) => {
                                                            row.style.display = "none";
                                                            const start = (page - 1) * rowsPerPage;
                                                            const end = start + rowsPerPage;
                                                            if (index >= start && index < end) {
                                                                row.style.display = "table-row";
                                                            }
                                                        });

                                                        // Highlight the active page number
                                                        Array.from(paginationContainer.children).forEach((button, index) => {
                                                            button.classList.toggle("active", index + 1 === page);
                                                        });
                                                    }

                                                    function setupPagination() {
                                                        for (let i = 1; i <= totalPages; i++) {
                                                            const button = document.createElement("button");
                                                            button.textContent = i;
                                                            button.className = "btn btn-outline-primary btn-sm mx-1";
                                                            button.addEventListener("click", () => showPage(i));
                                                            paginationContainer.appendChild(button);
                                                        }
                                                    }

                                                    setupPagination();
                                                    if (totalPages > 0) showPage(1); // Show the first page initially
                                                });
                                            </script>

                                        </div>
                                    </div>

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



    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- Responsive Table js -->
    <script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

    <!-- Init js -->
    <script src="/assets/js/pages/table-responsive.init.js"></script>

    <script src="/assets/js/app.js"></script>

    @if (Session::has('message'))
        <script>
            swal("Hi!, {{ $profileData->first_name }}", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Close",
            });
        </script>
    @endif

    <script>
        // Event listener for delete button click
        $('#deleteMinistryModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var route = button.data('route'); // Extract route from data-* attribute
            var modal = $(this);

            // Update the form action with the correct route
            modal.find('#deleteMinistryForm').attr('action', route);
        });
    </script>

<script>
    $(document).ready(function () {
        $(".show-invoice").click(function () {
            // Get data from button attributes
            var supplierName = $(this).data("supplier");
            var tpin = $(this).data("tpin");
            var invoiceAmount = $(this).data("invoice");
            var amountNV = $(this).data("amount-nv");
            var vatWithheld = $(this).data("vat");
            var comment = $(this).data("comment");
            var signature = $(this).data("signature");

            // Populate modal fields
            $("#supplierName").text(supplierName);
            $("#tpin").text(tpin);
            $("#invoiceAmount").text(invoiceAmount);
            $("#amountNV").text(amountNV);
            $("#vatWithheld").text(vatWithheld);
            $("#comment").text(comment);

            // Handle Signature Display
            if (signature) {
                $("#signatureImage").attr("src", "/storage/" + signature).show();
            } else {
                $("#signatureImage").hide();
            }

            // Show the modal
            $("#invoiceDetailsModal").modal("show");
        });
    });
</script>




    @include('toast.error_success_js')


</body>

</html>
