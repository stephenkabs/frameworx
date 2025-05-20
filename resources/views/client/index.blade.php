<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Clients</title>
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
                                    Are you sure you want to delete this Client?
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

                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                        href="/windows/business_manager"><i class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light" href="/client/create"><i class="dripicons-plus"></i></a>



                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <div class="table-responsive">
                                                <table id="tech-companies-1" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Client Name</th>
                                                            <th>Client Address</th>
                                                            <th>Client TPIN</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-body">
                                                        @if ($clients->isEmpty())
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    <div class="text-center" style="margin-top: 20px;">
                                                                        <h5>No Client Uploaded</h5>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            @foreach ($clients as $item)
                                                                <tr>
                                                                    <td>
                                                                        <b>{{ $item->client_name }}</b><br>
                                                                        <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                            {{ $item->email }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{ $item->client_address }}</b><br>
                                                                        <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                            {{ $item->phone }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <b>{{ $item->client_tpin }}</b><br>
                                                                        <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                            TPIN
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('client.edit', $item->slug) }}"
                                                                            class="btn btn-info waves-effect waves-light">
                                                                            <i class="dripicons-document-edit"></i>
                                                                        </a>
                                                                        <button type="button"
                                                                            class="btn btn-danger waves-effect waves-light"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteMinistryModal"
                                                                            data-route="{{ route('client.destroy', $item->slug) }}">
                                                                            <i class="dripicons-trash"></i> Delete
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Pagination Controls -->
                                            <div id="pagination-controls" class="d-flex justify-content-center mt-3">
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    const rowsPerPage = 5; // Number of rows per page
                                                    const tableBody = document.getElementById("table-body");
                                                    const paginationControls = document.getElementById("pagination-controls");
                                                    const rows = tableBody.querySelectorAll("tr");
                                                    const totalPages = Math.ceil(rows.length / rowsPerPage);

                                                    let currentPage = 1;

                                                    function renderTable() {
                                                        // Hide all rows
                                                        rows.forEach((row, index) => {
                                                            row.style.display = "none";
                                                        });

                                                        // Show only the rows for the current page
                                                        const start = (currentPage - 1) * rowsPerPage;
                                                        const end = start + rowsPerPage;
                                                        rows.forEach((row, index) => {
                                                            if (index >= start && index < end) {
                                                                row.style.display = "table-row";
                                                            }
                                                        });
                                                    }

                                                    function renderPagination() {
                                                        paginationControls.innerHTML = "";

                                                        // Previous Button
                                                        const prevButton = document.createElement("button");
                                                        prevButton.classList.add("btn", "btn-outline-secondary", "me-2");
                                                        prevButton.textContent = "Previous";
                                                        prevButton.disabled = currentPage === 1;
                                                        prevButton.addEventListener("click", () => {
                                                            if (currentPage > 1) {
                                                                currentPage--;
                                                                renderTable();
                                                                renderPagination();
                                                            }
                                                        });
                                                        paginationControls.appendChild(prevButton);

                                                        // Page Buttons
                                                        for (let i = 1; i <= totalPages; i++) {
                                                            const pageButton = document.createElement("button");
                                                            pageButton.classList.add("btn", "btn-outline-primary", "mx-1");
                                                            pageButton.textContent = i;
                                                            if (i === currentPage) {
                                                                pageButton.classList.add("active");
                                                            }
                                                            pageButton.addEventListener("click", () => {
                                                                currentPage = i;
                                                                renderTable();
                                                                renderPagination();
                                                            });
                                                            paginationControls.appendChild(pageButton);
                                                        }

                                                        // Next Button
                                                        const nextButton = document.createElement("button");
                                                        nextButton.classList.add("btn", "btn-outline-secondary", "ms-2");
                                                        nextButton.textContent = "Next";
                                                        nextButton.disabled = currentPage === totalPages;
                                                        nextButton.addEventListener("click", () => {
                                                            if (currentPage < totalPages) {
                                                                currentPage++;
                                                                renderTable();
                                                                renderPagination();
                                                            }
                                                        });
                                                        paginationControls.appendChild(nextButton);
                                                    }

                                                    // Initialize
                                                    renderTable();
                                                    renderPagination();
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

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const taskModal = document.getElementById('taskModal');
    taskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Fetch task details from data attributes
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const priority = button.getAttribute('data-priority');
        const startDate = button.getAttribute('data-start_date');
        const endDate = button.getAttribute('data-end_date');
        const status = button.getAttribute('data-status');
        const employee = button.getAttribute('data-employee');
        const category = button.getAttribute('data-category');

        // Populate modal fields
        taskModal.querySelector('#modalTaskTitle').textContent = title;
        taskModal.querySelector('#modalTaskDescription').textContent = description;
        taskModal.querySelector('#modalTaskPriority').textContent = priority;
        taskModal.querySelector('#modalTaskStartDate').textContent = startDate;
        taskModal.querySelector('#modalTaskEndDate').textContent = endDate;
        taskModal.querySelector('#modalTaskStatus').textContent = status;
        taskModal.querySelector('#modalTaskEmployee').textContent = employee;
        taskModal.querySelector('#modalTaskCategory').textContent = category;
    });
});


    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editTaskModal = document.getElementById('editTaskModal');
    editTaskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Fetch task details from data attributes
        const slug = button.getAttribute('data-slug');
        const title = button.getAttribute('data-title');
        const clientId = button.getAttribute('data-client_id');
        const priority = button.getAttribute('data-priority');
        const employeeId = button.getAttribute('data-employee_id');
        const categoryId = button.getAttribute('data-category_id');
        const status = button.getAttribute('data-status');
        const startDate = button.getAttribute('data-start_date');
        const endDate = button.getAttribute('data-end_date');
        const description = button.getAttribute('data-description');

        // Populate the form with task data
        document.getElementById('editTaskTitle').value = title;
        document.getElementById('editClient').value = clientId;
        document.getElementById('editPriority').value = priority;
        document.getElementById('editEmployee').value = employeeId;
        document.getElementById('editCategory').value = categoryId;
        document.getElementById('editStatus').value = status;
        document.getElementById('editStartDate').value = startDate;
        document.getElementById('editEndDate').value = endDate;
        document.getElementById('editDescription').value = description;

        // Set the form action dynamically to include the slug
        const form = document.getElementById('editTaskForm');
        form.action = `/tasks/${slug}`;
    });
});

</script>

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
</body>

</html>
