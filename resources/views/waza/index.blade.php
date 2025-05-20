<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Expenses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
                    Are you sure you want to delete this Expense?
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


                                    <h4 class="card-title d-flex align-items-center gap-2 flex-wrap">
                                        <!-- Back button -->
                                        <a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/windows/business_manager">
                                            <i class="dripicons-arrow-thin-left"></i>
                                        </a>

                                        <!-- Add new button -->
                                        <a class="btn btn-sm btn-info waves-effect waves-light" href="/expenses/create">
                                            <i class="dripicons-plus"></i>
                                        </a>

                                        <!-- Import form -->
                                        <form action="{{ route('waza.import') }}" method="POST"
                                            enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                                            @csrf
                                            <div class="input-group input-group-sm">
                                                <input type="file" name="excel_file" class="form-control" required>
                                                <button class="btn btn-success" type="submit">Upload Excel
                                                    Sheet</button>
                                            </div>
                                        </form>

                                        <!-- Add new button -->
                                        <a class="btn btn-sm btn-success waves-effect waves-light" href="/expenses/create">
                                            Download Excel Template
                                        </a>
                                    </h4><br><br>

                                    <div class="table-rep-plugin">
                                        <div  data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>

                                                        <th data-priority="1">Name</th>
                                                        <th data-priority="3">Pay Month</th>
                                                        <th data-priority="6">Days Worked</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="waza-table-body">
                                                    @if ($wazas->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Expenses Uploaded</h5>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($wazas as $item)
                                                            <tr>
                                                                <td><b>{{ $item->name }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Position: {{ $item->position }}</span>
                                                                </td>
                                                                <td>

                                                                    <b>{{ formatCurrency($item->net_pay) }}</b>
                                                                    <br>
                                                                    <span
                                                                        style="font-size: 11px;
                                                                    color: {{ \Carbon\Carbon::parse($item->term_date)->isToday() ? 'red' : 'rgb(112, 112, 112)' }};">
                                                                        Date:
                                                                        {{ \Carbon\Carbon::parse($item->term_date)->format('F j, Y') }}
                                                                    </span>
                                                                <td><b>{{ $item->worked_days }} Days</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Leave Days Taken: {{ $item->leave_days_taken }}
                                                                        Days</span>
                                                                </td>
                                                                <td>
                                                                    {{-- <form action="{{ route('expenses.destroy', $item->id) }}" method="POST"> --}}
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        href="{{ route('expenses.show', $item->id) }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </a>
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('expenses.edit', $item->id) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('expenses.destroy', $item->id) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div id="pagination-controls" class="mt-3 d-flex justify-content-center"></div>

                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    const rowsPerPage = 5;
                                                    const table = document.getElementById("tech-companies-1");
                                                    const tbody = document.getElementById("waza-table-body");
                                                    const rows = Array.from(tbody.querySelectorAll("tr"));
                                                    const pagination = document.getElementById("pagination-controls");

                                                    if (rows.length <= rowsPerPage) return; // No need for pagination

                                                    let currentPage = 1;
                                                    const totalPages = Math.ceil(rows.length / rowsPerPage);

                                                    function displayPage(page) {
                                                        const start = (page - 1) * rowsPerPage;
                                                        const end = start + rowsPerPage;

                                                        rows.forEach((row, index) => {
                                                            row.style.display = index >= start && index < end ? "" : "none";
                                                        });

                                                        updatePaginationControls(page);
                                                    }

                                                    function updatePaginationControls(page) {
                                                        pagination.innerHTML = "";

                                                        for (let i = 1; i <= totalPages; i++) {
                                                            const btn = document.createElement("button");
                                                            btn.className = `btn btn-sm mx-1 ${i === page ? 'btn-primary' : 'btn-outline-primary'}`;
                                                            btn.textContent = i;
                                                            btn.addEventListener("click", () => displayPage(i));
                                                            pagination.appendChild(btn);
                                                        }
                                                    }

                                                    displayPage(currentPage);
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



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

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
    @include('toast.error_success_js')

</body>

</html>
