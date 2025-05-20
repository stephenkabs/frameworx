<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Payslip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

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

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-sm btn-info waves-effect waves-light"
                                            href="/payslip"><i class="dripicons-arrow-thin-left"></i></a></h4><br>


                                    <form class="row needs-validation" action="{{ route('payslip.store') }}" novalidate
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Our Branch Addresses</label>
                                            <select name="detail_id" class="form-select" required>

                                                @foreach ($detail as $item)
                                                    <option value="{{ $item->id }}">{{ $item->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="mb-3 position-relative">
                                                    <label class="form-label" for="member-select">Salaries</label>
                                                    <select name="salary_ids[]" class="form-select" id="member-select" required multiple>
                                                        <option value="" disabled>Select Employee Salaries</option>
                                                        @foreach ($salary as $item)
                                                            <option value="{{ $item->id }}">{{ $item->worker->name ?? 'None' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                        @foreach ($salary as $item)
                                            <input type="hidden" name="salary_ids[]" value="{{ $item->id }}">
                                        @endforeach
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Payment Date</label>
                                            <div>
                                                <input name="date" type="date" class="form-control"
                                                    placeholder="Enter Payment Date" required
                                                    value="{{ now()->format('Y-m-d') }}" />
                                            </div>
                                        </div>


                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Prepared By</label>
                                            <div>
                                                <input name="prepared_by" type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}" readonly required />
                                            </div>
                                        </div>


                                        <div class="mb-0">
                                            <div>
                                                {{-- <button type="submit" class="btn btn-info waves-effect waves-light">Run
                                                    Payroll for</button> --}}


                                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                                   <b> Run Payrolls</b>
                                                </button>
                                                <button type="reset"
                                                    class="btn btn-secondary waves-effect ms-1">Cancel</button>
                                            </div>
                                        </div>
                                    </form>




                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <!-- end col -->
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

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salaryIds = @json($salary->pluck('id'));
            document.getElementById('salary-ids').value = salaryIds.join(',');
        });
    </script>


</body>

</html>
