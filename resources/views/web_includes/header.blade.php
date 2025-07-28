        <!-- header begin -->
        <header class="transparent scroll-light has-topbar">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <!-- logo begin -->
                                <div id="logo">
                                    <a href="index.html">
                                        @foreach ($generalSettings as $item)
                                        <img class="logo-main" src="/settings/logo_white/{{ $item->file }}" alt=""
                                            width="170px">
                                            @endforeach

                                        @foreach ($generalSettings as $item)

                                        <img class="logo-scroll" src="settings/logo_dark/{{ $item->image }}"
                                            alt="" width="170px">
                                            @endforeach
                                            @foreach ($generalSettings as $item)
                                        <img class="logo-mobile" src="settings/logo_dark/{{ $item->image }}" alt=""
                                            width="170px">
                                            @endforeach

                                    </a>
                                </div>
                                <!-- logo close -->
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu" style="list-style: none; padding: 0; margin: 0;">
                                    <li><a class="menu-item" href="/">Home</a></li>

                                    @php
                                        // Filter menu items by type
                                        $companyItems = $menu->filter(fn($item) => $item->type === 'sub_menu');
                                    @endphp
                                    @if ($companyItems->isNotEmpty())
                                        <li><a class="menu-item"
                                                href="#">Products</a>
                                            <ul>

                                                @foreach ($companyItems as $item)
                                                    <li><a class="menu-item" href="{{ $item->link }}">{{ $item->sub_name }}</a>
                                                    </li>
                                                    @endforeach
                                            </ul>
                                        </li>
                                    @endif

                                    @foreach ($menu as $item)
                                        @if ($item->type === 'main_menu')
                                            <li><a class="menu-item"
                                                    href="{{ $item->link }}">{{ $item->menu_name }}</a></li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a style="background-color: #ff8c00; color: #000;" href="{{ route('login') }}" class="btn-main">Login</a>
                                    <span id="menu-btn"></span>
                                </div>
                            </div>

                            <style>
                                .menu-item {
                                    font-size: 14px;
                                    /* Adjust font size here */
                                    text-decoration: none;
                                    color: inherit;
                                    font-family: Arial, sans-serif;
                                }

                                .menu-item:hover {
                                    color: #0a9be3;
                                    /* Primary color for hover effect */
                                }
                            </style>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->
