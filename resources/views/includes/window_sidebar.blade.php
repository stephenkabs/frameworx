
<style>
    .vertical-menu {
        width: 200px;  /* Sidebar width */
        height: 700px; /* Set the height to 70px */
        border-radius: 10px;  /* Add rounded corners */
        overflow: hidden;  /* Hide overflow content */
        background-color: #fff; /* You can set the background color to your preference */
    }

    .vertical-menu .metismenu li a {
        padding: 10px;
        text-align: left;
    }

    .vertical-menu .metismenu li a i {
        font-size: 20px;
    }

    .vertical-menu .metismenu li a span {
        display: none;
    }

    .vertical-menu:hover .metismenu li a span {
        display: inline-block;
        position: absolute;
        left: 45px;
        white-space: nowrap;
    }

    /* Optional: Style the first and last items to have fully rounded top and bottom corners */
    .vertical-menu .metismenu li:first-child a {
        border-radius: 10px 10px 0 0;
    }

    .vertical-menu .metismenu li:last-child a {
        border-radius: 0 0 10px 10px;
    }

    .vertical-menu {
    background-color: #2f3547; /* Dark background for the sidebar */
}

#side-menu {
    padding: 0;
    list-style: none;
}

#side-menu li {
    position: relative;
    overflow: hidden; /* Prevent the background from overflowing */
}

.menu-item-1 {
    background-color: #113b66;
}
.menu-item-2 {
    background-color: #0a2c4f;
}
.menu-item-3 {
    background-color: #113b66;
}
.menu-item-4 {
    background-color: #0a2c4f;
}
.menu-item-5 {
    background-color: #113b66;
}

#side-menu li a {
    display: block;
    padding: 10px 15px;
    color: white;
    text-decoration: none;
    transition: background 0.3s ease; /* Smooth transition */
}

#side-menu li a:hover {
    background: rgba(255, 255, 255, 0.1); /* Change background on hover */
}

.sticky-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #04203f;
    padding: 10px;
    position: sticky;
    top: 0;
    z-index: 999;
}

.nav-content {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: space-between;
}

.search-bar {
    display: flex;
    align-items: center;
}

.search-input {
    padding: 5px;
    border: none;
    border-radius: 20px;
    width: 200px;
    outline: none;
    margin-right: 5px;
}

.search-btn {
    background-color: #051a2e;
    border: none;
    padding: 5px 10px;
    border-radius: 50%;
    cursor: pointer;
    color: rgb(210, 232, 247);
}

.search-btn i {
    font-size: 16px;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-name {
    color: white;
    font-weight: bold;
}

.nav-controls button {
    background-color: #09335d;
    color: white;
    border: none;
    padding: 5px 10px;
    margin-left: 10px;
    cursor: pointer;
    font-size: 16px;
}

.nav-controls button:hover {
    background-color: #575b6d;
}



    </style>
        <div class="sticky-nav">
            <div class="nav-content">
                <!-- Search Bar on the Left -->
                <div class="search-bar">
                    <a class="btn btn-info waves-effect waves-light" href="/business"><i class="dripicons-arrow-thin-left"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/business"><img src="/assets/images/logo-light.png" alt="" height="20"></a>
                </div>

                <!-- User Avatar and Name on the Right -->
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name={{urlencode(auth()->user()->name)}}&color=7F9CF5&background=EBF4FF" alt="User Avatar" class="user-avatar">
                    <span class="user-name">{{ auth()->user()->name}}'s PC</span>
                </div>

                <!-- Control Buttons (Minimize, Maximize, Close) -->
                <div class="nav-controls">
                    <button id="minimize" title="Minimize">-</button>
                    <button id="maximize" title="Maximize">☐</button>
                    <button id="close" title="Close">✖</button>
                </div>
            </div>
        </div>

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-styled" id="side-menu">
                <li class="menu-title"><b>Plus Online PC</b></li>
                <li class="menu-item-1">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-th"></i><strong style="font-size: 12px">Desktop</strong>
                    </a>
                </li>
                <li class="menu-item-4">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-tty"></i><strong style="font-size: 12px">My Cloud</strong>
                    </a>
                </li>
                <li class="menu-item-3">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-user-cog"></i><strong style="font-size: 12px">Contacts</strong>
                    </a>
                </li>
                <li class="menu-item-2">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-book"></i><strong style="font-size: 12px">Documents</strong>
                    </a>
                </li>
                <li class="menu-item-3">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-user-cog"></i><strong style="font-size: 12px">Applications</strong>
                    </a>
                </li>
                <li class="menu-item-4">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-tty"></i><strong style="font-size: 12px">My Cloud</strong>
                    </a>
                </li>
                <li class="menu-item-3">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-user-cog"></i><strong style="font-size: 12px">Contacts</strong>
                    </a>
                </li>
                <li class="menu-item-4">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-tty"></i><strong style="font-size: 12px">Learning Center</strong>
                    </a>
                </li>
                <li class="menu-item-3">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-user-cog"></i><strong style="font-size: 12px">News</strong>
                    </a>
                </li>
                <li class="menu-item-4">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-tty"></i><strong style="font-size: 12px">Support Center</strong>
                    </a>
                </li>
                <li class="menu-item-5">
                    <a href="/dashboard" class="waves-effect">
                        <i class="fas fa-power-off"></i><strong style="font-size: 12px">Sign Out</strong>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
