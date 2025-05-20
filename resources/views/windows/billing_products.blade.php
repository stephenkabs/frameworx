<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Users</title>
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
    @include('toast.success_toast')







    @include('includes.taskbar')



    @include('loader.loader')

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

                                    <div>
                                        <div>

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Package Plan</th>
                                                        <th data-priority="1">Receipts</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    @foreach ($users as $user)
                                                        @if ($user->id === auth()->id()) <!-- Show only for the logged-in user -->
                                                            <tr>
                                                                <td>
                                                                    <b style="font-size: 12px">
                                                                        {{ $user->pricingPlan->name ?? 'N/A' }}
                                                                    </b><br>
                                                                    <span style="font-size: 9px; color: rgb(112, 112, 112);">
                                                                        Price: {{ $user->pricingPlan->currency ?? 'none' }} {{ $user->pricingPlan->price  }} |
                                                                        <span style="font-size: 9px; color: {{ \Carbon\Carbon::parse($user->pricingPlan->created_at)->addMonths(1)->isToday() ? 'red' : 'rgb(112, 112, 112)' }};">
                                                                            Due On: {{ \Carbon\Carbon::parse($user->pricingPlan->created_at)->addMonths(1)->format('F j, Y') }}
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                    id="sa-warning"
                                                                    href="{{ route('user.exportToPDF', $user->slug) }}">
                                                                    <i class="dripicons-download"></i> VM Receipt
                                                                </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>

                                            </table>


                                                <script>
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const editModal = document.getElementById('editModal');
                                                        editModal.addEventListener('show.bs.modal', function(event) {
                                                            const button = event.relatedTarget; // Button that triggered the modal
                                                            const userName = button.getAttribute('data-user-name');
                                                            const userEmail = button.getAttribute('data-user-email');
                                                            const userCountry = button.getAttribute('data-user-country');
                                                            const userCity = button.getAttribute('data-user-city');
                                                            const userSlug = button.getAttribute('data-user-slug');
                                                            const userRoles = button.getAttribute('data-user-roles'); // For roles
                                                            const userStatus = button.getAttribute('data-user-status'); // For status

                                                            // Update modal form fields
                                                            this.querySelector('#userName').value = userName;
                                                            this.querySelector('#userEmail').value = userEmail;
                                                            this.querySelector('#userCountry').value = userCountry;
                                                            this.querySelector('#userCity').value = userCity;
                                                            this.querySelector('#userStatus').value = userStatus; // Set status

                                                            // Update roles in multi-select
                                                            const rolesSelect = this.querySelector('#userRoles');
                                                            Array.from(rolesSelect.options).forEach(option => {
                                                                option.selected = userRoles.includes(option.value);
                                                            });

                                                            // Update form action
                                                            this.querySelector('#editForm').action = `/user/${userSlug}`;
                                                        });
                                                    });
                                                </script>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const viewModal = document.getElementById('viewModal');
                                                        viewModal.addEventListener('show.bs.modal', function(event) {
                                                            const button = event.relatedTarget; // Button that triggered the modal
                                                            const userName = button.getAttribute('data-user-name');
                                                            const userEmail = button.getAttribute('data-user-email');
                                                            const userCountry = button.getAttribute('data-user-country');
                                                            const userCity = button.getAttribute('data-user-city');
                                                            const userRoles = button.getAttribute('data-user-roles');
                                                            const userStatus = button.getAttribute('data-user-status');

                                                            // Update modal form fields
                                                            this.querySelector('#viewUserName').value = userName;
                                                            this.querySelector('#viewUserEmail').value = userEmail;
                                                            this.querySelector('#viewUserCountry').value = userCountry;
                                                            this.querySelector('#viewUserCity').value = userCity;
                                                            this.querySelector('#viewUserRoles').value = userRoles;
                                                            this.querySelector('#viewUserStatus').value = userStatus;
                                                        });
                                                    });
                                                </script>

                                        </div>
                                    </div>




                                    <!-- Pagination Controls -->
                                    <div id="pagination" class="text-left" style="margin-top: 20px;"></div>
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
                                                    const country = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                                                    const roles = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                                                    return name.includes(query) || country.includes(query) || roles.includes(query);
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



    <script>
        // Handle status modal population (Activate/Deactivate user)
        const statusModal = document.getElementById('statusModal');
        statusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userName = button.getAttribute('data-user-name');
            const userSlug = button.getAttribute('data-user-slug');
            const isActive = button.getAttribute('data-active') == '1'; // Checking if active is true (1)

            // Determine action text for status change
            const actionText = isActive ? 'deactivate' : 'activate';

            // Set modal content dynamically
            document.getElementById('userName').textContent = userName;
            document.getElementById('statusAction').textContent = actionText;
            document.getElementById('statusActionConfirm').textContent = actionText;

            // Update the form's action URL with the user slug
            const form = document.getElementById('statusForm');
            form.action = `/user/${userSlug}/status`; // Form action URL for updating status
        });

        // Handle delete modal population
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-route'); // Route to delete the user

            // Set the delete form's action URL dynamically
            const form = document.getElementById('deleteForm');
            form.action = route; // Use the provided route for deletion
        });
    </script>
    @include('toast.error_success_js')



    <script src="/assets/js/app.js"></script>

</body>

</html>
