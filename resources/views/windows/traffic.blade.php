<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Live Online</title>
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
                                    Are you sure you want to delete this Department?
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

                        <!-- Copy and Paste this section for more items -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="#" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <span style="font-size: 15px; color: #555;"><b>{{ $onlineUsers->count() }}</b></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Total VM's Online</h6>
                                        <p class="mb-0 text-muted">View the current active users online</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                        <!-- Repeatable Icon Section -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="#" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px; cursor: pointer;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <span style="font-size: 15px; color: #555;"><b>{{ $onlineUsers->count('city') }}</b></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Regions</h6>
                                        <p class="mb-0 text-muted">Cities & Regions</p>
                                    </div>

                                </div>
                            </a>
                        </div>




                        <!-- Add more items as needed -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="#" style="text-decoration: none;">
                                <div class="d-flex align-items-center p-3"
                                    style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                                    <div class="icon-container me-3"
                                        style="width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; background-color: #f5f5f5; border-radius: 5px;">
                                        <span style="font-size: 15px; color: #555;"><b>{{ $myuser->count()}}</b></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Total Number Users</h6>
                                        <p class="mb-0 text-muted">Number of Total Users Worldwide</p>
                                    </div>

                                </div>
                            </a>
                        </div>





                    </div>



                    <style>
                        .hover-expand {
                            border-radius: 10px;
                            transition: transform 0.3s ease;
                            /* Smooth transition for the transform property */
                            overflow: hidden;
                            /* Prevents overflow during the animation */
                        }

                        .hover-expand:hover {
                            transform: scale(1.05);
                            /* Slightly increase size on hover */
                        }
                    </style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="table-rep-plugin">
                    <div class="table-responsive b-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">Online Now</th>
                                    <th data-priority="1">Contact Information</th>
                                    <th data-priority="1">Country/City</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @if ($onlineUsers->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="text-center" style="margin-top: 20px;">
                                                <h5>No Active Users</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($onlineUsers as $onlineUser)
                                        <tr>
                                            <td>
                                                {{ $onlineUser->name }}
                                                <br>
                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                    (Last Active: {{ $onlineUser->last_activity->diffForHumans() }})
                                                </span><span class="blinking-light"></span>
                                            </td>
                                            <td>
                                                {{ $onlineUser->email }}
                                                <br>
                                                <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                    Member Since: {{ \Carbon\Carbon::parse($onlineUser->created_at)->format('F j, Y') }}
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- Pagination Controls -->
<div id="pagination" class="text-center" style="margin-top: 20px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<style>
    .blinking-light {
        display: inline-block;
        width: 5px;
        height: 5px;
        background-color: green;
        border-radius: 50%;
        margin-right: 5px;
        animation: blink 3s infinite;
    }

    @keyframes blink {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0;
        }
    }
</style>


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

    <script>
        // Reload the page every 1 minute (60000 milliseconds)
        setInterval(function() {
            location.reload(); // Refresh the page
        }, 20000);
        </script>


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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;  // Number of rows per page
    const tableBody = document.getElementById("table-body");
    const pagination = document.getElementById("pagination");

    // Get all rows from the table body
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

        for (let i = 1; i <= totalPages; i++) {
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

    // Initialize the table and pagination controls
    renderTable(1); // Render the first page
    renderPagination(); // Generate pagination buttons
});

</script>
</body>

</html>
