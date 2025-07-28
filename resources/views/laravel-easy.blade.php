<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact Us</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="CoolAir — Air Conditioner & HVAC Repair Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
    ================================================== -->
    <link href="/web_nice/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="/web_nice/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/swiper.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/style.css" rel="stylesheet" type="text/css">
    <link href="/web_nice/css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="/web_nice/css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">



</head>

<body>
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        @include('web_includes.header')
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

            <section class="pt70 jarallax section-dark text-light" style="position: relative;">
                <!-- Image Slider -->
                <div class="swiper-container jarallax-img"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                    <div class="swiper-wrapper">
                        @foreach ($background as $item)
                            @if ($item->type == 'contact')
                                <div class="swiper-slide">
                                    <img src="/background_images/{{ $item->image }}" alt="Background 1"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <!-- Gradient Shade -->
                <div
                    style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        /* background: linear-gradient(38deg, rgb(29, 71, 149) 0%, rgb(4, 92, 101) 0%, rgba(207, 117, 6, 0.613) 52%, rgba(185,252,69,0.48365283613445376) 100%); */
                                                background: linear-gradient(248deg, rgba(190, 203, 8, 0) 0%, rgb(0, 0, 0) 70%);
                        z-index: 1;">
                </div>





                <!-- Content -->
                <div class="container relative z-index-1000" style="position: relative;">
                    <div class="spacer-double sm-hide"></div>
                    <div class="row g-4 gx-5 align-items-center">
                        @foreach ($heroes as $item)
                            @if ($item->status == 'contact')
                                <div class="col-lg-6 relative">
                                    <div class="relative z-index-1000">
                                        <h3
                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="wow fadeInUp" data-wow-delay=".4s"
                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; font-size:13px;">
                                            {{ $item->about }}
                                        </p>
                                        <a  style="background-color: #ff8c00; color: #000;" class="btn-main wow fadeInUp" data-wow-delay=".6s"
                                            href="{{ $item->button_link }}">{{ $item->button_name }}</a>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Swiper JS Initialization -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    new Swiper('.swiper-container', {
                        loop: true,
                        autoplay: {
                            delay: 20000,
                            disableOnInteraction: false,
                        },
                        effect: 'fade', // Adds a smooth fade effect
                        speed: 1000,
                    });
                });
            </script>





@php
  $faqs = [
    ['title'=>'❌ SSH login failed',
     'body'=>'DevNest couldn’t connect to your server as <code>azureuser</code>.<br>
      • Verify server IP/hostname.<br>
      • Check your PEM key and permissions (chmod 600).<br>
      • Test manually: <code>ssh -i key.pem azureuser@your-server-ip</code>.'],
    ['title'=>'“Please close the channel (1) before trying to open it again.”',
     'body'=>'Only one SSH channel at a time is allowed.<br>
      • Call <code>$ssh->disconnect()</code> before opening SFTP or a new SSH2 instance.'],
    ['title'=>'autoload.php missing',
     'body'=>'Your <code>vendor/autoload.php</code> isn’t there.<br>
      • Run <code>composer install</code> on the server.<br>
      • Ensure PHP & git are installed.'],
    ['title'=>'.env invalid or missing',
     'body'=>'• Confirm <code>.env</code> exists and is readable by <code>www-data</code>.<br>
      • No stray whitespace in your stub; wrap multi‑word values in quotes.'],
    ['title'=>'Access denied for user “laravel_user”',
     'body'=>'• Double‑check MySQL grants.<br>
      • Test: <code>mysql -u laravel_user -p</code> then <code>SHOW DATABASES;</code>.'],
    ['title'=>'404 after deployment',
     'body'=>'• Ensure vhost is enabled:<br>
       <code>sudo a2ensite your-app.conf && sudo systemctl reload apache2</code>.<br>
      • Confirm <code>ServerName</code> matches your domain.'],
    ['title'=>'SSL errors',
     'body'=>'• Install Certbot: <code>sudo apt install certbot python3-certbot-apache</code>.<br>
      • Verify DNS A/AAAA records point to your server.'],
  ];
@endphp

<section>
  <div class="container">
    {{-- About the App --}}
    <div class="row mb-5">
      <div class="col-lg-6">
        <h2>About Laravel‑Easy Deploy</h2>
        <p>
          <strong>Laravel‑Easy Deploy</strong> is your all‑in‑one Laravel app manager—
          push code, provision databases, configure SSL, and run commands, all in one place.
        </p>
        <ul>
          <li>🚀 GitHub → any server</li>
          <li>🔐 One‑click SSL</li>
          <li>🐘 Auto MySQL setup</li>
          <li>🔧 SSH commands</li>
          <li>📦 Composer, Redis, Queues</li>
          <li>🌐 Apache vhosts</li>
          <li>🛠️ Smart .env injection</li>
        </ul>
      </div>
      <div class="col-lg-6">
        {{-- Placeholder for image or diagram --}}
      </div>
    </div>

    {{-- FAQ Accordion --}}
    <div class="row g-4 gx-5">
      <div class="col-lg-6">
        @foreach($faqs as $i => $faq)
          <div class="accordion mb-3">
            <div class="accordion-header" onclick="toggleAccordion({{ $i }})">
              {{ $faq['title'] }}
            </div>
            <div class="accordion-body" id="body-{{ $i }}">
              <p>{!! $faq['body'] !!}</p>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-lg-6">
        {{-- Future content here --}}
      </div>
    </div>
  </div>
</section>

<script>
  function toggleAccordion(i) {
    const hdr = document.querySelectorAll('.accordion-header')[i];
    const body = document.getElementById(`body-${i}`);
    hdr.classList.toggle('active');
    body.style.maxHeight = hdr.classList.contains('active')
      ? body.scrollHeight + 'px'
      : null;
  }
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.accordion-body')
            .forEach(b => b.style.maxHeight = null);
  });
</script>

<style>
  .accordion { background:#fff; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
  .accordion-header { padding:1rem; cursor:pointer; position:relative; }
  .accordion-header::after { content:'+'; position:absolute; right:1rem; transition:transform .2s; }
  .accordion-header.active::after { transform:rotate(45deg); }
  .accordion-body { max-height:0; overflow:hidden; transition:max-height .3s ease; padding:0 1rem; }
  .accordion-body p { margin:1rem 0; }
</style>


        </div>

        <!-- content close -->

        <!-- footer begin -->
        @include('web_includes.footer')
    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="/web_nice/js/plugins.js"></script>
    <script src="/web_nice/js/designesia.js"></script>
    <script src="/web_nice/js/swiper.js"></script>
    <script src="/web_nice/js/custom-marquee.js"></script>
    <script src="/web_nice/js/custom-swiper-1.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- JavaScript for Cookie Pop-up -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cookieConsent = document.getElementById("cookieConsent");
            const acceptCookies = document.getElementById("acceptCookies");

            // Check if the user already accepted cookies
            if (!localStorage.getItem("cookiesAccepted")) {
                cookieConsent.style.display = "block";
            }

            // Handle the accept button
            acceptCookies.addEventListener("click", function() {
                localStorage.setItem("cookiesAccepted", "true");
                cookieConsent.style.display = "none";
            });
        });
    </script>
</body>

</html>
