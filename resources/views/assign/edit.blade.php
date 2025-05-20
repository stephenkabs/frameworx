
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Assigning</title>
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
                                            href="/assign"><i class="dripicons-arrow-thin-left"></i></a></h4><br>
                                            @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif

                                        <form class="row needs-validation" action="{{ route('assign.update', $assign->id) }}" method="POST">
                                            {{-- <form class="row needs-validation" action="{{ route('assign.update', $assign->user_id) }}" method="POST"> --}}

                                            @csrf
                                            @method('PUT')

                                            <!-- Select User -->
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Select User:</label>
                                                <select name="user_id" id="user_id" class="form-control" required>
                                                    <option value="">-- Select User --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $assign->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }} ({{ $user->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Select Multiple Documents -->
                                            <div class="mb-3">
                                                <label for="document_ids" class="form-label">Select Documents:</label>
                                                <select name="document_ids[]" id="document_ids" class="form-control" multiple required>
                                                    @foreach ($documents as $document)
                                                        <option value="{{ $document->id }}"
                                                            {{ in_array($document->id, $assignedDocuments) ? 'selected' : '' }}>
                                                            {{ $document->supplier_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-0">
                                                <button type="submit" class="btn btn-info">Update</button>
                                                <a href="{{ route('assign.index') }}" class="btn btn-secondary">Cancel</a>
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
