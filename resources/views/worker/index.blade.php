<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Employees</title>
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
                    Are you sure you want to delete this Employee?
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
    <!-- Loader -->

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

                        <!-- Copy and Paste this section for more items -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/worker/create" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="dripicons-plus" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Add Employee</h6>
                                        <p style="font-size: 10px" class="mb-0 text-muted">This is the Settings section for user</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Repeatable Icon Section -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/departments" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px; cursor: pointer;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-funnel" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Departments</h6>
                                        <p style="font-size: 10px"  class="mb-0 text-muted">Navigate Desktop Wallpaper Settings</p>
                                    </div>
                                </div>
                            </a>
                        </div>




                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/branches" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-business" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Branches</h6>
                                        <p style="font-size: 10px"  class="mb-0 text-muted">This is Profile Settings for user</p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <!-- Add more items as needed -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/employee/employee_profiles" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-ios-person-add" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Employees</h6>
                                        <p style="font-size: 10px"  class="mb-0 text-muted">This is User Security Tokens</p>
                                    </div>
                                </div>
                            </a>
                        </div> --}}

                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/payslip" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-bookmarks" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Generate Payslips</h6>
                                        <p style="font-size: 10px"  class="mb-0 text-muted">This is Profile Settings for user</p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <!-- Add more items as needed -->
                        {{-- <div class="col-lg-4 col-md-6 mb-4">
                            <a href="/contracts" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <i class="ion ion-md-paper" style="font-size: 24px; color: #555;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Employee Contracts</h6>
                                        <p style="font-size: 10px"  class="mb-0 text-muted">This is Profile Settings for user</p>
                                    </div>
                                </div>
                            </a>
                        </div> --}}







                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    {{-- <h4 class="card-title"><a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/dashboard"><i class="dripicons-arrow-thin-left"></i></a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/employee/create"><i class="dripicons-plus"></i></a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/payslip">Generate Payslips</a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/contracts">Employee Contracts</a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/departments">Departments</a>
                                            <a class="btn btn-info btn-sm waves-effect waves-light" href="/branches">Branches</a>

                                        </h4> --}}
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}

                                    <!-- Bulk Delete Button -->

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select-all" /></th>
                                                        <th data-priority="1">Employee Name</th>
                                                        <th data-priority="3">Contact Info</th>
                                                        <th data-priority="6">Attachment</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="employee-table">
                                                    @if ($worker->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Employees Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($worker as $item)
                                                            <tr class="employee-row">
                                                                <td><input type="checkbox" class="employee-checkbox"
                                                                        data-id="{{ $item->slug }}" /></td>
                                                                <td><b>{{ $item->name }}</b><br><span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Email:
                                                                        {{ $item->email }}</span></td>
                                                                <td><b>{{ $item->address }}</b><br><span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Contact:
                                                                        {{ $item->phone }}</span></td>
                                                                <td>
                                                                    @if ($item->file)
                                                                        <b>
                                                                            <a href="{{ asset('documents/' . $item->file) }}"
                                                                                target="_blank" download>
                                                                                Download
                                                                            </a>
                                                                        </b>
                                                                        <br>
                                                                        <span
                                                                            style="font-size: 11px; color:rgb(112, 112, 112);">Attachment</span>
                                                                    @else
                                                                        <span>No file uploaded</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        href="{{ route('worker.show', $item->slug) }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </a>
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        href="{{ route('worker.edit', $item->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('worker.destroy', $item->slug) }}">
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

                                    {{-- <div class="d-flex justify-content-start mt-3">
                                        <button id="bulk-delete" class="btn btn-sm btn-danger">Delete Selected</button>
                                    </div><br> --}}

                                    <!-- Pagination controls -->
                                    <div id="pagination-controls" class="d-flex justify-content-center mt-4">
                                        <!-- Previous button with icons and styling -->
                                        <button id="prev-page" class="btn btn-outline-primary me-2" disabled>
                                            <i class="fas fa-chevron-left"></i> <span  style="font-size: 13px;">Previous</span>
                                        </button>

                                        <!-- Page number -->
                                        <span id="page-number" class="mx-3 align-self-center"
                                            style="font-size: 13px; font-weight: 600;">Page 1</span>

                                        <!-- Next button with icons and styling -->
                                        <button id="next-page" class="btn btn-outline-primary ms-2">
                                            <span  style="font-size: 13px;"> Next </span> <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>

                                    <script>
                                        // Initialize page and rows per page
                                        const rowsPerPage = 5;
                                        let currentPage = 1;

                                        // Get all the table rows and checkboxes
                                        const tableRows = document.querySelectorAll('#employee-table .employee-row');
                                        const checkboxes = document.querySelectorAll('.employee-checkbox');
                                        const bulkDeleteBtn = document.getElementById('bulk-delete');
                                        const selectAllCheckbox = document.getElementById('select-all');

                                        // Function to calculate total pages
                                        const totalPages = Math.ceil(tableRows.length / rowsPerPage);

                                        // Function to display rows based on the current page
                                        function displayRows() {
                                            // Hide all rows first
                                            tableRows.forEach(row => row.style.display = 'none');

                                            // Calculate start and end index for the current page
                                            const startIndex = (currentPage - 1) * rowsPerPage;
                                            const endIndex = startIndex + rowsPerPage;

                                            // Display the rows for the current page
                                            for (let i = startIndex; i < endIndex && i < tableRows.length; i++) {
                                                tableRows[i].style.display = '';
                                            }

                                            // Update the page number text
                                            document.getElementById('page-number').textContent = `Page ${currentPage}`;

                                            // Enable/Disable next/previous buttons
                                            document.getElementById('prev-page').disabled = currentPage === 1;
                                            document.getElementById('next-page').disabled = currentPage === totalPages;
                                        }

                                        // Function to handle bulk selection
                                        function handleBulkSelection() {
                                            // Check/uncheck all checkboxes
                                            const isChecked = selectAllCheckbox.checked;
                                            checkboxes.forEach(checkbox => {
                                                checkbox.checked = isChecked;
                                            });
                                        }

                                        // Function to get selected rows
                                        function getSelectedRows() {
                                            const selectedRows = [];
                                            checkboxes.forEach(checkbox => {
                                                if (checkbox.checked) {
                                                    selectedRows.push(checkbox.getAttribute('data-id'));
                                                }
                                            });
                                            return selectedRows;
                                        }

                                        // Event listener for "Select All" checkbox
                                        selectAllCheckbox.addEventListener('change', handleBulkSelection);

                                        // Event listener for bulk delete button
                                        bulkDeleteBtn.addEventListener('click', () => {
                                            const selectedRows = getSelectedRows();

                                            if (selectedRows.length === 0) {
                                                alert('Please select at least one employee to delete.');
                                                return;
                                            }

                                            // Perform bulk deletion via AJAX
                                            fetch('/delete-bulk-employees', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                            'content')
                                                    },
                                                    body: JSON.stringify({
                                                        ids: selectedRows
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        alert('Employees deleted successfully!');
                                                        // Refresh the page or remove the rows
                                                        selectedRows.forEach(id => {
                                                            const row = document.querySelector(`.employee-checkbox[data-id="${id}"]`)
                                                                .closest('tr');
                                                            row.remove();
                                                        });
                                                    } else {
                                                        alert('An error occurred while deleting the employees.');
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    alert('An error occurred while deleting the employees.');
                                                });
                                        });

                                        // Event listener for previous button
                                        document.getElementById('prev-page').addEventListener('click', () => {
                                            if (currentPage > 1) {
                                                currentPage--;
                                                displayRows();
                                            }
                                        });

                                        // Event listener for next button
                                        document.getElementById('next-page').addEventListener('click', () => {
                                            if (currentPage < totalPages) {
                                                currentPage++;
                                                displayRows();
                                            }
                                        });

                                        // Initialize the table display
                                        displayRows();
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
