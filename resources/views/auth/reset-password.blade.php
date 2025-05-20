<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
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

    <div class="bg-cover bg-center relative bg-no-repeat" style="background-image: url(/login_style/images/login-bg-3.jpg);">
        <div class="h-screen w-screen flex justify-center items-center">

            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="bg-black/60 backdrop-blur-3xl overflow-hidden sm:rounded-md rounded-none mx-4">
                    <div class="p-6">
                        <a href="index.html" class="block mb-8">
                            <img class="h-8" src="/login_style/images/logo.png" alt="">
                        </a>

<form method="POST" action="{{ route('password.store') }}" class="mt-10">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-base/normal font-semibold text-gray-200 mb-2">Your Name</label>
        <input name="name" type="text" id="name" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 border-gray-200 text-white/80 focus:border-white/25 focus:ring-transparent" placeholder="Your Name">
    </div>
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="mb-4">
        <label for="emailaddress" class="block text-base/normal font-semibold text-gray-200 mb-2">Email address</label>
        <input name="email" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 text-white/80 focus:border-white/25 focus:outline-0 focus:ring-0" type="email" id="emailaddress" required="" placeholder="Enter your email">
    </div>

    {{-- <div class="mb-4">
        <label for="name" class="block text-base/normal font-semibold text-gray-200 mb-2">Mobile</label>
        <input name="mobile" type="text" id="name" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 border-gray-200 text-white/80 focus:border-white/25 focus:ring-transparent" placeholder="Mobile">
    </div> --}}

    {{-- <div class="mb-4">
        <label for="name" class="block text-base/normal font-semibold text-gray-200 mb-2">City</label>
        <input name="city" type="text" id="name" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 border-gray-200 text-white/80 focus:border-white/25 focus:ring-transparent" placeholder="City">
    </div> --}}

    <!-- Dropdown Menu -->
    {{-- <div class="mb-4">
        <label for="role" class="block text-base/normal font-semibold text-gray-200 mb-2">Countries</label>
        <select name="country_id" id="role" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 text-white/80 focus:border-white/25 focus:ring-transparent">
            <option value="" disabled selected>Select Country</option>
            @foreach ($countries as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
        </select>
    </div> --}}
    <!-- End Dropdown Menu -->

    <div class="mb-4">
        <label for="password" class="block text-base/normal font-semibold text-gray-200 mb-2">Password</label>
        <input    name="password" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 text-white/80 focus:border-white/25 focus:outline-0 focus:ring-0" type="password" required="" id="password" placeholder="Enter your password">
    </div>

        <div class="mb-4">
        <label for="password" class="block text-base/normal font-semibold text-gray-200 mb-2">Confirm Password</label>
        <input  name="password_confirmation" class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 text-white/80 focus:border-white/25 focus:outline-0 focus:ring-0" type="password" required="" id="password" placeholder="Confirm password">
    </div>

    {{-- <div class="inline-flex items-center mb-6">
        <input type="checkbox" class="h-4 w-4 rounded border-white/20 bg-white/20 text-blue-600 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-600/60 focus:ring-offset-0" id="checkbox-signin">
        <label class="text-base ms-2 text-gray-200 align-middle select-none" for="checkbox-signin">Remember me</label>
    </div> --}}

    <div class="mb-6 text-center">
        <button class="w-full inline-flex items-center justify-center px-6 py-2 backdrop-blur-2xl bg-white/20 text-white rounded-lg transition-all duration-500 group hover:bg-blue-600/60 hover:text-white mt-5" type="submit">Reset Password</button>
    </div>
</form>
 </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
