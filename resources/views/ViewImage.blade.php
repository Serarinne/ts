@php
if(str_contains($WallpaperData['image'], "png")){
	$fileExt = ".png";
	$fileDirectory = "image/";
}elseif(str_contains($WallpaperData['image'], "jpg")){
	$fileExt = ".jpg";
	$fileDirectory = "image/";
}elseif(str_contains($WallpaperData['image'], "jpeg")){
	$fileExt = ".jpeg";
	$fileDirectory = "image/";
}elseif(str_contains($WallpaperData['image'], "mp4")){
	$fileExt = ".mp4";
	$fileDirectory = "video/";
}
@endphp
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>{{ $WallpaperData['seo_title'] }} | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/{{ $WallpaperData['slug'] }}" />
	<meta name="description" content="{{ $WallpaperData['seo_description'] }}" />
	<meta name="keywords" content="{{ $WallpaperData['seo_keyword'] }}" />
	<meta name="author" content="Serarinne" />
	<meta name="robots"content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
	
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ $WallpaperData['seo_title'] }}" />
	<meta property="og:description" content="{{ $WallpaperData['seo_description'] }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $WallpaperData['seo_title'] }}">
	<meta name="twitter:description" content="{{ $WallpaperData['seo_description'] }}">
	<meta name="twitter:image" content="@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}">

	@if($WallpaperData['nsfw'] == '1')<meta name="rating" content="adult">@endif

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
		"name": "{{ $WallpaperData["character"][0]['series_name'] }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/{{ $WallpaperData["character"][0]['series_slug'] }}"  
	},{
		"@type": "ListItem", 
		"position": 3, 
		"name": "{{ $WallpaperData["character"][0]['name'] }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/{{ $WallpaperData["character"][0]['series_slug'] }}/{{ $WallpaperData["character"][0]['slug'] }}"  
	},{
		"@type": "ListItem", 
		"position": 4, 
		"name": "{{ str_replace(" #".$WallpaperData['id'], "", $WallpaperData['seo_title']) }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/{{ $WallpaperData['slug'] }}"  
	}]
	}
	</script>

	@if(str_contains($WallpaperData['image'], '/image/'))<script type="application/ld+json">
    {
	"@context": "https://schema.org/",
    "@type": "ImageObject",
    "thumbnailUrl": "@include('/Component/ImageUrl')/thumbnail/{{$WallpaperData['id']}}.jpg",
    "contentUrl": "@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}",
	"datePublished": "{{ date(DATE_ATOM, strtotime($WallpaperData["date"])) }}",
	"dateModified": "{{ date(DATE_ATOM, strtotime($WallpaperData["date_modified"])) }}",
    "creditText": "{{ $WallpaperData['artist'] }}",
    "creator": {
		"@type": "Person",
		"name": "{{ $WallpaperData['artist'] }}"
    },
    "copyrightNotice": "{{ $WallpaperData['artist'] }}"
    }
    </script>
	@else<script type="application/ld+json">
    {
	"@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "{{ str_replace(" #".$WallpaperData['id'], "", $WallpaperData['seo_title']) }}",
	"caption": "{{ str_replace(" #".$WallpaperData['id'], "", $WallpaperData['seo_title']) }}",
    "description": "{{ $WallpaperData['seo_description'] }}",
	"width": {{ $WallpaperData['width'] }},
	"height": {{ $WallpaperData['height'] }},
    "thumbnailUrl": [
    	"@include('/Component/ImageUrl')/thumbnail/{{$WallpaperData['id']}}.jpg"
    ],
    "uploadDate": "{{ date(DATE_ATOM, strtotime($WallpaperData["date"])) }}",
    "contentUrl": "@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}"
    }
    </script>
	@endif
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $WallpaperData['seo_title'] }}</h1>
			<!-- ADS -->
			@include("/Component/Ads")
			<!-- ADS -->
		</div>
	</section>

	<section class="py-3 sm:py-3">
		<div class="container mx-auto px-4">
			<div class="lg:col-gap-6 xl:col-gap-8 mt-8 grid grid-cols-1 gap-6 lg:mt-12 lg:grid-cols-5 lg:gap-8">
				<div class="lg:col-span-3 lg:row-end-1">
					{{-- <div class="lg:flex lg:items-start"> --}}
					{{-- <div class="lg:order-2 lg:ml-5"> --}}
					<div class="overflow-hidden rounded-lg" id="post-{{ $WallpaperData['id'] }}">
					@if(str_contains($WallpaperData['image'],".mp4"))
						<video controls="controls" autoplay="autoplay">
							<source class="h-full w-full max-w-full object-cover" src="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}{{$fileExt}}" type="video/mp4" width="{{ $WallpaperData['width'] }}" height="{{ $WallpaperData['height'] }}"/>
						</video>
					@else
						<picture>
							<source type="image/webp" media="(max-width: 1023px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}-640.webp" width="640" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*640),0) }}"/>
							<source type="image/webp" media="(max-width: 1599px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}-1024.webp" width="1024" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*1024),0) }}"/>
							<source type="image/webp" media="(min-width: 1600px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}.webp" width="1600" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*1600),0) }}"/>
							<source type="image/jpeg" media="(max-width: 1023px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}-640.jpg" width="640" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*640),0) }}"/>
							<source type="image/jpeg" media="(max-width: 1599px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}-1024.jpg" width="1024" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*1024),0) }}"/>
							<source type="image/jpeg" media="(min-width: 1600px)" srcset="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}.jpg" width="1600" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*1600),0) }}"/>
							<img src="@include('/Component/ImageUrl')/preview/{{$WallpaperData['id']}}.jpg" alt="{{ str_replace(" #".$WallpaperData['id'], "", $WallpaperData['seo_title']) }}" width="1600" height="{{ round((($WallpaperData['height']/$WallpaperData['width'])*1600),0) }}"/>
						</picture>
					@endif
					</div>
					{{-- </div> --}}
					{{-- </div> --}}
				</div>

				<div class="lg:col-span-2 lg:row-span-2 lg:row-end-2 truncate">
					<div class="mt-3 flex select-none flex-wrap items-center gap-1">
					<!-- ADS -->
					@include("/Component/Ads")
					<!-- ADS -->
					</div>

					<h2 class="text-base text-gray-900 font-bold border-b text-center md:text-left">Information</h2>
					<div class="flex w-full select-none flex-wrap items-center gap-1">
						<ul class="w-full">
							<li class="flex justify-between my-2"><span class="font-bold">Artist</span> <span class="ml-2 truncate text-base text-black-900 min-w-0">@if($WallpaperData["artist"] == "") - @else {{ $WallpaperData["artist"] }} @endif</span></li>
							<li class="flex justify-between my-2"><span class="font-bold">Posted on</span> <span class="truncate min-w-0">{{ date("F d, Y, h:i a", strtotime($WallpaperData["date"])) }}</span></li>
							<li class="flex justify-between my-2"><span class="font-bold">File type</span> <span class="truncate min-w-0">@php
								if (str_contains($WallpaperData["image"], ".jpg") || str_contains($WallpaperData["image"], ".jpeg")) {
								    echo "IMAGE/JPEG";
								} elseif (str_contains($WallpaperData["image"], ".png")) {
								    echo "IMAGE/PNG";
								} elseif (str_contains($WallpaperData["image"], ".mp4")) {
								    echo "VIDEO/MP4";
								}
							@endphp</span></li>
							<li class="flex justify-between my-2"><span class="font-bold">Resolution</span> <span>{{ $WallpaperData["width"] }} x {{ $WallpaperData["height"] }}</span></li>
							<li class="flex justify-between my-2"><span class="font-bold">File Size</span> <span class="truncate min-w-0">@php
								$base = log($WallpaperData["file_size"]) / log(1024);
								$suffix = array("", " KB", " MB", " GB", " TB");
								$f_base = floor($base);
								echo round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
								@endphp</span></li>
							<li class="flex justify-between my-2"><span class="font-bold">Uploader</span> <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile')) }}/{{ $WallpaperData['uploader_slug'] }}" class="truncate min-w-0"><span class="ml-2 truncate text-base text-blue-900 min-w-0">{{ $WallpaperData["uploader_name"] }}</span></a></li>
							<li class="flex justify-between my-2"><span class="font-bold">Source</span> <a href="{{ $WallpaperData['real_source'] }}" target="_blank" class="truncate min-w-0"><span class="ml-2 truncate text-base text-blue-900 min-w-0">@if($WallpaperData["real_source"] == "") - @else {{ $WallpaperData["real_source"] }} @endif</span></a></li>
						</ul>
					</div>

					<hr>
					<div class="mt-3 flex select-none flex-wrap items-center gap-1">
						<form action="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" method="POST" class="w-full">
							@csrf
							<button type="submit" class="w-full inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700 font-bold">
								Download Image
							</button>
						</form>
					</div>

					<h2 class="mt-8 text-base text-gray-900 font-bold border-b text-center md:text-left">Share</h2>
					<div class="mt-3 flex select-none flex-wrap items-center gap-1">
						<a class="inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://facebook.com/sharer/sharer.php?u={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" aria-label="Share on Facebook" draggable="false">
							<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
								<title>Facebook</title>
								<path d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
								</path>
							</svg>
						</a>
						<a class=" inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}&amp;text={{ $WallpaperData['seo_title'] }}" aria-label="Share on Twitter" draggable="false">
							<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
								<title>Twitter</title>
								<path d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
								</path>
							</svg>
						</a>
						<a class="inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://pinterest.com/pin/create/button/?url={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}&amp;media=@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}&amp;description={{ $WallpaperData['seo_title'] }}" aria-label="Share on Pinterest" draggable="false">
							<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
								<title>Pinterest</title>
								<path d="M268 6C165 6 64 75 64 186c0 70 40 110 64 110 9 0 15-28 15-35 0-10-24-30-24-68 0-81 62-138 141-138 68 0 118 39 118 110 0 53-21 153-90 153-25 0-46-18-46-44 0-38 26-74 26-113 0-67-94-55-94 25 0 17 2 36 10 51-14 60-42 148-42 209 0 19 3 38 4 57 4 3 2 3 7 1 51-69 49-82 72-173 12 24 44 36 69 36 106 0 154-103 154-196C448 71 362 6 268 6z">
								</path>
							</svg>
						</a>
					</div>

					<h2 class="mt-8 text-base text-gray-900 font-bold border-b text-center md:text-left">Character</h2>
					<div class="flex select-none flex-wrap items-center gap-1">
						@foreach ($WallpaperData["character"] as $Character)
							<a class="w-full flex p-4 md:p-4 mt-3 font-medium text-purple-100 bg-gray-800 rounded-lg focus:shadow-outline hover:bg-purple-700" href="{{ str_replace(request()->getHost(), $ServerDomain, url("/")) }}/{{ $Character['series_slug'] }}/{{ $Character['slug'] }}">
								<div class="flex items-center space-x-4 truncate">
									<picture>
										<source type="image/webp" srcset="@include('/Component/ImageUrl')/character/{{$Character['id']}}.webp" />
										<source type="image/jpeg" srcset="@include('/Component/ImageUrl')/character/{{$Character['id']}}.jpg" />
										<img class="w-14 h-14 rounded-full object-cover" src="@include('/Component/ImageUrl')/character/{{$Character['id']}}.jpg" alt="{{ $Character['name'] }} ({{ $Character['series_name'] }})">
									</picture>
									<div class="font-medium dark:text-white truncate">
										<h3 class="truncate">{{ $Character['name'] }}</h3>
										<h3 class="text-sm font-normal text-white-500 dark:text-white-400 truncate">{{ $Character['series_name'] }}</h3>
									</div>
								</div>
							</a>
						@endforeach
					</div>

					<h2 class="mt-8 text-base text-gray-900 font-bold border-b text-center md:text-left">Embed Code</h2>
					<div class="mt-3 flex select-none flex-wrap items-center gap-1">
						<div class="w-full">
							<label for="DirectLink Share" class="block mb-2 text-sm font-medium">Direct Link</label>
							<input type="text" id="DirectLink Share" class="block p-3 w-full text-sm rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="{{ URL::current() }}" readonly>
						</div>
						<div class="w-full">
							<label for="BBCode/Forum Share" class="block mb-2 text-sm font-medium">BBCode/Forum</label>
							@if(str_contains($WallpaperData['image'], '/image/'))
							<input type="text" id="BBCode/Forum Share" class="block p-3 w-full text-sm rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="[URL={{ URL::current() }}][IMG]@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}[/IMG][/URL]" readonly>
							@else
							<input type="text" id="BBCode/Forum Share" class="block p-3 w-full text-sm rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="[URL={{ URL::current() }}][MP4VIDEO]@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}[/MP4VIDEO][/URL]" readonly>
							@endif
						</div>
						<div class="w-full">
							<label for="HTML Code Share" class="block mb-2 text-sm font-medium">HTML Code</label>
							@if(str_contains($WallpaperData['image'], '/image/'))
							<input type="text" id="HTML Code Share" class="block p-3 w-full text-sm rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<a href='{{ URL::current() }}'><img src='@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}'/></a>" readonly>
							@else
							<input type="text" id="HTML Code Share" class="block p-3 w-full text-sm rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" value="<a href='{{ URL::current() }}'><video type='video/mp4' src='@include('/Component/ImageUrl')/{{$fileDirectory}}{{$WallpaperData['id']}}{{$fileExt}}'/></a>" readonly>
							@endif
						</div>
					</div>
				</div>

				<div class="lg:col-span-3">
					<div class="border-b border-gray-300">
						<h2 class="mt-8 text-base text-gray-900 font-bold text-center md:text-left">Tags</h2>
					</div>

					<div class="mt-2 flow-root sm:mt-2">
						@if ($WallpaperData["tag"] != "")
							@foreach ($WallpaperData["tag"] as $Tag)
								<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/tag/{{ $Tag->slug }}" class="mt-2 inline-block px-4 py-2 rounded tracking-wider bg-gray-800 dark:bg-gray-900 hover:bg-blue-700 text-white text-[13px]">
									{{ $Tag->name }}
								</a>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
