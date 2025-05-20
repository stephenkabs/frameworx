<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Stores</title>
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

    <div class="modal fade" id="appDetailsModal" tabindex="-1" aria-labelledby="appDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appDetailsModalLabel">App Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Image Section -->
                    <div class="text-center mb-3">
                        <img id="modal-app-image" src="#" alt="App Icon" class="img-thumbnail" style="max-width: 150px; border-radius: 10px;" />
                    </div>
                    <!-- App Details -->
                    <p><strong>Name:</strong> <span id="modal-app-name"></span></p>
                    <p><strong>Link:</strong> <a href="#" id="modal-app-link" target="_blank"></a></p>
                    <p><strong>Category:</strong> <span id="modal-app-type"></span></p>
                    <p><strong>About:</strong> <span id="modal-app-about"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
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
                                    Are you sure you want to delete this App?
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
                                        <a class="btn btn-sm btn-info waves-effect waves-light" href="/windows/user_settings"><i class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-sm btn-info waves-effect waves-light" href="/stores/create"><i class="dripicons-plus"></i></a>
                                        <a class="btn btn-sm btn-info waves-effect waves-light" href="/windows/apps">Install Apps from AwCloud Stores</a>

                                        </h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <!-- Search input field -->
                                            <div class="mb-3">
                                                <input type="text" id="search-input" class="form-control" placeholder="Search by App Name" />
                                            </div>

                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Apps Name</th>
                                                        <th data-priority="3">Link</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    @if ($stores->isEmpty())
                                                        <tr>
                                                            <td colspan="3" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Apps Uploaded</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($stores as $item)
                                                            <tr>
                                                                <td>
                                                                    <b>{{ $item->stream_name }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        App Category: {{ $item->type }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <b>{{ $item->stream_link }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                                        App Link
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <!-- Modal Trigger -->
                                                                    <button class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#appDetailsModal"
                                                                    data-name="{{ $item->stream_name }}"
                                                                    data-link="{{ $item->stream_link }}"
                                                                    data-type="{{ $item->type }}"
                                                                    data-about="{{ $item->stream_about }}"
                                                                    data-image="{{ asset('app_icons/' . $item->file) }}">
                                                                <i class="dripicons-preview"></i>
                                                            </button>

                                                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="{{ route('stores.edit', $item->id) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteMinistryModal" data-route="{{ route('stores.destroy', $item->id) }}">
                                                                        <i class="dripicons-trash"></i>
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
                                    <div id="pagination" class="text-center" style="margin-top: 20px;"></div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;  // Number of rows per page
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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const appDetailsModal = document.getElementById('appDetailsModal');

    appDetailsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const name = button.getAttribute('data-name');
        const link = button.getAttribute('data-link');
        const type = button.getAttribute('data-type');
        const about = button.getAttribute('data-about');
        const image = button.getAttribute('data-image');

        // Populate modal fields
        appDetailsModal.querySelector('#modal-app-name').textContent = name;
        const appLinkElement = appDetailsModal.querySelector('#modal-app-link');
        appLinkElement.textContent = link;
        appLinkElement.href = link;
        appDetailsModal.querySelector('#modal-app-type').textContent = type;
        appDetailsModal.querySelector('#modal-app-about').textContent = about;

        // Set the image source or fallback to placeholder if no image exists
        const appImageElement = appDetailsModal.querySelector('#modal-app-image');
        appImageElement.src = image || 'https://via.placeholder.com/150';
    });
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
