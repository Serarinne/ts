<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>@if($CharacterData->seo_title != ""){{ $CharacterData->seo_title }}@else{{ $CharacterData->name }} ({{ $CharacterData->series }}) Wallpapers @endif | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="description" content="{{ str_replace('#total#', $PaginationData->total(), $CharacterData->seo_description) }}" />
	<meta name="keywords" content="{{ $CharacterData->seo_keyword }}" />
	<meta name="author" content="Serarinne" />
	
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">

	<meta property="og:type" content="website" />
	<meta property="og:title" content="@if($CharacterData->seo_title != ""){{ $CharacterData->seo_title }}@else{{ $CharacterData->name }} ({{ $CharacterData->series }}) Wallpapers @endif | WaifuWall" />
	<meta property="og:description" content="{{ str_replace('#total#', $PaginationData->total(), $CharacterData->seo_description) }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.jpg" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@if($CharacterData->seo_title != ""){{ $CharacterData->seo_title }}@else{{ $CharacterData->name }} ({{ $CharacterData->series }}) Wallpapers @endif | WaifuWall">
	<meta name="twitter:description" content="{{ str_replace('#total#', $PaginationData->total(), $CharacterData->seo_description) }}">
	<meta name="twitter:image" content="@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.jpg">

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
		"item": "{{ str_replace('/'.$CharacterData->slug,'',url()->current()) }}"  
	},{
		"@type": "ListItem", 
		"position": 3, 
		"name": "{{ $CharacterData->name }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}"  
	}]
	}
	</script>

	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "WebPage",
		"name": "@if($CharacterData->seo_title != ""){{ $CharacterData->seo_title }}@else{{ $CharacterData->name }} ({{ $CharacterData->series }}) Wallpapers @endif",
		"description": "{{ str_replace('#total#', $PaginationData->total(), $CharacterData->seo_description) }}",
		"keywords": "{{ $CharacterData->seo_keyword }}",
		"image": "@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.jpg"
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
							<source type="image/webp" srcset="@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.webp" alt="{{ $CharacterData->name }} {{ $CharacterData->series }}" />
							<source type="image/jpeg" srcset="@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.jpg" alt="{{ $CharacterData->name }} {{ $CharacterData->series }}" />
							<img class="rounded-full object-cover h-20 w-20 sm:h-24 sm:w-24 lg:h-32 lg:w-32" src="@include('/Component/ImageUrl')/character/{{$CharacterData->id}}.jpg" alt="{{ $CharacterData->name }} {{ $CharacterData->series }}">
						</picture>
					</div>
					<div class="ml-5 mb-1 truncate min-w-0">
						<h1 class="truncate text-lg font-medium text-white">
							{{ $CharacterData->name }}
						</h1>
						<div class="truncate text-white">{{ $FirstSeriesData->name }}</div>
						<div class="text-white">{{ $PaginationData->total() }} Wallpapers</div>
					</div>
				</div>
			</div>
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
