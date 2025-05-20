<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Payments</title>
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

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);" data-sidebar="dark">
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
    @include('loader.loader')
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
                                        {{-- <a class="btn btn-sm btn-info waves-effect waves-light"
                                        href="/windows/business_manager"><i class="dripicons-arrow-thin-left"></i></a> --}}

                                        <a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/mobile/create">Mobile Money Transfer</a>
                                        {{-- <a href="/mobile/create">
                                            <img style="width: 16%; border-radius: 7px;" src="/assets/mobile.webp">
                                        </a> --}}

                                    </h4>

                                    <div>
                                        <div>
                                            <div id="pagination-container"></div>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size: 12px" data-priority="1">Names</th>
                                                        <th style="font-size: 12px" data-priority="3">Date Paid</th>
                                                        <th style="font-size: 12px" data-priority="6">Amount</th>
                                                        <th style="font-size: 12px" data-priority="6">Payment Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body-mobile">
                                                    @if ($mobile->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5 style="font-size: 12px">No Mobile Transfer Done
                                                                    </h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($mobile as $item)
                                                            <tr>
                                                                <td>
                                                                    <b
                                                                        style="font-size: 12px">{{ $item->user->name }}</b><br>
                                                                    <span
                                                                        style="font-size: 9px; color: rgb(112, 112, 112);">
                                                                        Transaction ID: {{ $item->transaction_id }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b
                                                                        style="font-size: 12px">{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</b><br>
                                                                    <span
                                                                        style="font-size: 9px; color: {{ \Carbon\Carbon::parse($item->created_at)->addMonths(1)->isToday()? 'red': 'rgb(112, 112, 112)' }};">
                                                                        Due On:
                                                                        {{ \Carbon\Carbon::parse($item->created_at)->addMonths(1)->format('F j, Y') }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b
                                                                        style="font-size: 12px">{{ formatCurrency($item->price->amount) }}</b><br>
                                                                    <span
                                                                        style="font-size: 9px; color: rgb(112, 112, 112);">
                                                                        Package Type: {{ $item->price->name }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $dueDate = \Carbon\Carbon::parse(
                                                                            $item->created_at,
                                                                        )->addMonths(1);
                                                                    @endphp

                                                                    @if ($dueDate->isToday())
                                                                        <a class="btn btn-danger btn-sm waves-effect waves-light"
                                                                            href="/mobile/create">Payment is Due</a>
                                                                    @elseif ($dueDate->isFuture())
                                                                        <button
                                                                            class="btn btn-success btn-sm waves-effect waves-light"
                                                                            href="/mobile/create" disabled>Paid</button>
                                                                    @endif

                                                                    <a class="btn btn-sm waves-effect waves-light {{ $item->status == 'approved' ? 'btn-info' : 'btn-secondary disabled' }}"
                                                                        href="{{ $item->status == 'approved' ? route('mobile.exportToPDF', $item->slug) : '#' }}">
                                                                        <i class="dripicons-download"></i>
                                                                        {{ $item->status == 'approved' ? 'Download Receipt' : 'Unapproved Payment' }}
                                                                    </a>

                                                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                                                        href="{{ route('mobile.edit', $item->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>

                                            <div id="pagination-container-mobile"></div>

                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    const rowsPerPage = 5; // Rows per page

                                                    function setupPagination(tableId, paginationId) {
                                                        const tableBody = document.querySelector(`#${tableId}`);
                                                        const rows = Array.from(tableBody.querySelectorAll(
                                                        "tr:not(:first-child)")); // Exclude empty message row
                                                        const totalPages = Math.ceil(rows.length / rowsPerPage);
                                                        const paginationContainer = document.querySelector(`#${paginationId}`);

                                                        function renderTable(page) {
                                                            tableBody.innerHTML = ""; // Clear table
                                                            const start = (page - 1) * rowsPerPage;
                                                            const end = start + rowsPerPage;
                                                            rows.slice(start, end).forEach(row => tableBody.appendChild(row));
                                                        }

                                                        function renderPagination() {
                                                            paginationContainer.innerHTML = ""; // Clear pagination
                                                            for (let i = 1; i <= totalPages; i++) {
                                                                const button = document.createElement("button");
                                                                button.textContent = i;
                                                                button.classList.add("btn", "btn-sm", "btn-outline-primary", "mx-1");
                                                                button.addEventListener("click", () => renderTable(i));
                                                                paginationContainer.appendChild(button);
                                                            }
                                                        }

                                                        if (rows.length > 0) {
                                                            renderTable(1); // Render first page
                                                            renderPagination(); // Render pagination
                                                        }
                                                    }

                                                    // Apply pagination
                                                    setupPagination("table-body-mobile", "pagination-container-mobile");
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
