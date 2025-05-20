<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Notes</title>
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
                                    Are you sure you want to delete this Expense?
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
                                            class="btn btn-info btn-sm waves-effect waves-light" href="/programs/create"><i class="dripicons-plus"></i></a></h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div  data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Minutes Title</th>

                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($programs->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Expenses Uploaded</h5>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($programs as $item)
                                                            <tr>

                                                                <td>

                                                                    <b>{{ $item->title }}</b>
                                                                    <br>
                                                                    <span
                                                                        style="font-size: 11px;">

                                                                      Date:
                                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}
                                                                    </span></td>

                                                                <td>
                                                                    {{-- <form action="{{ route('expenses.destroy', $item->id) }}" method="POST"> --}}
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        href="{{ route('programs.show', $item->slug) }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </a>
                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('programs.edit', $item->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>
                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('programs.destroy', $item->slug) }}">
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
