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
                        <!-- Column 1: Input -->
                        <div class="col-lg-6">
                            <div class="card shadow my-5">
                                <div class="card-body">
                                    <h3 class="mb-2" style="font-size: 18px">Smart Note Formatter</h3>

                                    <!-- Raw Notes Input -->
                                    <textarea id="rawNotes" class="form-control mb-3" rows="25" placeholder="Paste your raw notes here...">{{ $program->description }}</textarea>

                                    <!-- Format Button -->
                                    <button onclick="formatNotes()" class="btn btn-primary">Format Notes</button>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Output -->
                        <div class="col-lg-6">
                            <div class="card shadow my-5">
                                <div class="card-body">
                                    <h3 class="mb-3" style="font-size: 18px">Formatted Output<br>
                                        <button onclick="downloadPDF()" class="btn btn-success btn-sm mt-2">Download as PDF</button></h3>


                                    <div id="formattedOutput" class="p-3 border rounded bg-white" style="white-space: pre-wrap; min-height: 550px;"></div>
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

    <!-- JavaScript -->
<script>
    function formatNotes() {
        let text = document.getElementById("rawNotes").value;

        // Normalize whitespace
        text = text.trim().replace(/\s+/g, ' ');

        // Add punctuation (very basic heuristics)
        text = text.replace(/([a-z]) ([A-Z])/g, '$1. $2'); // Likely new sentence
        text = text.replace(/([a-zA-Z])([.?!])([a-zA-Z])/g, '$1$2 $3'); // Add space after punctuation
        text = text.replace(/([a-z])([.?!])(\s*[A-Z])/g, '$1$2 $3'); // Extra cleanup

        // Capitalize first letter of each sentence
        text = text.replace(/(?:^|[.?!]\s)([a-z])/g, (match, p1) => match.replace(p1, p1.toUpperCase()));

        // Break into paragraphs every 3 sentences
        const sentences = text.split(/(?<=[.?!])\s+/);
        let paragraphs = '';
        for (let i = 0; i < sentences.length; i++) {
            if (i % 3 === 0) paragraphs += '\n\n';
            paragraphs += sentences[i] + ' ';
        }

        // Output formatted text
        document.getElementById("formattedOutput").innerText = paragraphs.trim();
    }
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
<script>
    async function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Set font size to 12
        doc.setFontSize(12);

        // Get the formatted text
        const content = document.getElementById("formattedOutput").innerText;

        // Split text into lines that fit the page
        const lines = doc.splitTextToSize(content, 180);

        // Add the text to the PDF
        doc.text(lines, 10, 10);

        // Save the PDF
        doc.save("{{ $program->title }}.pdf");
    }
</script>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</body>

</html>
