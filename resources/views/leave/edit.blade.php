
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Departments</title>
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

    @include('includes.validation')
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

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/leave"><i class="dripicons-arrow-thin-left"></i></a></h4><br>

                                            @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif

                                        <form action="{{ route('leave.update', $leave->slug) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Required for updating data -->

                                            <div class="mb-3">
                                                <label for="type" class="form-label">Leave Type</label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="Annual Leave" {{ $leave->type == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                                                    <option value="Sick Leave" {{ $leave->type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                                    <option value="Maternity Leave" {{ $leave->type == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                                                    <option value="Other" {{ $leave->type == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="worker_id" class="form-label">Select Worker</label>
                                                <select name="worker_id" id="worker_id" class="form-control" required>
                                                    @foreach(App\Models\Worker::all() as $worker)
                                                        <option value="{{ $worker->id }}" {{ $leave->worker_id == $worker->id ? 'selected' : '' }}>
                                                            {{ $worker->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $leave->start_date }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $leave->end_date }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description (Optional)</label>
                                                <textarea name="description" id="description" class="form-control" rows="3">{{ $leave->description }}</textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('leave.index') }}" class="btn btn-secondary">Cancel</a>
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


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>

</body>

</html>
