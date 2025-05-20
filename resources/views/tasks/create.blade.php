<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tasks</title>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><a class="btn btn-info waves-effect waves-light"
                                            href="/tasks"><i class="dripicons-arrow-thin-left"></i></a></h4><br>

                                            <form class="row needs-validation" action="{{ route('tasks.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <!-- First Column -->
                                                <div class="col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationCustom01">Task Subject</label>
                                                        <input type="text" name="title" class="form-control" id="validationCustom01" placeholder="Enter Title" required />
                                                        <div class="valid-tooltip">
                                                            Looks good!
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationCustom01">Clients</label>
                                                        <select name="client_id" class="form-select" id="validationCustom01" required>
                                                            <option value="" disabled selected>Select Client</option>
                                                            @foreach ($clients as $item)
                                                                <option value="{{ $item->id }}">{{ $item->client_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Priority</label>
                                                        <select name="priority" class="form-select">
                                                            <option value="" disabled selected>Select Priority</option>
                                                            <option value="high">High</option>
                                                            <option value="urgent">Urgent</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="low">Low</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationCustom01">Task Category</label>
                                                        <select name="category_id" class="form-select" id="validationCustom01" required>
                                                            <option value="" disabled selected>Select Categories</option>
                                                            @foreach ($categories as $item)
                                                                @if ($item->type === 'Task')
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label">Start Date</label>
                                                        <input name="start_date" type="date" class="form-control" required />
                                                    </div>
                                                </div>

                                                <!-- Second Column -->
                                                <div class="col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationCustom01">Assign To</label>
                                                        <select name="worker_id" class="form-select" id="validationCustom01" required>
                                                            <option value="" disabled selected>Select Employee</option>
                                                            @foreach ($employee as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="in-progress">In-progress</option>
                                                            <option value="completed">Completed</option>
                                                            <option value="on-hold">On-Hold</option>
                                                            <option value="canceled">Canceled</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label">End Date</label>
                                                        <input name="end_date" type="date" class="form-control" required />
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="8" required></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                        <button type="reset" class="btn btn-secondary waves-effect ms-1">Cancel</button>
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
