<!-- ========== Left Sidebar Start ========== -->

<style>    .vertical-menu {
    width: 240px;  /* Sidebar width */
    height: 1800px; /* Set the height to 70px */

    overflow: hidden;  /* Hide overflow content */
    background-color: #fff; /* You can set the background color to your preference */
}</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div  id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"><hr></li>
                <li>
                    <a href="/" class="waves-effect" target="blank">
                        <i class="dripicons-web"></i>
                        <span style="font-size: 14px"><b>Website</b></span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span style="font-size: 14px"><b>Home</b></span>
                    </a>
                </li>
                <li>
                    <a href="/event" class="waves-effect">
                        <i class="dripicons-calendar"></i>
                        <span style="font-size: 14px"><b>Events</b></span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-hospital"></i>
                        <span style="font-size: 14px"> <b>Tickets Purchases</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @role('admin')
                        <li><a href="/purchase">Tickets Purchase</a></li>
                        @endrole
                        @role('user')
                        <li><a href="/my_tickets">My Tickets</a></li>
                        @endrole
                    </ul>
                </li>
@role('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-gear"></i>
                        <span style="font-size: 14px"> <b>System Settings</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/role">Roles</a></li>
                        <li><a href="/permission">Permissions</a></li>
                        <li><a href="/user">Users</a></li>
                    </ul>
                </li>
@endrole
                {{-- <li>
                    <a href="{{ route('dashboard.logout') }}" class="waves-effect">
                        <i class="dripicons-power"></i>
                        <span style="font-size: 14px"><b>Log Out</b></span>
                    </a>
                </li> --}}

<br>

                <li style="background-color: rgb(66, 103, 153); border-radius: 40px;">
                    <a href="" class="waves-effect">
                        {{-- <i class="dripicons-lock"></i> --}}
                        <span style="font-size: 13px">
                            @if(auth()->user()->image) <!-- Check if image is uploaded -->
                                <img class="rounded-circle header-profile-user" src="{{ asset('users/images/' . auth()->user()->image) }}" alt="Header Avatar">
                            @else
                                <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" alt="Header Avatar">
                            @endif
                            &nbsp;&nbsp;&nbsp;<b>{{ auth()->user()->name }}</b>
                            <span style="display:inline-block; width: 8px; height: 8px; background-color: rgb(14, 196, 14); border-radius: 50%; margin-left: 5px;"></span>
                        </span>

                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
