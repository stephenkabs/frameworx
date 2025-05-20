<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
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
                            <img class="h-12" src="/login_style/images/logo.png" alt="">
                        </a>

                        <form method="POST" action="{{ route('password.email') }}" class="mt-10">
                            @csrf
                            <div class="mb-4">
                                <label for="emailaddress" class="block text-base/normal font-semibold text-gray-200 mb-2">Email address</label>
                                <input class="block w-full rounded py-1.5 px-3 bg-transparent border-white/10 text-white/80 focus:border-white/25 focus:outline-0 focus:ring-0" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                            <!-- end checkbox input -->
                            <div class="mb-6 text-center">
                                <button class="w-full inline-flex items-center justify-center px-6 py-2 backdrop-blur-2xl bg-white/20 text-white rounded-lg transition-all duration-500 group hover:bg-blue-600/60 hover:text-white mt-5" type="submit">Email Password Reset Link</button>
                            </div>
                        </form>


    <!--                     <div class="flex items-center my-6">
                            <div class="flex-auto mt-px border-t border-dashed border-gray-200"></div>
                            <div class="mx-4 text-gray-100">Or</div>
                            <div class="flex-auto mt-px border-t border-dashed border-gray-200"></div>
                        </div> -->

                        <!-- social-->
      <!--                   <div class="text-center mb-6">
                            <p class="text-white text-xl mb-6">Sign in with</p>
                            <div class="flex flex-wrap items-center justify-center gap-2">
                                <a href="#" class="w-full inline-flex items-center justify-center px-6 py-2 backdrop-blur-2xl bg-white/20 text-white rounded-lg transition-all duration-500 group hover:bg-red-600/60 hover:text-white">
                                    <svg class="me-3 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                                    </svg>
                                    Login with Google
                                </a>
                                <a href="#" class="w-full inline-flex items-center justify-center px-6 py-2 backdrop-blur-2xl bg-white/20 text-white rounded-lg transition-all duration-500 group hover:bg-gray-600/60 hover:text-white">
                                    <svg class="me-3 w-6" viewBox="0 0 32 32">
                                        <path fill-rule="evenodd" d="M16 4C9.371 4 4 9.371 4 16c0 5.3 3.438 9.8 8.207 11.387.602.11.82-.258.82-.578 0-.286-.011-1.04-.015-2.04-3.34.723-4.043-1.609-4.043-1.609-.547-1.387-1.332-1.758-1.332-1.758-1.09-.742.082-.726.082-.726 1.203.086 1.836 1.234 1.836 1.234 1.07 1.836 2.808 1.305 3.492 1 .11-.777.422-1.305.762-1.605-2.664-.301-5.465-1.332-5.465-5.93 0-1.313.469-2.383 1.234-3.223-.121-.3-.535-1.523.117-3.175 0 0 1.008-.32 3.301 1.23A11.487 11.487 0 0116 9.805c1.02.004 2.047.136 3.004.402 2.293-1.55 3.297-1.23 3.297-1.23.656 1.652.246 2.875.12 3.175.77.84 1.231 1.91 1.231 3.223 0 4.61-2.804 5.621-5.476 5.922.43.367.812 1.101.812 2.219 0 1.605-.011 2.898-.011 3.293 0 .32.214.695.824.578C24.566 25.797 28 21.3 28 16c0-6.629-5.371-12-12-12z"></path>
                                    </svg>
                                    Login with Github
                                </a>
                            </div>
                        </div> -->

                        <p  style="font-size: 9px" class="text-gray-200 text-center">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
