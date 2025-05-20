<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <title>Contact - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="AuthX - Authentication Tailwind CSS 3 HTML Template is built for any Count Down Web Page,  agency or business Startup. It’s fully responsive and built Tailwind v3"
        name="description" />
    <meta content="Getappui" name="author" />

    <!-- favicon -->
    <link rel="shortcut icon" href="/login_style/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Tailwind css Cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="/login_style/tailwind.config.js"></script>
</head>

<body class="font-body">

    {{-- <div style="background-image: url(/login_style/images/login-bg-3.jpg);"> --}}
        <div class="bg-cover bg-center relative bg-no-repeat"  style="
        position: fixed;
        top: -2.5%;
        left: -2.5%;
        width: 105%;
        height: 105%;
        background:
            @php
                $latestBackground = $background->where('type', 'login_background')->sortByDesc('created_at')->first();
            @endphp
            @if ($latestBackground)
                url('{{ asset('background_images/' . $latestBackground->image) }}') no-repeat center center;
            @else
                /* radial-gradient(circle, rgb(17, 92, 122) 30%, rgba(10,37,83,1) 100%); */
                 url('{{ asset('assets/defult-01.webp' ) }}') no-repeat center center;
            @endif
        background-size: cover;
        filter: blur(0px);
        z-index: -2;">
    </div>


        <div class="h-screen w-screen flex justify-center items-center">

            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="bg-black/60 backdrop-blur-3xl overflow-hidden sm:rounded-md rounded-none mx-4">

                    <div class="p-6">

                        <p class="text-gray-200 text-center"><span style="font-size: 20px"><b>Contact Administrator</b></span></p>
                        <p class="text-gray-200 text-center">If the issue persists, please reach out to the administrator for assistance.
                            <a href="/dashboard" class="text-white-600 ms-1"><br><br>
                                @foreach ($displaySettings as $setting )
                                <span style="font-size: 12px">{{ $setting->email  }} | {{ $setting->phone  }} </span><br>
                                @endforeach
                                <b>
                                PC is Locked</b>
                            </a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
