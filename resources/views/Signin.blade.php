<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Sign In | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="description" content="Register yourself now on our website and enjoy unlimited services." />
	<meta name="keywords" content="waifuwall, waifu wallpaper, anime girl wallpaper, 4k wallpaper, hd wallpaper, wallpaper smartphone, wallpaper pc, anime wallpaper, game wallpaper, anime waifu wallpaper, ai wallpaper" />
	<meta name="author" content="Serarinne" />
	<meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">
	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Sign In | WaifuWall" />
	<meta property="og:description" content="Register yourself now on our website and enjoy unlimited services." />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Sign In | WaifuWall" />
	<meta name="twitter:description" content="Register yourself now on our website and enjoy unlimited services." />

	@include("Component/Assets")

  	<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="flex flex-col justify-center items-center font-[sans-serif] bg-gradient-to-r lg:h-screen p-6">
            <div class="grid md:grid-cols-2 items-center gap-y-8 bg-white max-w-7xl w-full shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md overflow-hidden">
                <div class="order-1 flex flex-col justify-center sm:p-8 p-4 bg-gradient-to-r bg-gray-800 w-full h-full">
                <div class="max-w-md space-y-12 mx-auto">
                    <div>
                    <h4 class="text-white text-lg font-semibold">Login to your account</h4>
                    <p class="text-[13px] text-gray-200 mt-2">Get unlimited features that anonymous users don't have.</p>
                    </div>
                    <div>
                    <h4 class="text-white text-lg font-semibold">Save your favorite images</h4>
                    <p class="text-[13px] text-gray-200 mt-2">By logging in with your account, you can now save your favorite images without having to worry about searching for them again.</p>
                    </div>
                    <div>
                    <h4 class="text-white text-lg font-semibold">Access to restricted images</h4>
                    <p class="text-[13px] text-gray-200 mt-2">We have images that are not displayed to anonymous users, if you log in with an account, of course you can access them.</p>
                    </div>
                </div>
                </div>

                <form action="{{ url()->current() }}" method="POST" class="sm:p-8 p-4 w-full">
                @csrf
                <div class="md:mb-12 mb-8">
                    <h3 class="text-gray-800 text-3xl font-bold">Sign In</h3>
                    @if(session()->has('msg'))
                    <div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                            <strong class="font-bold text-sm mr-4">{{ session()->get('msg') }}</strong>
                        </div>
                    </div>
                    @endif
                  	@if(session()->has('cf-msg'))
                  	<div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                  			<strong class="font-bold text-sm mr-4">{{ session()->get('cf-msg') }}</strong>
                    	</div>
                    </div>
                  	@endif
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    <div class="col-span-2">
                    <label class="text-gray-800 text-sm mb-2 block">Username</label>
                    <input name="username" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-2.5 rounded-md border focus:bg-transparent focus:border-black outline-none transition-all" placeholder="Enter username" minlength="3" maxlength="12" value="{{ session()->get('username') }}" pattern="([A-z0-9]){3,12}" required/>
                    </div>
                    <div class="col-span-2">
                    <label class="text-gray-800 text-sm mb-2 block">Password</label>
                    <input name="password" type="password" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-2.5 rounded-md border focus:bg-transparent focus:border-black outline-none transition-all" placeholder="Enter password" value="" minlength="8" maxlength="16" required/>
                    </div>
                </div>
                  
                <div class="flex items-center mt-6">
                  	<x-turnstile-widget
                    	theme="dark"
                    	language="en-US"
                    	size="normal"
                    	callback="callbackFunction"
                    	errorCallback="errorCallbackFunction"
                    />
                </div>

                <div class="flex items-center mt-6 items-center justify-end">
                    <label class="block text-sm">
                        <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/forgot-password')) }}" class="text-blue-500 font-semibold hover:underline ml-1">Forgot your password?</a>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit" class="py-3 px-6 text-sm tracking-wide rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none transition-all">
                    Sign In
                    </button>
                </div>
                <p class="text-sm !mt-8 text-center text-gray-500">Don't have an account <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signup')) }}" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a></p>
                </form>
            </div>
        </div>
	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>