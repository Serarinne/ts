<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Reset Password | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="description" content="Forgot your account password? You can reset it through this menu." />
	<meta name="keywords" content="waifuwall, waifu wallpaper, anime girl wallpaper, 4k wallpaper, hd wallpaper, wallpaper smartphone, wallpaper pc, anime wallpaper, game wallpaper, anime waifu wallpaper, ai wallpaper" />
	<meta name="author" content="Serarinne" />
	<meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">
	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Reset Password | WaifuWall" />
	<meta property="og:description" content="Forgot your account password? You can reset it through this menu." />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Reset Password | WaifuWall" />
	<meta name="twitter:description" content="Forgot your account password? You can reset it through this menu." />

	@include("Component/Assets")
  
  	<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="flex flex-col justify-center items-center font-[sans-serif] bg-gradient-to-r lg:h-screen p-6">
            <form action="{{ url()->current() }}" method="POST" class="sm:p-8 p-4 w-full">
                @csrf
                <div class="md:mb-12 mb-8">
                    <h3 class="text-gray-800 text-3xl font-bold">Reset Password</h3>
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
                    <label class="text-gray-800 text-sm mb-2 block">Email</label>
                    <input name="email" type="text" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-2.5 rounded-md border focus:bg-transparent focus:border-black outline-none transition-all" placeholder="Enter your email" required/>
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

                <div class="mt-6">
                    <button type="submit" class="py-3 px-6 text-sm tracking-wide rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none transition-all">
                    Reset Password
                    </button>
                </div>
                <p class="text-sm !mt-8 text-center text-gray-500">Don't have an account <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signup')) }}" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a></p>
                <p class="text-sm !mt-8 text-center text-gray-500">If you already have one, please <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signin')) }}" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Sign In</a></p>
                </form>
        </div>
	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>