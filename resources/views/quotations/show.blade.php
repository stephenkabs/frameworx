<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Quotations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="invoice-title">
                                            {{-- <h4 class="float-end font-size-16"><strong>Order # 12345</strong></h4> --}}
                                            <h3 class="mt-0">
                                                <img src="/logos/{{ $quotation->detail->image }}" alt="logo" height="50" />

                                            </h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                                <address>
                                                    <strong>{{ $quotation->client->client_name }}</strong><br>

                                                    {{ $quotation->client->client_address }}<br>
                                                    {{ $quotation->client->email }}<br>
                                                    TPIN: {{ $quotation->client->client_tpin }}
                                                </address>
                                            </div>
                                            {{-- <div class="col-6 text-end">
                                                <address>
                                                    <strong>Shipped To:</strong><br>
                                                    Kenny Rigdon<br>
                                                    1234 Main<br>
                                                    Apt. 4B<br>
                                                    Springfield, ST 54321
                                                </address>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mt-4">
                                                <address style="background-color: rgb(242, 239, 239); padding:20px">
                                                    <strong  >Quotation Note:</strong><br>
                                                    <span style="font-size: 12px; line-height:10px" >{{ $quotation->quotation_note }}</span><br>

                                                </address>
                                            </div>
                                            <div class="col-6 mt-4 text-end">
                                                <address>
                                                    <strong>Quote Date:</strong><br>
                                                    {{ $quotation->created_at->format('d M Y, H:i') }}<br><br>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                {{-- <form class="row needs-validation" action="{{ route('quotations.update', $quotation->slug) }}" novalidate method="POST" enctype="multipart/form-data" id="projectForm">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3 position-relative">
                                        <label style="font-size: 13px" class="form-label">Enter Amount if there is a balance </label>
                                        <div>
                                            <input name="grand_total" type="number" class="form-control" value="{{ $quotation->grand_total }}" />
                                            <span class="text-danger" id="moneyRaisedError"></span>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                            <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <br> --}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="panel panel-default">
                                            <div class="p-2">
                                                <h3 class="panel-title font-size-20"><strong>QUOTATION</strong></h3>
                                            </div>
                                            <div class="">
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                                        <table id="tech-companies-1" class="table  table-striped">
                                                        <thead style="background-color: rgb(4, 51, 109)" >
                                                            <tr>
                                                                <td style="color: white"><strong>No</strong></td>
                                                                <td style="color: white" ><strong>Description</strong></td>
                                                                <td style="color: white" ><strong>Quantity</strong></td>
                                                                <td style="color: white" ><strong>Price</strong></td>
                                                                </td>
                                                                <td style="color: white"class="text-end"><strong>Total Amount</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                            @foreach ($quotation->items as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $item->product_name }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ formatCurrency($item->price ) }}</td>
                                                                <td  class="text-end">{{ formatCurrency($item->total ) }}</td>

                                                            </tr>
                                                        @endforeach

                                                            <tr>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td >
                                                                    <strong>SUBTOTAL</strong>
                                                                </td>
                                                                <td class="thick-line text-end"><b>{{ formatCurrency($quotations->sum('total') ) }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="no-line"></td>
                                                                <td >
                                                                    <strong>TAX: <b>{{ $quotation->tax_name }} {{ $quotation->tax_percentage }}%</b></strong>
                                                                </td>
                                                                <td class="no-line text-end"><b>{{ formatCurrency($quotation->tax_amount) }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="no-line"></td>
                                                                <td class="thick-line"></td>
                                                                <td class="no-line"></td>
                                                                <td >
                                                                    <strong>GRAND TOTAL</strong>
                                                                </td>
                                                                <td class="no-line text-end">
                                                                    <h4 class="m-0">{{ formatCurrency($quotation->grand_total)  }}</h4>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="d-print-none">
                                                    <div class="float-end">
                                                        {{-- <a href="#"
                                                            class="btn btn-success waves-effect waves-light">
                                                            Duplicate this Quotation</a> --}}
                                                        <a href="{{ route('quotation.exportToPDF', $quotation->slug) }}"
                                                            class="btn btn-primary waves-effect waves-light">Download  PDF</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end row -->

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
        <div class="d-print-none">
@include('includes.footer')
        </div>
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

<script src="/assets/js/app.js"></script>

<!-- Responsive Table js -->
<script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

<!-- Init js -->
<script src="assets/js/pages/table-responsive.init.js"></script>

</body>

</html>
