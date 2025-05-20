<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
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
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container-fluid {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-radius: 12px;
        flex-wrap: wrap;
    }

    .image-container {
        flex: 2;
        min-width: 300px;
    }

    .image-container img {
        width: 100%;
        height: auto;
        border-radius: 12px;
        object-fit: cover;
    }

    .cardss-container {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        min-width: 300px;
    }

    .cardz {
        padding: 20px;
        text-align: center;
        border-radius: 8px;
        font-weight: bold;
        font-size: 20px;
    }

    .blue {
        background-color: #1c568a;
        color: #fff;
    }

    .yellow {
        background-color: #4d7907;
        color: #ffffff;
    }

    .cardz span {
        display: block;
        font-size: 10px;
        font-weight: normal;
        margin-top: 8px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .image-container {
            width: 80%;
        }

        .cards-container {
            width: 100%;
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .image-container {
            width: 100%;
        }

        .cards-container {
            width: 100%;
            grid-template-columns: 1fr;
        }
    }
</style>

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

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">

            <div class="container-fluid">
                <div class="row">
                <div class="image-container">
                    <img src="image.webp" alt="User Image">
                </div>
                <div class="cardss-container">
                    <div class="cardz blue">
                        {{ $workers->filter(fn($worker) => $worker->attendances->isNotEmpty())->count() }}
                        <span>EMPLOYEES REPORTED TODAY</span>
                    </div>

                    <div class="cardz yellow">
                        {{ $absentWorkers->count() }}
                        <span>EMPLOYEES ABSENT TODAY</span>
                    </div>
                    <div class="cardz blue">
                        20
                        <span>QUOTATIONS CREATED TODAY</span>
                    </div>
                    <div class="cardz yellow">
                        5
                        <span>CLOSED DEALS</span>
                    </div>


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
<canvas id="salesBarChart" height="100"></canvas>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('salesBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Quotations', 'Approved Sales'],
                datasets: [{
                    label: 'Amount in ZMW',
                    data: [{{ $totalGrandTotal }}, {{ $salesGrandTotal }}],
                    backgroundColor: ['#17467a', '#28a745'],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Recent Meets Minutes Notes</h4>

                        <ol class="activity-feed mb-0">
                            @foreach ($programs->take(6) as $program)
                            <li class="feed-item">
                                <span class="date">
                                    {{ \Carbon\Carbon::parse($program->created_at)->format('F, Y') }} {{ $program->title }}
                                </span>
                                <span class="activity-text">{{ \Illuminate\Support\Str::words($program->description, 8, '...') }}</span>
                            </li>
                        @endforeach



                            <li class="feed-item pb-0">
                                <span class="activity-text">
                                    <a href="/programs" class="text-primary">More Activities</a>
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

                <!-- end row -->

                {{-- <div class="row">

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Monthly Earnings</h4>

                                <div class="row text-center mt-4">
                                    <div class="col-6">
                                        <h5 class="mb-2 font-size-18">56241</h5>
                                        <p class="text-muted text-truncate">Marketplace</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-2 font-size-18">23651</h5>
                                        <p class="text-muted text-truncate">Total Income</p>
                                    </div>
                                </div>

                                <div id="morris-donut-example" class="morris-charts morris-chart-height" data-colors='["#ebeff2", "--bs-primary", "--bs-info"]'></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Email Sent</h4>

                                <div class="row text-center mt-4">
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">56241</h5>
                                        <p class="text-muted text-truncate">Marketplace</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">23651</h5>
                                        <p class="text-muted text-truncate">Total Income</p>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-2 font-size-18">23651</h5>
                                        <p class="text-muted text-truncate">Total Month</p>
                                    </div>
                                </div>

                                <div id="morris-area-example" class="morris-charts morris-chart-height" data-colors='["rgb(200,200,200)", "--bs-primary", "--bs-info"]'></div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <!-- end row -->
            {{-- @include('includes.footer') --}}

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

<!--Morris Chart-->
<script src="/assets/libs/morris.js/morris.min.js"></script>
<script src="/assets/libs/raphael/raphael.min.js"></script>

<!--Morris Chart-->
<script src="/assets/libs/morris.js/morris.min.js"></script>
<script src="/assets/libs/raphael/raphael.min.js"></script>

<!-- Init js -->
<script src="assets/js/pages/morris.init.js"></script>

<script src="/assets/js/pages/dashboard.init.js"></script>

<script src="/assets/js/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Styles -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(Session::has('message'))

<script>
    swal("Welcome!, {{$user->company_name}}", "{{ Session::get('message') }}",'success',{
        button:true,
        button:"Close",
    });


</script>

@endif

</body>

</html>
