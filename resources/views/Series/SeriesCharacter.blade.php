<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>{{ $SeriesData->name }} Characters | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), 'waifuwall.com', url()->current()) }}" />
	<meta name="description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description_character) }}" />
	<meta name="keywords" content="{{ $SeriesData->seo_keyword }}" />
	<meta name="author" content="Serarinne" />
	
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1" />
    <meta name="robots" content="max-image-preview:standard">

	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ $SeriesData->name }} Characters" />
	<meta property="og:description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description_character) }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), 'waifuwall.com', url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="@include('/Component/ImageUrl')/series/{{$SeriesData->id}}.jpg" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $SeriesData->name }} Characters">
	<meta name="twitter:description" content="{{ str_replace('#total#', $PaginationData->total(), $SeriesData->seo_description_character) }}">
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
		"item": "https://waifuwall.com"  
	},{
		"@type": "ListItem", 
		"position": 2, 
		"name": "{{ $SeriesData->name }}",
		"item": "{{ str_replace(request()->getHost(), 'waifuwall.com', url('/')) }}/{{ $SeriesData->slug }}"  
	},{
		"@type": "ListItem", 
		"position": 3, 
		"name": "Character",
		"item": "{{ str_replace(request()->getHost(), 'waifuwall.com', url()->current()) }}"  
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
							{{ $SeriesData->name }} Characters
						</h1>
						<div class="text-white">{{ $PaginationData->total() }} Characters</div>
					</div>
				</div>
			</div>
			<ul role="tablist" class="w-full flex flex-col my-2 justify-center text-center sm:flex-row lg:justify-start">
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace('/character','',url()->current()) }}" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">Wallpaper</a>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<span role="tab" class="block bg-gray-900 text-white font-medium py-2 px-5 mb-2 mx-2" aria-current="page">Character</span>
				</li>
			</ul>
		</div>
		<div class="lg:mx-0 px-5 py-5">
			@include("/Component/Ads")
		</div>
		<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
			@foreach ($CharacterData as $Character)
			<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-white-800 dark:border-gray-700">
				<a href="{{ str_replace('/character','',url()->current()) }}/{{ $Character['slug'] }}">
					<picture>
						<source type="image/webp" srcset="@include('/Component/ImageUrl')/character/{{$Character['id']}}.webp" />
						<source type="image/jpeg" srcset="@include('/Component/ImageUrl')/character/{{$Character['id']}}.jpg" />
						<img class="h-60 w-full max-w-full rounded-lg mb-3 shadow-lg object-cover" src="@include('/Component/ImageUrl')/character/{{$Character['id']}}.jpg" alt="{{ $Character['name'] }} ({{ $Character['series'] }})">
					</picture>
				</a>
				<div class="flex flex-col pb-3 px-2 truncate">
					<a href="{{ str_replace('/character','',url()->current()) }}/{{ $Character['slug'] }}" class="mb-1 truncate min-w-0">
					<span class="text-base font-medium text-black-900">{{ $Character['name'] }}</span>
					</a>
					<span class="mb-1 truncate text-base text-black-900 min-w-0">{{ $Character['series'] }}</span>
				</div>
			</div>
			@endforeach
		</div>
	</section>

	{{ $PaginationData->onEachSide(1)->links("/Component/Pagination") }}

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
