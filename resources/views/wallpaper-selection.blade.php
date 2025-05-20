<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Desk Wallpapers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css -->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body style="background: radial-gradient(circle, rgb(5, 43, 76) 30%, rgb(7, 129, 215) 100%);" data-sidebar="dark">


@include('toast.success_toast')

<style>
    /* Sticky Nav Styles */
    .sticky-nav {
        position: sticky;
        top: 0;
        background-color: #041d37;
        display: flex;
        justify-content: flex-end;
        padding: 10px;
        z-index: 1000;
        border-bottom: 1px solid #444;
    }

    .nav-controls {
        display: flex;
        gap: 10px;
    }

    .nav-controls button {
        background-color: transparent;
        border: none;
        font-size: 16px;
        color: white;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .nav-controls button:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Folder Styles */
    .folder-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .folder {
        display: flex;
        flex-direction: column;
        text-align: center;
        margin-bottom: 5px;
    }

    .folder a {
        font-size: 10px;
        text-align: left;
    }

    .folder label {
        font-size: 10px;
        color: aliceblue;
        padding-top: 2px;
    }

    /* Wallpaper Styles */
    .wallpaper-options img {
        width: 250px;
        height: 150px;
        border: 2px solid #1a1515;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Error Notice Styles */
    #error-notice {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 10px;
        background-color: #f44336;
        color: white;
        padding: 16px;
        border-radius: 4px;
        z-index: 1000;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    #error-notice button {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog {
        margin: 100px auto;
        max-width: 500px;
    }

    .modal-content {
        padding: 20px;
        border-radius: 8px;
    }
</style>

<div id="layout-wrapper">

    @include('includes.header')
    @include('includes.sidebar')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                {{-- @include('includes.login_error') --}}
                <div class="app-buttons">
                    <div class="folder-container">
                        <form action="{{ route('wallpaper.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <button class="btn btn-info waves-effect waves-light" type="submit">Set Wallpaper</button>

                            <a class="btn btn-link btn-sm waves-effect waves-light">
                                <input name="file" type="file" class="form-control" />
                            </a>

                            <br><br>
                            <div class="wallpaper-options">
                                @foreach ($wallpapers as $wallpaper)
                                    <label>
                                        <input type="radio" name="wallpaper" value="{{ $wallpaper }}">
                                        <img src="{{ file_exists(public_path($wallpaper)) ? asset($wallpaper) : asset('/login_style/images/login-bg-3.jpg') }}" >
                                    </label>
                                @endforeach
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        @include('includes.footer')

    </div>

</div>

<div class="rightbar-overlay"></div>

<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>
<script src="/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="/assets/js/pages/form-validation.init.js"></script>
<script src="/assets/js/app.js"></script>

<script>
    window.onerror = function (message, source, lineno, colno, error) {
        const errorMessage = `Error: ${message} at ${source}:${lineno}:${colno}`;
        document.getElementById('error-message').innerText = errorMessage;
        document.getElementById('error-notice').style.display = 'block';
    };

    function closeErrorNotice() {
        document.getElementById('error-notice').style.display = 'none';
    }
</script>

</body>

</html>
