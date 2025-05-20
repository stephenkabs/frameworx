<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Categories</title>
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
                    Are you sure you want to delete this Category?
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">
                                        <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/windows/user_settings"><i class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-info btn-sm waves-effect waves-light"
                                            href="/categories/create"><i class="dripicons-plus"></i>
                                        </a>
                                    </h4>

                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Parent Category Type</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="category-table-body">
                                                    @if ($categories->isEmpty())
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Categories Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($categories as $category)
                                                            <tr class="category-row">
                                                                <td>
                                                                    {{ $category->name }}<br>
                                                                    @if ($category->type === 'Task')
                                                                        <span
                                                                            class="badge rounded-pill bg-primary">{{ $category->name }}</span>
                                                                    @elseif ($category->type === 'News')
                                                                        <span
                                                                            class="badge rounded-pill bg-primary">{{ $category->name }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('categories.edit', $category->slug) }}"
                                                                        class="btn btn-info waves-effect waves-light">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('categories.destroy', $category->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>

                                            <!-- Pagination Controls -->
                                            <div id="pagination-controls" class="text-center">
                                                <ul class="pagination">
                                                    <li><a href="javascript:void(0);" class="prev"
                                                            onclick="changePage(-1)">&#60; Previous</a></li>
                                                    <li><a href="javascript:void(0);" class="next"
                                                            onclick="changePage(1)">Next &#62;</a></li>
                                                </ul>
                                            </div>

                                            <style>
                                                #pagination-controls {
                                                    margin-top: 30px;
                                                    font-family: 'Arial', sans-serif;
                                                }

                                                .pagination {
                                                    display: inline-flex;
                                                    list-style: none;
                                                    padding: 0;
                                                    margin: 0;
                                                }

                                                .pagination li {
                                                    margin: 0 10px;
                                                }

                                                .pagination a {
                                                    display: inline-block;
                                                    padding: 10px 20px;
                                                    font-size: 14px;
                                                    text-decoration: none;
                                                    color: #fff;
                                                    background-color: #007bff;
                                                    border-radius: 5px;
                                                    transition: background-color 0.3s ease;
                                                }

                                                .pagination a:hover {
                                                    background-color: #0056b3;
                                                }

                                                .pagination .disabled a {
                                                    background-color: #e0e0e0;
                                                    color: #b0b0b0;
                                                    pointer-events: none;
                                                }

                                                .pagination .prev a {
                                                    padding-left: 10px;
                                                    padding-right: 10px;
                                                }

                                                .pagination .next a {
                                                    padding-left: 10px;
                                                    padding-right: 10px;
                                                }

                                                .pagination a:focus {
                                                    outline: none;
                                                    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
                                                }
                                            </style>

                                            <script>
                                                const rowsPerPage = 5;
                                                let currentPage = 1;

                                                function displayTable() {
                                                    const rows = document.querySelectorAll('.category-row');
                                                    const totalRows = rows.length;
                                                    const totalPages = Math.ceil(totalRows / rowsPerPage);

                                                    // Hide all rows
                                                    rows.forEach(row => row.style.display = 'none');

                                                    // Display rows for the current page
                                                    const startIndex = (currentPage - 1) * rowsPerPage;
                                                    const endIndex = startIndex + rowsPerPage;
                                                    for (let i = startIndex; i < endIndex && i < totalRows; i++) {
                                                        rows[i].style.display = '';
                                                    }

                                                    // Update pagination controls
                                                    const paginationControls = document.querySelector('.pagination');
                                                    paginationControls.innerHTML = `
                                                        <li><a href="javascript:void(0);" class="prev" onclick="changePage(-1)" ${currentPage === 1 ? 'class="disabled"' : ''}>&#60; Previous</a></li>
                                                        <li><a href="javascript:void(0);" class="next" onclick="changePage(1)" ${currentPage === totalPages ? 'class="disabled"' : ''}>Next &#62;</a></li>
                                                    `;
                                                }

                                                function changePage(direction) {
                                                    const rows = document.querySelectorAll('.category-row');
                                                    const totalRows = rows.length;
                                                    const totalPages = Math.ceil(totalRows / rowsPerPage);

                                                    currentPage += direction;

                                                    if (currentPage < 1) currentPage = 1;
                                                    if (currentPage > totalPages) currentPage = totalPages;

                                                    displayTable();
                                                }

                                                // Initialize the table on page load
                                                document.addEventListener('DOMContentLoaded', () => {
                                                    displayTable();
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
