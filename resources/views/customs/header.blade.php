<header class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg" >
            <div class="site-logo me-3">
                <a class="navbar-brand" href="/">
                    @foreach ($generalSettings as $item)
                    <img
                    class="logo-main"
                    src="/settings/logo_white/{{ $item->file }}"
                    alt="Logo"
                    width="170px"
                    style="filter: brightness(0) invert(1);"
                />
                    @endforeach
                </a>
            </div><!--//site-logo-->


            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span> </span>
                <span> </span>
                <span> </span>
            </button>

            <div class="collapse navbar-collapse ms-auto" id="navigation">

                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item me-lg-4">
                        <a class="nav-link" href="/guide">Home</a>
                    </li>
                    <li class="nav-item dropdown me-lg-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu dropdown-menu-lg-end rounded shadow">
                            @foreach ($documentation as $item)
                            <li><a class="dropdown-item" href="{{ route('doc.public_show', $item->slug) }}">{{ $item->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item pt-3 pt-lg-0">
                        <a class="nav-btn btn btn-primary text-white" href="/register">Register</a>
                    </li>
                </ul><!--//navbar-nav-->

            </div>
        </nav>
    </div><!--//container-->

</header><!--//header-->
