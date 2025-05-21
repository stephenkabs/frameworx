<footer
            style="
background: linear-gradient(248deg, rgb(131, 64, 6) 0%, rgb(224, 104, 12) 82%);">
            <div class="container">
                <div class="row gx-5">
                    <!--                     <div class="col-lg-4 col-sm-6">
                       <img class="logo-scroll" src="images/logo.webp" alt="" width="150px" >
                        <div class="spacer-20"></div>
                        <p style="font-size:11px">Innovative Tools: We use the latest HR technologies and methodologies to provide cutting-edge solutions.</p>

                        <div class="social-icons mb-sm-30">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-discord"></i></a>
                            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div> -->
                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row">

                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    @php
                                        // Filter menu items for 'company' type
                                        $company_pages = $custom_page->filter(fn($item) => $item->type === 'company');
                                    @endphp

                                    @if ($company_pages->isNotEmpty())
                                        <h5>{{ ucfirst($company_pages->first()->type) }}</h5>
                                        <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                            @foreach ($company_pages as $item)
                                                <li style="margin-bottom: 5px;">
                                                    <a href="{{ route('customs.public_show', $item->slug) }}">{{ $item->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    @php
                                        // Filter menu items for 'product' type
                                        $product_pages = $custom_page->filter(fn($item) => $item->type === 'product');
                                    @endphp

                                    @if ($product_pages->isNotEmpty())
                                        <h5>{{ ucfirst($product_pages->first()->type) }}</h5>
                                        <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                            @foreach ($product_pages as $item)
                                                <li style="margin-bottom: 5px;">
                                                    <a href="{{ route('customs.public_show', $item->slug) }}">{{ $item->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row">

                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    @php
                                        // Filter menu items for 'product' type
                                        $solution_pages = $custom_page->filter(fn($item) => $item->type === 'solution');
                                    @endphp

                                    @if ($solution_pages->isNotEmpty())
                                        <h5>{{ ucfirst($solution_pages->first()->type) }}</h5>
                                        <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                            @foreach ($solution_pages as $item)
                                                <li style="margin-bottom: 5px;">
                                                    <a href="{{ route('customs.public_show', $item->slug) }}">{{ $item->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                            <div class="widget">
                                @php
                                    // Filter menu items for 'product' type
                                    $resource_pages = $custom_page->filter(fn($item) => $item->type === 'resources');
                                @endphp

                                @if ($resource_pages->isNotEmpty())
                                    <h5>{{ ucfirst($resource_pages->first()->type) }}</h5>
                                    <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                        @foreach ($resource_pages as $item)
                                            <li style="margin-bottom: 5px;">
                                                <a href="{{ route('customs.public_show', $item->slug) }}">{{ $item->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>


                        </div>


                    </div>

                    <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                        <div class="row">

                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    @php
                                        // Filter menu items for 'product' type
                                        $contact_pages = $custom_page->filter(fn($item) => $item->type === 'contact');
                                    @endphp

                                    @if ($contact_pages->isNotEmpty())
                                        <h5>{{ ucfirst($contact_pages->first()->type) }}</h5>
                                        <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                            @foreach ($contact_pages as $item)
                                                <li style="margin-bottom: 5px;">
                                                    <a href="{{ route('customs.public_show', $item->slug) }}">{{ $item->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    @php
                                        // Filter menu items by type
                                        $companyItems = $menus->filter(fn($item) => $item->type === 'apps');
                                    @endphp

                                    @if ($companyItems->isNotEmpty())
                                        <h5>{{ ucfirst($companyItems->first()->type) }}</h5>
                                        <ul style="font-size: 11px; line-height: 1.2; margin: 0; padding: 0; list-style: none;">
                                            @foreach ($companyItems as $item)
                                                <li style="margin-bottom: 5px;">
                                                    <a href="{{ $item->link }}">{{ $item->menu_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>


                        </div>


                    </div>



                </div>
            </div>
            @foreach ($displaySettings as $setting )
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <style>
                                        .logo-main {
                                            filter: brightness(0) invert(1);
                                        }
                                        </style>
                                    <img class="logo-main" src="/settings/logo_white/{{ $setting->file }}" alt="Logo" width="80px" style="display: inline-block; margin-right: 10px;">
                                    {{-- <p style="font-size: 10px; display: inline-block;">&copy;<script>document.write(new Date().getFullYear())</script> {{ $setting->copyright }}</p> --}}
                                </div>


                                <ul style="font-size: 10px" class="menu-simple">
                                    {{-- <li><a class="link-hover-line" href="#">Powered: {{ $setting->author }} </a></li> --}}
                                    <li><a style="font-size: 10px; display: inline-block;">&copy;<script>document.write(new Date().getFullYear())</script> {{ $setting->copyright }}</a></li>
									<li><a class="link-hover-line" href="#">Version: {{ $setting->version }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @endforeach
        <!-- footer close -->
