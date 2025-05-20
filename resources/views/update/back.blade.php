<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>{{ $update->title }}</title>
		<!-- Favicon -->
		<link href="/site_assets/images/favicon.png" rel="shortcut icon">
		<!-- CSS -->
		<link href="/site_assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="/site_assets/plugins/glightbox/glightbox.min.css" rel="stylesheet">
		<link href="/site_assets/plugins/scrollcue/scrollcue.css" rel="stylesheet">
		<link href="/site_assets/plugins/swiper/swiper-bundle.min.css" rel="stylesheet">
		<link href="/site_assets/css/theme.css" rel="stylesheet">
		<!-- Fonts/Icons -->
		<link href="/site_assets/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="/site_assets/plugins/fontawesome/css/all.css" rel="stylesheet">
		<link href="/site_assets/plugins/themify/themify-icons.css" rel="stylesheet">
	</head>
	<body data-preloader="light">

@include('web_includes.menu')
		<!-- end Header -->

		<main>

			<!-- Post Title -->
			<div class="px-3 px-md-4 px-xxl-5">
				<div class="bg-image parallax" data-bg-src="/site_assets/images/cover.jpg">
					<div class="section-spacing-lg bg-black-40">
						<div class="container">
							<div class="row">
								<div class="col-12 col-lg-10 offset-lg-1 col-xl-9 col-xxl-8">
									<ul class="list-inline-dash mb-2">
										<li>{{ $update->target_type }}</li>
										<li>Posted on  {{ \Carbon\Carbon::parse($update->created_at)->format('F j, Y') }}</li>
									</ul>
									<h1 class="display-4 fw-medium">{{ $update->title }}</h1>
									<div class="sm-heading mt-3">Posted by <a href="#">admin</a></div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div>
			</div>
			<!-- end Post Title -->

			<!-- Post -->
			<div class="section-spacing-sm">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-10 offset-lg-1">
							<!-- Heading -->
							<h2 class="fw-medium">About {{ $update->title }} Event</h2>

							<!-- Paragraph -->
							<p>{{ $update->about_event }}</p>

							<!-- Lightbox Images -->
							<div class="row g-3 mt-3">
								<div class="col-12 col-md-6">
									<div class="img-link-box">
										<a class="glightbox" href="/site_assets/images/515x321.png">
											<img src="/updates/{{ $update->image }}" alt="">
										</a>
									</div>

								</div>

                                <div class="col-12 col-md-6">
									<div class="img-link-box">
                                        <form class="form-border-radius" action="{{ route('sign.store') }}" method="POST">
                                            @csrf <!-- Include CSRF protection for security -->
                                            <div class="row gx-3 gy-0">
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="name" name="name" placeholder="Name" required>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="email" id="email" name="email" placeholder="E-Mail" required>
                                                </div>
                                            </div>

                                            <div class="row gx-3 gy-0">
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="number" name="number" placeholder="Phone Number" required>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="address" name="address" placeholder="Address" required>
                                                </div>
                                            </div>

                                            <div class="row gx-3 gy-0">
                                                <div class="col-12 col-md-6">
                                                    <select id="type" name="type" required>
                                                        <option value="">Select Type</option>
                                                        <option value="General">General</option>
                                                        <option value="Specific">Specific</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="date" id="date" name="date" required>
                                                </div>
                                            </div>

                                            <input type="hidden" id="update_id" name="update_id" value="{{ $update->id }}">
                                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user() ? Auth::user()->id : '' }}"> <!-- Capture user ID if logged in -->
                                            <input type="hidden" id="slug" name="slug" value="{{ Str::slug($update->name) }}"> <!-- Automatically generate slug -->

                                            <button class="button button-lg button-rounded button-gradient-1 button-hover-slide" type="submit">
                                                <span data-text="Submit Registration Form">Submit Registration Form</span>
                                            </button>
                                        </form>

									</div>

								</div>
							</div>

							<!-- Blockquote -->
							<figure class="bg-pattern-diagonal p-4 p-lg-5 mt-4 mt-lg-5">
								<blockquote class="blockquote font-family-tertiary fst-italic fs-4">
									<p>Our Target: {{ $update->target ?? 'None' }}</p>
								</blockquote>
								<figcaption class="blockquote-footer sm-heading mt-0 mb-0 text-dark-40">
									Total Number Registered for {{ $update->title }} Event:  {{ $signs->count() }}
								</figcaption>
							</figure>


						</div>
					</div><!-- end row -->
				</div><!-- end container -->
			</div>
			<!-- end Post -->

			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-10 offset-lg-1">
						<hr class="hr-diagonal">
					</div>
				</div>
			</div>

			<!-- Tags, Share -->
			<div class="section-spacing-xs">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-10 offset-lg-1">
							<div class="row">
								<div class="col-12 col-md-6 text-md-end">
									<ul class="list-inline">
										<li>
											Share on:
										</li>
										<li>
											<a href="#"><i class="bi bi-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="bi bi-twitter-x"></i></a>
										</li>
										<li>
											<a href="#"><i class="bi bi-linkedin"></i></a>
										</li>
									</ul>
								</div>
							</div><!-- end row(inner) -->
						</div>
					</div><!-- end row -->
				</div><!-- end container -->
			</div>
			<!-- end Tags, Share -->



			<!-- Footer -->
@include('web_includes.footer')
			<!-- end Footer -->

		</main>

		<!-- Cursors -->
		<div class="cursors">
			<div class="cursor-inner"></div>
		</div>

		<!-- JavaScripts -->
		<script src="/site_assets/plugins/jquery.min.js"></script>
		<script src="/site_assets/plugins/plugins.js"></script>
		<script src="/site_assets/js/functions.js"></script>
	</body>
</html>
