<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>@if($SeriesData->seo_title != ""){{ $SeriesData->seo_title }}@else{{ $SeriesData->name }} Wallpapers @endif | WaifuWall</title>
	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />

	<meta name="description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description) }}" />
	<meta name="keywords" content="{{ $SeriesData->seo_keyword }}" />
	<meta name="author" content="Serarinne" />
	
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">

	<meta property="og:type" content="website" />
	<meta property="og:title" content="@if($SeriesData->seo_title != ""){{ $SeriesData->seo_title }}@else{{ $SeriesData->name }} Wallpapers @endif" />
	<meta property="og:description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description) }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.jpg" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@if($SeriesData->seo_title != ""){{ $SeriesData->seo_title }}@else{{ $SeriesData->name }} Wallpapers @endif">
	<meta name="twitter:description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description) }}">
	<meta name="twitter:image" content="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.jpg">

	@include("/Component/Assets")

	<script type="application/ld+json">
	{
	"@context": "https://schema.org/", 
	"@type": "BreadcrumbList", 
	"itemListElement": [{
		"@type": "ListItem", 
		"position": 1, 
		"name": "Home",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}"  
	},{
		"@type": "ListItem", 
		"position": 2, 
		"name": "{{ $SeriesData->name }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}"  
	}]
	}
	</script>
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="bg-gray-800 intro-y box mt-5 px-5 pt-5 rounded-md">
			<div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
				<div class="flex flex-1 items-center justify-start px-5">
					<div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
						<picture>
							<source type="image/webp" srcset="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.webp" />
							<source type="image/jpeg" srcset="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.jpg" />
							<img class="rounded-full object-cover h-20 w-20 sm:h-24 sm:w-24 lg:h-32 lg:w-32" src="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.jpg" alt="{{ $SeriesData->name }}">
						</picture>
					</div>
					<div class="ml-5 mb-1 truncate min-w-0">
						<h1 class="truncate text-lg font-medium text-white">
							{{ $SeriesData->name }} Wallpapers
						</h1>
						<div class="text-white">{{ $PaginationData->total() }} Wallpapers</div>
					</div>
				</div>
			</div>
			<ul role="tablist" class="w-full flex flex-col my-2 justify-center text-center sm:flex-row lg:justify-start">
				<li role="presentation" class="focus-visible:outline-none">
					<span role="tab" class="block bg-gray-900 text-white font-medium py-2 px-5 mb-2 mx-2" aria-current="page">Wallpaper</span>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}/character" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">Character</a>
				</li>
			</ul>
		</div>
		<div class="lg:mx-0 px-5 py-5">
			@include("/Component/Ads")
		</div> 
		@include("/Component/PostData")
	</section>

	{{ $PaginationData->onEachSide(1)->links("/Component/Pagination") }}

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
