<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Assigning Documents</title>
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
                    Are you sure you want to delete this Assign?
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
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="documents">
                                            <i class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/assign/create"><i class="dripicons-plus"></i></a>
                                            {{-- <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="documents/assign">Task Assign</a> --}}
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Assigned Staff</th>
                                                        <th data-priority="1">Duration</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($assignments->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center">
                                                                <div class="text-center" style="margin-top: 15px;">
                                                                    <h5>No Invoices Assignments</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                    @foreach($assignments as $item)
                                                    @php
                                                    $newAssignTag = 'new-assign-' . $item->id;
                                                @endphp
                                                    <tr data-id="{{ $item->id }}">
                                                        <td>
                                                            <b>{{ $item->user->name ?? 'N/A' }}</b>
                                                            @if (!session()->has($newAssignTag))
                                                                <span class="badge bg-info text-dark new-assign">New Assign</span>
                                                            @endif
                                                            <br>
                                                            <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                Assigned Date: {{ $item->created_at->format('d M Y') }} ({{ $item->created_at->diffForHumans() }})
                                                            </span>
                                                        </td>


                                                                <td><b>
                                                                    {{ $item->created_at->diffInDays() }} {{ Str::plural('day', $item->created_at->diffInDays()) }} ago

                                                                    </b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Supplier Name
                                                                        : {{ $item->document->supplier_name }}</span>
                                                                </td>



                                                                <td>
                                                                    <a href="{{ route('assign.edit', $item->id) }}" class="btn btn-info waves-effect waves-light edit-btn" data-id="{{ $item->id }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('assign.destroy', $item->id) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>

                                            {{-- <tbody>
                                                @if ($assignments->isEmpty())
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            <div class="text-center" style="margin-top: 15px;">
                                                                <h5>No Invoices Assignments</h5>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach($assignments as $item)
                                                        @php
                                                            $newAssignTag = 'new-assign-' . $item->id;
                                                        @endphp
                                                        <tr data-id="{{ $item->id }}">
                                                            <td>
                                                                <b>{{ $item->user->name ?? 'N/A' }}</b>
                                                                @if (!session()->has($newAssignTag))
                                                                    <span class="badge bg-warning text-dark new-assign">New Assign</span>
                                                                @endif
                                                                <br>
                                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                    Assigned Date: {{ $item->created_at->format('d M Y') }} ({{ $item->created_at->diffForHumans() }})
                                                                </span>
                                                            </td>

                                                            <td>
                                                                <b>{{ $item->created_at->diffInDays() }} {{ Str::plural('day', $item->created_at->diffInDays()) }} ago</b>
                                                                <br>
                                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                    Supplier Name: {{ $item->document->supplier_name }}
                                                                </span>
                                                            </td>

                                                            <td>
                                                                <a href="{{ route('assign.edit', $item->id) }}" class="btn btn-info waves-effect waves-light edit-btn" data-id="{{ $item->id }}">
                                                                    <i class="dripicons-document-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger waves-effect waves-light delete-btn" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteMinistryModal" data-route="{{ route('assign.destroy', $item->id) }}">
                                                                    <i class="dripicons-trash"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody> --}}
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    let viewedAssignments = JSON.parse(localStorage.getItem("viewedAssignments")) || [];

                                                    // Hide "New Assign" tag for viewed assignments
                                                    document.querySelectorAll("tr[data-id]").forEach(row => {
                                                        let assignmentId = row.getAttribute("data-id");
                                                        if (viewedAssignments.includes(assignmentId)) {
                                                            let newTag = row.querySelector(".new-assign");
                                                            if (newTag) newTag.style.display = "none";
                                                        }
                                                    });

                                                    // Mark assignment as viewed when clicking edit/show
                                                    document.querySelectorAll(".edit-btn, .show-btn").forEach(button => {
                                                        button.addEventListener("click", function () {
                                                            let assignmentId = this.getAttribute("data-id");
                                                            if (!viewedAssignments.includes(assignmentId)) {
                                                                viewedAssignments.push(assignmentId);
                                                                localStorage.setItem("viewedAssignments", JSON.stringify(viewedAssignments));
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

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

    @include('toast.error_success_js')


</body>

</html>
