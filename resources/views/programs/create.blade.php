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
                                <div class="card-body">
                                    <form id="notesForm" class="row needs-validation" action="{{ route('programs.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="text-center mb-3">
                                            <button id="start" type="button" class="btn btn-primary rounded-circle" style="width: 60px; height: 60px;">
                                                <i class="fas fa-microphone"></i>
                                            </button>
                                            <div class="mt-2 fw-bold text-primary">Click on Mic & Start Speaking</div>
                                        </div>

                                        <div class="mb-3">
                                            <textarea id="output" class="form-control bg-primary text-white rounded-4" name="description" rows="20" placeholder="Your notes..." style="resize: none;"></textarea>
                                        </div>

                                        <!-- Hidden input to hold the title from the modal -->
                                        <input type="hidden" name="title" id="noteTitle">

                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#titleModal">
                                                Save Notes
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Bootstrap Modal -->
                                    <div class="modal fade" id="titleModal" tabindex="-1" aria-labelledby="titleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Enter Note Title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" id="modalTitleInput" class="form-control" placeholder="Note title...">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" id="submitNote" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <form class="row needs-validation" action="{{ route('programs.store') }}" novalidate method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="text-center mb-3">
                                            <button id="start" type="button" class="btn btn-primary rounded-circle" style="width: 60px; height: 60px;">
                                                <i class="fas fa-microphone"></i>
                                            </button>
                                            <div class="mt-2 fw-bold text-primary">Start Speaking</div>
                                        </div>

                                        <div class="mb-3">

                                            <textarea id="output" class="form-control bg-primary text-white rounded-4" name="description" rows="20" placeholder="Your notes..." style="resize: none;"></textarea>

                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Notes</button>
                                        </div>
                                    </form> --}}



                                </div>
                            </div>
                        </div>

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

    <script>
        document.getElementById('submitNote').addEventListener('click', function () {
            const title = document.getElementById('modalTitleInput').value.trim();

            if (title === '') {
                alert('Please enter a title.');
                return;
            }

            document.getElementById('noteTitle').value = title;
            document.getElementById('notesForm').submit();
        });
    </script>


    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>
    <script>
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

        if (SpeechRecognition) {
          const recognition = new SpeechRecognition();
          recognition.lang = 'en-US';
          recognition.interimResults = true;
          recognition.continuous = true;

          const output = document.getElementById('output');
          const startBtn = document.getElementById('start');
          let finalTranscript = '';
          let lastResultTime = Date.now();

          startBtn.addEventListener('click', () => {
            finalTranscript = '';
            output.textContent = "[Listening...]\n";
            recognition.start();
          });

          recognition.onresult = (event) => {
            let interimTranscript = '';
            const now = Date.now();
            const timeDiff = now - lastResultTime;
            lastResultTime = now;

            for (let i = event.resultIndex; i < event.results.length; ++i) {
              let transcript = event.results[i][0].transcript.trim();

              if (event.results[i].isFinal) {
                // Add punctuation based on pause
                if (timeDiff > 2000 && finalTranscript.length > 0) {
                  finalTranscript += '.\n\n';
                } else if (finalTranscript.length > 0) {
                  finalTranscript += '. ';
                }

                // Capitalize first letter
                transcript = transcript.charAt(0).toUpperCase() + transcript.slice(1);
                finalTranscript += transcript;
              } else {
                interimTranscript += transcript;
              }
            }

            output.textContent = finalTranscript + ' ' + interimTranscript;
          };

          recognition.onerror = (event) => {
            output.textContent += `\n[Error: ${event.error}]`;
          };
        } else {
          alert("Speech Recognition not supported in your browser.");
        }
      </script>
</body>

</html>
