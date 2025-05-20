<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div  id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Church Management</li>

                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span style="font-size: 14px"><b>Home</b></span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-home"></i>
                        <span style="font-size: 14px"> <b>Our Church</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/attendances/create">Attend Church</a></li>
                        <li><a href="/member">People</a></li>
                        <li><a href="/ministries">Ministries</a></li>
                        <li><a href="/departments">Departments</a></li>
                        <li><a href="/branches">Branches</a></li>
                        <li><a href="/cells">Groups</a></li>
                        <li><a href="/leaders">Leaders</a></li>
                        <li><a href="/birthday">Today's Birthday</a></li>
                        <li><a href="/sign">Event Registration</a></li>
                        <li><a href="/project">Church Projects</a></li>
                        <li><a href="/tithes">Tithes</a></li>
                        <li><a href="/donations/index">Donations</a></li>
                        <li><a href="/program">Church Programs</a></li>
                        <li><a href="/testimony">Testimonials </a></li>
                        <li><a href="/word">Word of the Day </a></li>


                    </ul>
                </li> --}}

                <li>
                    <a href="/studio" class="waves-effect">
                        <i class="dripicons-feed"></i>
                        <span style="font-size: 14px"><b>Media</b></span>
                    </a>
                </li>
{{--
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-web"></i>
                        <span style="font-size: 14px"> <b>Web</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/setting">Web Settings</a></li>
                        <li><a href="/heros">Header</a></li>
                        <li><a href="/abouts">About</a></li>
                        <li><a href="/contact">Contacts</a></li>
                        <li><a href="vdh">Even</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-document"></i>
                        <span style="font-size: 14px">  <b>My Quicks</b> </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                     <li><a href="/reminder/create">Add Reminder</a></li>
                     <li><a href="/reminder">Reminders</a></li>
                        <li><a href="/note">Note Pad</a></li>

                    </ul>
                </li><br>

                <li style="background-color: rgb(66, 103, 153); border-radius: 40px;">
                    <a href="{{ route('lock-screen') }}" class="waves-effect">
                        {{-- <i class="dripicons-lock"></i> --}}
                        <span style="font-size: 13px">
                            <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name={{urlencode(auth()->user()->name)}}&color=7F9CF5&background=EBF4FF"
                            alt="Header Avatar"> &nbsp;&nbsp;&nbsp;<b>{{ auth()->user()->name}}</b>
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
