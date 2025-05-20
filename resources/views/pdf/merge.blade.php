
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Merge Automate</title>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="card-title">
                                        <a class="btn btn-info waves-effect waves-light" href="/departments">
                                            <i class="dripicons-arrow-thin-left"></i>
                                        </a>
                                    </h4>
                                    <br>

                                    <form id="upload-form" action="{{ route('pdf.merge') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div id="upload-container">
                                            <label for="file-upload" class="upload-label">
                                                <div class="upload-icon" style="font-size: 50px; color: #868686;">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <p><b>PDF Merging Automate</b></p>
                                                <button type="button" id="upload-btn" class="btn btn-info"><b>Upload Multiple PDF Files</b></button>
                                            </label>
                                            <input type="file" id="file-upload" name="pdf_files[]" accept="application/pdf" multiple hidden>
                                        </div>

                                        <div id="preview-container" class="d-none">
                                            <h5>Uploaded Files</h5>
                                            <ul id="file-list" class="list-group"></ul>
                                            <button type="submit" id="submit-btn" class="btn btn-success mt-3">Download Merged Documents</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('file-upload').addEventListener('change', function(event) {
                            let fileList = document.getElementById('file-list');
                            let uploadBtn = document.getElementById('upload-btn');
                            let previewContainer = document.getElementById('preview-container');

                            fileList.innerHTML = '';
                            Array.from(event.target.files).forEach((file, index) => {
                                let listItem = document.createElement('li');
                                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                                listItem.textContent = file.name;
                                listItem.draggable = true;
                                listItem.dataset.index = index;

                                listItem.addEventListener('dragstart', function(e) {
                                    e.dataTransfer.setData('text/plain', listItem.dataset.index);
                                });

                                listItem.addEventListener('dragover', function(e) {
                                    e.preventDefault();
                                });

                                listItem.addEventListener('drop', function(e) {
                                    e.preventDefault();
                                    let draggedIndex = e.dataTransfer.getData('text/plain');
                                    let draggedItem = document.querySelector(`[data-index='${draggedIndex}']`);
                                    if (draggedItem && draggedItem !== listItem) {
                                        fileList.insertBefore(draggedItem, listItem.nextSibling);
                                    }
                                });

                                fileList.appendChild(listItem);
                            });

                            uploadBtn.classList.add('d-none');
                            previewContainer.classList.remove('d-none');
                        });

                        document.getElementById('upload-btn').addEventListener('click', function () {
    document.getElementById('file-upload').click();
});
                    </script>
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


