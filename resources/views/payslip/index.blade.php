<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Payslips</title>
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
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteMinistryModal" tabindex="-1"
                        aria-labelledby="deleteMinistryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteMinistryModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Payslip?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteMinistryForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/employee/index"><i class="dripicons-arrow-thin-left"></i></a>
                                            @php
                                            use Carbon\Carbon;

                                            $now = Carbon::now();
                                            $currentMonth = $now->format('F Y'); // E.g. "April 2025"
                                            $lastPayrollMonth = $payslip->last()?->created_at?->format('F Y'); // Assumes payslip has a created_at timestamp
                                        @endphp

                                        @if ($lastPayrollMonth !== $currentMonth)
                                            <a class="btn btn-sm btn-info waves-effect waves-light"
                                                href="/payslip/create">
                                                <b>Close Payroll for {{ $currentMonth }}</b>
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-success waves-effect waves-light disabled"
                                                href="javascript:void(0)"
                                                aria-disabled="true"
                                                style="pointer-events: none; opacity: 0.6;">
                                                <b>{{ $currentMonth }} Closed Already</b>
                                            </a>
                                        @endif

                                    </h4><br>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div data-pattern="priority-columns">
                                            <!-- Search input field -->
                                            <div class="mb-3">
                                                <input type="text" id="search-input" class="form-control"
                                                    placeholder="Search by Employee Name or Payment Date" />
                                            </div>

                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Employee Name</th>
                                                        <th data-priority="3">Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    @if ($payslip->isEmpty())
                                                        <tr>
                                                            <td colspan="3" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Payslips Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($payslip as $item)
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $item->salary->worker->name ?? 'None' }}</b>
                                                                    <br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        {{-- Monthly Net Payment: {{ formatCurrency($item->salary->daily_earnings * $item->salary->worker->attendance->count()) }} --}}
                                                                        {{-- @php
                                                                            $totalAdvance = $item->salary->worker
                                                                                ->advance
                                                                                ? $item->salary->worker->advance->sum(
                                                                                    'amount',
                                                                                )
                                                                                : 0;
                                                                            $netPay =
                                                                                $item->salary->net_pay - $totalAdvance;
                                                                        @endphp --}}

                                                                        @php
    $worker = $item->salary?->worker;
    $totalAdvance = $worker?->advance ? $worker->advance->sum('amount') : 0;
    $netPay = $item->salary?->net_pay - $totalAdvance;
@endphp


                                                                        Monthly Net Payment:
                                                                        {{ formatCurrency($netPay) }} <b>Advance Amount
                                                                            Cut:
                                                                            ({{ formatCurrency($totalAdvance) ?? 'No Advance Cut' }})</b>



                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <b>{{ $item->created_at->format('d M Y, H:i') }}</b>
                                                                    <br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        Prepared: {{ $item->prepared_by }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-info  waves-effect waves-light"
                                                                        href="{{ route('payslip.exportToPDF', $item->slug) }}">
                                                                        <i class="dripicons-download"></i>
                                                                    </a>
                                                                    {{-- <a class="btn btn-info  waves-effect waves-light"
                                                                        href="{{ route('payslip.show', $item->slug) }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </a>
                                                                    <a class="btn btn-info  waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('payslip.edit', $item->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a> --}}
                                                                    <button type="button"
                                                                        class="btn btn-danger  waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('payslip.destroy', $item->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pagination Controls -->
                                    <div id="pagination" class="text-left" style="margin-top: 20px;"></div>
                                    <!-- Include JSZip & FileSaver -->
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            document.getElementById("downloadAllPayslips").addEventListener("click", async function() {
                                                let downloadLinks = document.querySelectorAll(
                                                "td:nth-child(3) a.btn-info"); // Adjusted selector
                                                let dateStr = new Date().toISOString().split('T')[0]; // YYYY-MM-DD format

                                                if (downloadLinks.length === 0) {
                                                    alert("No payslips available for download.");
                                                    return;
                                                }

                                                let zip = new JSZip();
                                                let fetchPromises = [];

                                                downloadLinks.forEach((link) => {
                                                    let url = link.href;
                                                    let employeeName = link.closest("tr").querySelector("td b").textContent
                                                        .trim();
                                                    let filename = `${employeeName}_payslip.pdf`;

                                                    // Fetch each file properly as an ArrayBuffer
                                                    let promise = fetch(url)
                                                        .then(response => response
                                                    .arrayBuffer()) // Important: Use arrayBuffer() instead of blob()
                                                        .then(data => {
                                                            zip.file(filename, data, {
                                                                binary: true
                                                            }); // Store file as binary
                                                        })
                                                        .catch(error => console.error(`Error downloading ${filename}:`, error));

                                                    fetchPromises.push(promise);
                                                });

                                                // Wait for all downloads to complete
                                                Promise.all(fetchPromises).then(() => {
                                                    zip.generateAsync({
                                                        type: "blob"
                                                    }).then(function(zipFile) {
                                                        saveAs(zipFile, `${dateStr}_Payslips.zip`);
                                                    });
                                                });
                                            });
                                        });
                                    </script>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const rowsPerPage = 5; // Number of rows per page
                                            const searchInput = document.getElementById("search-input"); // Search input field
                                            const tableBody = document.getElementById("table-body");
                                            const pagination = document.getElementById("pagination");

                                            const rows = Array.from(tableBody.getElementsByTagName("tr"));
                                            let filteredRows = rows;
                                            const totalRows = filteredRows.length;
                                            const totalPages = Math.ceil(totalRows / rowsPerPage);

                                            // Function to render the table rows for the selected page
                                            function renderTable(page) {
                                                tableBody.innerHTML = ""; // Clear the table body
                                                const start = (page - 1) * rowsPerPage;
                                                const end = start + rowsPerPage;

                                                // Append the relevant rows for the page
                                                filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));
                                            }

                                            // Function to render pagination controls
                                            function renderPagination() {
                                                pagination.innerHTML = ""; // Clear the pagination container

                                                const totalFilteredPages = Math.ceil(filteredRows.length / rowsPerPage);

                                                for (let i = 1; i <= totalFilteredPages; i++) {
                                                    const button = document.createElement("button");
                                                    button.textContent = i;
                                                    button.className = "btn btn-sm btn-info mx-1";
                                                    button.addEventListener("click", () => {
                                                        renderTable(i); // Render the selected page
                                                        setActiveButton(i); // Set the active page button
                                                    });

                                                    if (i === 1) button.classList.add("active");
                                                    pagination.appendChild(button);
                                                }
                                            }

                                            // Function to set the active page button
                                            function setActiveButton(page) {
                                                Array.from(pagination.getElementsByTagName("button")).forEach(btn => {
                                                    btn.classList.remove("active");
                                                });
                                                pagination.getElementsByTagName("button")[page - 1].classList.add("active");
                                            }

                                            // Real-time search function
                                            function filterTable() {
                                                const query = searchInput.value.toLowerCase();
                                                filteredRows = rows.filter(row => {
                                                    const name = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
                                                    const paymentDate = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                                                    return name.includes(query) || paymentDate.includes(query);
                                                });

                                                // Re-render the table with filtered rows and update pagination
                                                renderTable(1);
                                                renderPagination();
                                            }

                                            // Event listener for the search input field
                                            searchInput.addEventListener("input", filterTable);

                                            // Initialize the table and pagination controls
                                            renderTable(1); // Render the first page
                                            renderPagination(); // Generate pagination buttons
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
