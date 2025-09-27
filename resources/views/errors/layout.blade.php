@php
$ServerDomain = "waifuwall.com";
@endphp
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('code') @yield('title')</title>
<meta name="robots" content="noindex, nofollow" />

@include("Component/Assets")
</head>
<body>

<section name="Navbar">
	<nav class="bg-gray-800">
		<div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
			<div class="relative flex h-16 items-center justify-between">
				<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
					<!-- Mobile menu button-->
					<button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-white bg-gray-600 hover:bg-purple-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white mobile-menu-button" aria-controls="mobile-menu" aria-expanded="false">
						<span class="absolute -inset-0.5"></span>
						<span class="sr-only">Menu</span>
						<svg class=" h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
						</svg>
					</button>
				</div>
				<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
					<div class="hidden sm:ml-6 sm:block">
						<div class="flex space-x-4">
							<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}" {!! Route::currentRouteName() == "Index" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Home</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/character')) }}" {!! Route::currentRouteName() == "Character" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Characters</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/series')) }}" {!! Route::currentRouteName() == "Series" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Series</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/tag')) }}" {!! Route::currentRouteName() == "Tag" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Tags</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}" {!! Route::currentRouteName() == "Blog" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Blog</a>
						</div>
					</div>
				</div>
				<div class="mr-4">
					<form action="{{ str_replace(request()->getHost(), $ServerDomain, url('/search')) }}" method="GET" class="relative hidden sm:block">
						<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
							<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
							</svg>
						</div>
						<input type="text" id="search-navbar-desktop" name="q" class="block w-full p-2 pl-10 text-sm text-black-900 rounded-lg bg-gray-50  dark:text-black dark:focus:ring-blue-500 " placeholder="Search..." itemprop="query-input" required>
					</form>
				</div>
			</div>
		</div>

		<!-- Mobile menu, show/hide based on menu state. -->
		<div class="hidden mobile-menu" id="mobile-menu">
			<div class="space-y-1 px-2 pb-3 pt-2">
				<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
				<div class="relative mt-3 md:hidden">
					<div>
						<form action="{{ str_replace(request()->getHost(), $ServerDomain, url('/search')) }}" method="GET" class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
							<svg class="w-4 h-4 text-white-500 dark:text-white-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
							</svg>
					</div>
					<input type="text" id="search-navbar" name="q" class="block w-full p-2 pl-10 text-sm text-black-900 rounded-lg bg-gray-50  dark:text-black dark:focus:ring-blue-500 " placeholder="Search..." itemprop="query-input" required>
					</form>
				</div>
				<div class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-white rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}" {!! Route::currentRouteName() == "Index" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Home</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/character')) }}" {!! Route::currentRouteName() == "Character" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Characters</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/series')) }}" {!! Route::currentRouteName() == "Series" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Series</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/tag')) }}" {!! Route::currentRouteName() == "Tag" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Tags</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}" {!! Route::currentRouteName() == "Blog" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Blog</a>
				</div>
			</div>
		</div>
	</nav>
</section>

<section class="bg-white dark:bg-gray-900">
<div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
<div class="mx-auto max-w-screen-sm text-center">
<h1 class="mb-6 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">@yield('code')</h1>
<p class="mb-6 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">@yield('title')</p>
<p class="mb-6 text-lg font-light text-gray-500 dark:text-gray-400">@yield('message')</p>
<a href="{{ str_replace(request()->getHost(), 'waifuwall.com', url('/')) }}" class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-5 text-center dark:focus:ring-primary-900 my-4">Back to Homepage</a>
</div>
</div>
</section>

@include("Component/Footer")
@include("Component/FooterScript")

</body>
</html>
