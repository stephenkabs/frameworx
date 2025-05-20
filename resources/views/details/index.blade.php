<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Details Settings</title>
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


    <!-- Modal -->
<div class="modal fade" id="showDetailsModal" tabindex="-1" aria-labelledby="showDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDetailsModalLabel">Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="companyImage" src="" alt="Company Logo" class="img-fluid rounded" style="max-width: 150px;">
                </div>
                <p><strong>Company Name:</strong> <span id="companyName"></span></p>
                <p><strong>Email:</strong> <span id="companyEmail"></span></p>
                <p><strong>Phone:</strong> <span id="companyPhone"></span></p>
                <p><strong>Address:</strong> <span id="companyAddress"></span></p>
                <p><strong>Website:</strong> <span id="companyWebsite"></span></p>
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
                                    Are you sure you want to delete this Information?
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
                                            href="/windows/business_manager"><i class="dripicons-arrow-thin-left"></i></a> <a
                                            class="btn btn-info btn-sm waves-effect waves-light" href="/details/create"><i class="dripicons-plus"></i></a></h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Company Name</th>
                                                        <th data-priority="3">Email</th>
                                                        <th data-priority="6">Attachment</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($details->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Details Uploaded</h5>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($details as $item)
                                                            <tr>
                                                                <td><b>{{ $item->name }}</b><br>
                                                                    <span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Address
                                                                        : {{ $item->address }}</span>
                                                                    </td>

                                                                    <td><b>{{ $item->email }}</b><br>
                                                                        <span
                                                                            style="font-size: 11px; color:rgb(112, 112, 112);">Phone Number:
                                                                            : {{ $item->phone }}</span>
                                                                        </td>

                                                                <td>
                                                                    <b><a href="/logos/{{ $item->image }}" download>
                                                                            {{ $item->attachment_name ?? 'Company Logo' }}
                                                                        </a></b>
                                                                    <br><span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);"> Logo Attachment</span>
                                                                </td>
                                                                <td>
                                                                    {{-- <form action="{{ route('expenses.destroy', $item->id) }}" method="POST"> --}}
                                                                        <button type="button"
                                                                        class="btn btn-info waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#showDetailsModal"
                                                                        data-name="{{ $item->name }}"
                                                                        data-email="{{ $item->email }}"
                                                                        data-phone="{{ $item->phone }}"
                                                                        data-address="{{ $item->address }}"
                                                                        data-website="{{ $item->website }}"
                                                                        data-image="/logos/{{ $item->image }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </button>

                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('details.edit', $item->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('details.destroy', $item->slug) }}">
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
            const showDetailsModal = document.getElementById('showDetailsModal');
            showDetailsModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const address = button.getAttribute('data-address');
                const website = button.getAttribute('data-website');
                const image = button.getAttribute('data-image');

                // Update modal content
                showDetailsModal.querySelector('#companyName').textContent = name;
                showDetailsModal.querySelector('#companyEmail').textContent = email;
                showDetailsModal.querySelector('#companyPhone').textContent = phone;
                showDetailsModal.querySelector('#companyAddress').textContent = address;
                showDetailsModal.querySelector('#companyWebsite').textContent = website;
                showDetailsModal.querySelector('#companyImage').src = image;
            });
        });
    </script>


</body>

</html>
