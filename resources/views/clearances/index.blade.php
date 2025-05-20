<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Letter</title>
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

<!-- Begin page -->
<div id="layout-wrapper">

@include('includes.header')

@include('includes.sidebar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
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
                                    Are you sure you want to delete this User?
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

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">
                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="#">
                                        <i class="dripicons-arrow-thin-left"></i></a>

                                    <a class="btn btn-info btn-sm waves-effect waves-light"
                                        href="/clearances/create">Generate Letter for Garnished Invoices</a>
                                </h4>

                                <div class="table-rep-plugin">
                                    <div  data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th data-priority="1">Agent Details</th>
                                                    <th data-priority="1">Supplier Details</th>
                                                    <th data-priority="1">Bank Details</th>
                                                    <th data-priority="6">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clearances as $item)


                                                <tr>
                                                    <td>
                                                        <b>{{ $item->user->name }}</b><br>
                                                        <span style="font-size: 11px; color:rgb(112, 112, 112);">
                                                            Agent TPIN: {{ $item->user->tpin ?? 'None' }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <b>{{ $item->garnish->document->supplier_name }}</b><br>
                                                        <span style="font-size: 11px; color:rgb(92, 92, 92)">
                                                            Invoice No: {{ $item->garnish->document->invoice_no }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <b>{{ $item->bank_name }}</b><br>
                                                        <span style="font-size: 11px; color:rgb(92, 92, 92)">
                                                            Bank Director: {{ $item->director }}
                                                        </span>
                                                    </td>
                                                    <td>

                                                        <a class="btn btn-info waves-effect waves-light" href="{{ route('clearances.show',$item->slug) }}">Open Letter</a>
                                                        <a href="{{ route('clearances.exportToPDF', $item->slug) }}" class="btn btn-info  waves-effect waves-light"><i class="dripicons-download"></i> Download Letter</a>

                                                        <a class="btn btn-info waves-effect waves-light" id="sa-warning" href="{{ route('clearances.edit',$item->slug) }}"><i class="dripicons-document-edit"></i></a>


                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('clearances.destroy', $item->slug) }}">
                                                                        <i class="dripicons-trash"></i> Delete
                                                                    </button>

                                                    </td>
                                                </tr>
                                                @endforeach
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

@if(Session::has('message'))

<script>
    swal("Hi!, {{$user->name}}", "{{ Session::get('message') }}",'success',{
        button:true,
        button:"Close",
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


</body>

</html>
