<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reminders</title>
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

    <style>
        .calculator {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            background: #2a2a2a;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            color: #fff;
        }

        .display {
            font-size: 2rem;
            background: #444;
            color: #fff;
            text-align: right;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .button {
            background: #555;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .button:hover {
            background: #777;
        }

        .button.function {
            background: #6c757d;
        }

        .button.operator {
            background: #007bff;
        }

        .button.operator:hover {
            background: #0056b3;
        }

        .button:active {
            background: #333;
        }
    </style>

</head>

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">

<!-- Loader -->
@include('loader.loader')
@include('toast.success_toast')
<!-- Begin page -->
<div id="layout-wrapper">


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid" style="padding: 20px; color: #000;">
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: center; margin-top: 100px;">
                            <h1>Aw Search Business Enginee</h1>
                            <div style="margin-top: 20px; position: relative; display: inline-block; width: 60%;">
                                <input type="text" id="searchBox" class="form-control"
                                       style="padding: 15px; border-radius: 50px; text-align: center;"
                                       placeholder="Search..." oninput="fetchSuggestions(this.value)">
                                <ul id="suggestionsList"
                                    style="list-style: none; padding: 0; margin: 0; background: white; border: 1px solid #ccc; border-radius: 10px; position: absolute; width: 100%; display: none; z-index: 9999;">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            async function fetchSuggestions(query) {
                if (query.length > 1) {
                    const response = await fetch(`/search-suggestions?query=${encodeURIComponent(query)}`);
                    const suggestions = await response.json();

                    const suggestionsList = document.getElementById("suggestionsList");
                    suggestionsList.innerHTML = "";

                    if (suggestions.length) {
                        suggestionsList.style.display = "block";
                        suggestions.forEach((suggestion) => {
                            const li = document.createElement("li");
                            li.style.padding = "10px";
                            li.style.cursor = "pointer";
                            li.textContent = suggestion;
                            li.onclick = () => {
                                document.getElementById("searchBox").value = suggestion;
                                suggestionsList.style.display = "none";
                            };
                            suggestionsList.appendChild(li);
                        });
                    } else {
                        suggestionsList.style.display = "none";
                    }
                } else {
                    document.getElementById("suggestionsList").style.display = "none";
                }
            }
        </script>

<!-- END layout-wrapper -->

@include('includes.taskbar')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="/assets/js/app.js"></script>

@include('toast.error_success_js')

</body>

</html>
