<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>My Wallpapers | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
    <meta name="robots" content="noindex, nofollow" />

	<meta property="og:type" content="website" />
	<meta property="og:title" content="My Wallpapers | WaifuWall" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="{{ $UserData->image }}" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="My Wallpapers | WaifuWall">
	<meta name="twitter:image" content="{{ $UserData->image }}">

	@include("/Component/Assets")
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="bg-gray-800 intro-y box mt-5 px-5 pt-5 rounded-md">
			<div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
				<div class="flex flex-1 items-center justify-start px-5">
					<div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
						<img class="rounded-full object-cover h-20 w-20 sm:h-24 sm:w-24 lg:h-32 lg:w-32" src="{{ $UserData->image }}" alt="{{ $UserData->name }}">
					</div>
					<div class="ml-5 mb-1 truncate min-w-0">
						<div class="flex flex-row items-center">
							<h1 class="truncate text-lg font-medium text-white">
								{{ $UserData->name }}
							</h1>
							@if(is_null($UserData->validate_token))<svg class="ml-2 w-5 h-5 items-center justify-center text-sm font-semibold text-blue-800 bg-blue-400 rounded-full dark:bg-gray-700 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
								<path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
							</svg>@endif
						</div>
						<div class="text-white">Role: @if($UserData->role == 0)Admin @elseif($UserData->role == 1)Member @elseif($UserData->role == 2)Moderator @endif</div>
					</div>
				</div>
			</div>
			<ul role="tablist" class="w-full flex flex-col my-2 justify-center text-center sm:flex-row lg:justify-start">
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=account" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">Account</a>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=favorites" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">My Favorites</a>
				</li>
                <li role="presentation" class="focus-visible:outline-none">
                    <span role="tab" class="block bg-gray-900 text-white font-medium py-2 px-5 mb-2 mx-2" aria-current="page">My Wallpapers</span>
				</li>
                <li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=posts" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">My Posts</a>
				</li>
                <li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=edit" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">Edit Profile</a>
				</li>
			</ul>
		</div>

		@include("/Component/PostData")
	</section>

    {{ $PaginationData->onEachSide(1)->links("/Component/Pagination") }}

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
