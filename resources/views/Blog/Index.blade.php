<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Blog Posts | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="description" content="Read various quality articles about your favorite anime and games!" />
	<meta name="keywords" content="waifuwall, waifu wallpaper, anime girl wallpaper, 4k wallpaper, hd wallpaper, wallpaper smartphone, wallpaper pc, anime wallpaper, game wallpaper, anime waifu wallpaper, ai wallpaper" />
	<meta name="author" content="Serarinne" />
	<meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">
	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Blog Posts | WaifuWall" />
	<meta property="og:description" content="Read various quality articles about your favorite anime and games!" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Blog Posts | WaifuWall" />
	<meta name="twitter:description" content="Read various quality articles about your favorite anime and games!" />

	@include("Component/Assets")

</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
        <div class="lg:mx-0 px-5 py-5">
			@if(app('request')->input('tag'))
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">Posts with tag : "{{ app('request')->input('tag') }}"</h1>
			@else
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">Blog Posts</h1>
			@endif
		</div>

		<div class="lg:mx-0 px-5 py-5">
			@include("Component/Ads")
		</div>
		@include("Component/BlogData")
	</section>

	{{ $BlogData->onEachSide(1)->links("Component/Pagination") }}

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>