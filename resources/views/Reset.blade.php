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

</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="flex flex-col justify-center items-center font-[sans-serif] bg-gradient-to-r lg:h-screen p-6">
            <form action="{{ url()->current() }}" method="POST" class="sm:p-8 p-4 w-full">
                @csrf
                <input type="hidden" name="userToken" value="{{ $UserData->reset_token }}">
                <div class="md:mb-12 mb-8">
                    <h3 class="text-gray-800 text-3xl font-bold">Reset Password for {{ $UserData->username }}</h3>
                    @if(session()->has('msg'))
                    <div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                            <strong class="font-bold text-sm mr-4">{{ session()->get('msg') }}</strong>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="grid sm:grid-cols-2 gap-10">
                        <div class="relative flex items-center">
                        <label class="text-[13px] bg-white text-black absolute px-2 top-[-10px] left-[18px]">New Password</label>
                        <input type="password" name="password" value="" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                        </svg>
                        </div>

                        <div class="relative flex items-center">
                        <label class="text-[13px] bg-white text-black absolute px-2 top-[-10px] left-[18px]">Confirm New Password</label>
                        <input type="password" name="cpassword" value="" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                        </svg>
                        </div>
                    </div>

                <div class="mt-6 mb-15">
                    <button type="submit" class="py-3 px-6 text-sm tracking-wide rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none transition-all">
                    Reset Password
                    </button>
                </div>
                </form>
        </div>
	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>