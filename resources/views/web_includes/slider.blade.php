<section class="pt70 jarallax section-dark text-light" style="position: relative;">
    <!-- Image Slider -->
    <div class="swiper-container jarallax-img" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
        <div class="swiper-wrapper">
            @foreach ($background as $item)
            @if ($item->type == 'hero')
            <div class="swiper-slide">
                <img src="/background_images/{{ $item->image }}" alt="Background 1" style="width: 100%; height: 100%; object-fit: cover;">
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
            background: linear-gradient(248deg, rgba(217,86,155,0) 0%, rgb(4, 45, 98) 70%);
            z-index: 1;">
    </div>

    <!-- Content -->
    <div class="container relative z-index-1000" style="position: relative;">
        <div class="spacer-double sm-hide"></div>
        <div class="row g-4 gx-5 align-items-center">
            @foreach ($heroes as $item)
            @if ($item->status == 'Published')
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
                    <a class="btn-main wow fadeInUp" data-wow-delay=".6s" href="{{ $item->button_link }}">{{ $item->button_name }}</a>

                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Swiper JS Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
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


<br><br>
