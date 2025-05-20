<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Quotations</title>
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
    <!-- Approve Delivery Modal -->
    <div class="modal fade" id="approveDeliveryModal" tabindex="-1" role="dialog"
        aria-labelledby="approveDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('quotations.approveDelivery') }}" method="POST">
                @csrf
                <input type="hidden" name="quotation_id" id="delivery-quotation-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveDeliveryModalLabel">Approve Delivery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to approve delivery for <strong id="delivery-client-name"></strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Approve Quotation Modal -->
    <div class="modal fade" id="approveQuotationModal" tabindex="-1" aria-labelledby="approveQuotationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveQuotationModalLabel">Approve Quotation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="approveQuotationForm" method="POST" action="{{ route('quotations.approve', 0) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <p>Are you sure you want to approve the quotation for <strong id="modalClientName"></strong>?
                        </p>
                        <input type="hidden" name="quotation_id" id="quotationId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Approve</button>
                    </div>
                </form>
            </div>
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
                    Are you sure you want to delete this Quotation?
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
                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        {{ formatCurrency($totalGrandTotal) }}</h3>
                                    <span style="font-size: 12px"> Total Amount of Quotations</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        {{ formatCurrency($salesGrandTotal) }}</h3>
                                    <span style="font-size: 12px"> Total Complete Sales</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        {{ $quotations->where('delivery_status', 'delivered')->count() }}
                                    </h3>
                                    <span style="font-size: 12px"> Total Delivered Products</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card text-center">
                                <div class="mb-2 card-body text-muted">
                                    <h3 style="font-size: 15px" class="text-info mt-2">
                                        {{ $quotations->where('delivery_status', 'pending')->count() }}
                                    </h3>
                                    <span style="font-size: 12px"> Total Undelivered Products</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/windows/business_manager"><i
                                                class="dripicons-arrow-thin-left"></i></a>
                                        <a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/quotations/create"><i class="dripicons-plus"></i></a>
                                        <a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/profit">Sales</a>
                                        {{-- <a class="btn btn-sm btn-info waves-effect waves-light" href="/quotations/create">Contracts</a> --}}

                                    </h4>
                                    {{-- <p class="card-title-desc"><b>{{$profileData->last_name}}</b>, this is the total Amount you have spent on all your projects</b></p> --}}


                                    <div class="table-rep-plugin">
                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">Client Name</th>
                                                        <th data-priority="3">Amount</th>
                                                        <th data-priority="6">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($quotations->isEmpty())
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                <div class="text-center" style="margin-top: 20px;">
                                                                    <h5>No Quotations Uploaded</h5>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @else
                                                        @forelse($quotations as $index => $quotation)
                                                            <tr>
                                                                <td><b>{{ $quotation->client->client_name ?? 'None' }}</b><br><span
                                                                        style="font-size: 11px; color:rgb(112, 112, 112);">Client
                                                                        Email:
                                                                        {{ $quotation->client->email ?? 'None' }}</span>
                                                                </td>
                                                                <td>

                                                                    <b>Tax Amount:
                                                                        {{ formatCurrency($quotation->tax_amount) ?? 'None' }}</b>
                                                                    <br>
                                                                    <span style="font-size: 11px;">
                                                                        Grand Total:
                                                                        {{ formatCurrency($quotation->grand_total) ?? 'None' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{-- <form action="{{ route('expenses.destroy', $item->id) }}" method="POST"> --}}
                                                                    <a class="btn  btn-info waves-effect waves-light"
                                                                        href="{{ route('quotations.show', $quotation->slug) }}">
                                                                        <i class="dripicons-preview"></i>
                                                                    </a>
                                                                    @if ($quotation->status === 'unapproved')
                                                                        <a class="btn  btn-warning waves-effect waves-light"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#approveQuotationModal"
                                                                            data-id="{{ $quotation->id }}"
                                                                            data-client-name="{{ $quotation->client_name }}">
                                                                            Pending
                                                                        </a>
                                                                    @elseif ($quotation->status === 'approved')
                                                                        <a class="btn btn-success waves-effect waves-light"
                                                                            disabled>
                                                                            Approved
                                                                        </a>
                                                                    @endif


                                                                    <a class="btn btn-info  waves-effect waves-light {{ $quotation->status === 'approved' ? 'disabled' : '' }}"
                                                                        id="sa-warning"
                                                                        href="{{ $quotation->status === 'approved' ? '#' : route('quotations.edit', $quotation->slug) }}">
                                                                        <i class="dripicons-document-edit"></i>
                                                                    </a>


                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('quotation.exportToPDF', $quotation->slug) }}">
                                                                        <i class="dripicons-download"></i> Quotation
                                                                    </a>

                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('quotations.exportToPDF', $quotation->slug) }}">
                                                                        <i class="dripicons-download"></i> Invoice
                                                                    </a>

                                                                    <a class="btn btn-info waves-effect waves-light"
                                                                        id="sa-warning"
                                                                        href="{{ route('receipts.exportToPDF', $quotation->slug) }}">
                                                                        <i class="dripicons-download"></i> Receipt
                                                                    </a>

                                                                    @if ($quotation->delivery_status === 'pending')
                                                                        <button
                                                                            class="btn btn-warning waves-effect waves-light"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#approveDeliveryModal"
                                                                            data-id="{{ $quotation->id }}"
                                                                            data-client-name="{{ $quotation->client_name }}">
                                                                            Approve Delivery
                                                                        </button>
                                                                    @elseif ($quotation->delivery_status === 'delivered')
                                                                        <a class="btn btn-success waves-effect waves-light"
                                                                            href="{{ route('delivery.exportToPDF', $quotation->slug) }}">
                                                                            <i class="dripicons-download"></i> D - Note
                                                                        </a>
                                                                    @endif

                                                                    <a class="btn btn-dark waves-effect waves-light"
                                                                        href="{{ route('quotations.sendEmail', $quotation->slug) }}">
                                                                        <i class="dripicons-mail"></i> Send Quotation
                                                                    </a>

                                                                    <!-- Delete button to open modal -->
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteMinistryModal"
                                                                        data-route="{{ route('quotations.destroy', $quotation->slug) }}">
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


    {{-- status --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveModal = document.getElementById('approveQuotationModal');
            approveModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const quotationId = button.getAttribute('data-id');
                const clientName = button.getAttribute('data-client-name');

                // Populate modal fields
                approveModal.querySelector('#quotationId').value = quotationId;
                approveModal.querySelector('#modalClientName').textContent = clientName;

                // Update form action dynamically if needed
                const form = approveModal.querySelector('#approveQuotationForm');
                form.action = `{{ url('quotations') }}/${quotationId}/approve`;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveDeliveryModal = document.getElementById('approveDeliveryModal');
            approveDeliveryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const quotationId = button.getAttribute('data-id');
                const clientName = button.getAttribute('data-client-name');

                // Update modal fields
                approveDeliveryModal.querySelector('#delivery-quotation-id').value = quotationId;
                approveDeliveryModal.querySelector('#delivery-client-name').textContent = clientName;
            });
        });
    </script>

</body>

</html>
