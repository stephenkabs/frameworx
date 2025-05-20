
<header style="background-color: rgb(6, 39, 73)" id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->


            <button style="color: rgb(214, 230, 252)" type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="d-none d-sm-block ms-2">
                {{-- <h4 class="page-title font-size-18">{{ $user->company_name }} Dashboard</h4> --}}
            </div>

        </div>

        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input form-control" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-bs-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item toggle-search noti-icon waves-effect"
                    data-bs-target="#search-wrap">
                    <i class="mdi mdi-magnify"></i>
                </button>
            </div>

            <div class="dropdown d-none d-md-block ms-2">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="modal" data-bs-target="#lockScreenModal"
                    aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="me-2" src="/assets/images/flags/us_flag.jpg" alt="Header Language" height="16"> English --}}
                    {{-- <span class="mdi mdi-chevron-down"></span> --}}
                </button>

                <a href="/lock-screen" target="blank" type="button" class="btn btn-info btn-sm">
                   Lock Screen
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="/assets/images/flags/germany_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle"> German </span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="/assets/images/flags/italy_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle"> Italian </span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="/assets/images/flags/french_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle"> French </span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="/assets/images/flags/spain_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle"> Spanish </span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="/assets/images/flags/russia_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle"> Russian </span>
                    </a>
                </div> --}}
            </div>

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ion ion-md-notifications"></i>
                    {{-- <span class="badge bg-danger rounded-pill">{{ number_format($document->count() ) }}</span> --}}
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                {{-- <h5 class="m-0 font-size-16"> Notification ({{ number_format($document->count() ) }}) </h5> --}}
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </span>
                                </div>
                                {{-- @if ($document->count() != 0) --}}


                                <div class="flex-1">
                                    {{-- <h6 class="mt-0 font-size-15 mb-1">({{ number_format($document->count() ) }})New Mail received</h6> --}}
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">New mail has been created Successfully</p>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </a>



                        <a href="" class="text-reset notification-item">
                            <div class="media d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-warning rounded-circle font-size-16">
                                        <i class="fas fa-smile"></i>
                                    </span>
                                </div>
                                {{-- @if ($users->count() != 0) --}}


                                <div class="flex-1">
                                    {{-- <h6 class="mt-0 font-size-15 mb-1">({{ number_format($users->count() ) }})New User Registered</h6> --}}
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">New User has been created Successfully</p>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </a>

                    </div>
                    <div class="p-2 border-top text-center">
                        <a class="btn btn-sm btn-link font-size-14 w-100" href="javascript:void(0)">
                            View all
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name={{urlencode(auth()->user()->name)}}&color=7F9CF5&background=EBF4FF’"
                        alt="Header Avatar">

                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="dripicons-user font-size-16 align-middle me-2"></i>
                        Profile</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">5</span><i
                            class="dripicons-gear font-size-16 align-middle me-2"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="dripicons-lock font-size-16 align-middle me-2"></i> Lock
                        screen</a>
                    <div class="dropdown-divider"></div>

                    {{-- <form  method="POST" class="dropdown-item" action="{{ route('dashboard.logout') }}"><i class="dripicons-exit font-size-16 align-middle me-2"></i>
                        @csrf
                        <a type="submit">
                         Logout</a>
                    </form> --}}

                    <form action="{{ route('dashboard.logout') }}" method="POST">
                        @csrf
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-light  waves-effect" type="submit"><i class="dripicons-exit font-size-16 align-middle me-2"></i> Logout</button>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-spin mdi-cog"></i>
                </button>
            </div>

        </div>
    </div>
</header>
