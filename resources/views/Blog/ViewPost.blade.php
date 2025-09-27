<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>{{ $Data->title }} | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/{{ $Data->slug }}" />
	<meta name="description" content="{{ $Data->description }}" />
	<meta name="keywords" content="{{ $Data->keyword }}" />
	<meta name="author" content="{{ $Data->author }}" />
	<meta name="robots"content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
	
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ $Data->title }}" />
	<meta property="og:description" content="{{ $Data->description }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="{{ $Data->thumbnail }}" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $Data->title }}">
	<meta name="twitter:description" content="{{ $Data->description }}">
	<meta name="twitter:image" content="{{ $Data->thumbnail }}">

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
		"name": "Blog",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/blog"  
	},{
		"@type": "ListItem", 
		"position": 3, 
		"name": "{{ $Data->title }}",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}/blog/{{ $Data->slug }}"  
	}]
	}
	</script>

	<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "{{ $Data->title }}",
      "image": [
        "{{ $Data->thumbnail }}"
       ],
      "datePublished": "{{ date(DATE_ATOM, strtotime($Data->date)) }}",
      "dateModified": "{{ date(DATE_ATOM, strtotime($Data->date_modified)) }}",
      "author": [{
          "@type": "Person",
          "url": "{{ str_replace(request()->getHost(), $ServerDomain, url('/profile')) }}/{{ $Data->author_slug }}",
          "name": "{{ $Data->author }}"
      }]
    }
    </script>
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $Data->title }}</h1>
			<!-- ADS -->
			@include("/Component/Ads")
			<!-- ADS -->
		</div>
	</section>

	<section class="py-3 sm:py-3">
		<div class="container mx-auto px-4">
			<div class="lg:col-gap-6 xl:col-gap-8 mt-8 grid grid-cols-1 gap-6 lg:mt-12 lg:grid-cols-1 lg:gap-8">
				<div class="lg:col-span-1 lg:row-end-1">
					{{-- <div class="lg:flex lg:items-start"> --}}
					{{-- <div class="lg:order-2 lg:ml-5"> --}}
					<div class="flex w-full select-none flex-wrap items-center gap-1 border-b mb-5">
						<ul class="w-full">
							<li class="flex justify-between my-2"><span class="ml-2 truncate text-base text-black-900 min-w-0">Posted by <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile')) }}/{{ $Data->author_slug }}?page=post" class="truncate min-w-0"><b>{{ $Data->author }}</b></a></span> <span class="ml-2 truncate text-base text-black-900 min-w-0">{{ date("F d, Y, h:i a", strtotime($Data->date)) }}</span></li>
						</ul>
					</div>

					<div class="overflow-hidden rounded-lg" id="post-{{ $Data->id }}">
                        {!! $Data->content !!}
					</div>

                    <div class="lg:col-span-3">
					<div class="border-b border-gray-300">
						<h2 class="mt-8 text-base text-gray-900 font-bold text-center md:text-left">Tag</h2>
					</div>

					@php
					$tagList = array_unique(explode("#", $Data->tag));
					@endphp
					<div class="mt-5 flow-root sm:mt-5">
						@foreach($tagList as $tag)
						<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}?tag={{ strtolower($tag) }}" class="mt-2 inline-block px-4 py-2 rounded tracking-wider bg-gray-800 dark:bg-gray-900 hover:bg-blue-700 text-white text-[13px]">{{ $tag }}</a>
						@endforeach
					</div>
				</div>
				
				<h2 class="mt-8 text-base text-gray-900 font-bold border-b text-center md:text-left">Share</h2>
				<div class="mt-3 flex select-none flex-wrap items-center gap-1">
					<a class="inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://facebook.com/sharer/sharer.php?u={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" aria-label="Share on Facebook" draggable="false">
						<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
							<title>Facebook</title>
							<path d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z"></path>
						</svg>
					</a>
					<a class=" inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}&amp;text={{ $Data->title }}" aria-label="Share on Twitter" draggable="false">
						<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
							<title>Twitter</title>
							<path d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z"></path>
						</svg>
					</a>
					<a class="inline-flex flex-auto justify-center items-center mb-1 mr-1 p-3 rounded-lg text-white bg-gray-800 hover:bg-blue-700" target="_blank" rel="noopener" href="https://pinterest.com/pin/create/button/?url={{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}&amp;media={{ $Data->thumbnail }}&amp;description={{ $Data->title }}" aria-label="Share on Pinterest" draggable="false">
						<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
							<title>Pinterest</title>
							<path d="M268 6C165 6 64 75 64 186c0 70 40 110 64 110 9 0 15-28 15-35 0-10-24-30-24-68 0-81 62-138 141-138 68 0 118 39 118 110 0 53-21 153-90 153-25 0-46-18-46-44 0-38 26-74 26-113 0-67-94-55-94 25 0 17 2 36 10 51-14 60-42 148-42 209 0 19 3 38 4 57 4 3 2 3 7 1 51-69 49-82 72-173 12 24 44 36 69 36 106 0 154-103 154-196C448 71 362 6 268 6z"></path>
						</svg>
					</a>
				</div>
					{{-- </div> --}}
					{{-- </div> --}}
				</div>
			</div>
		</div>
	</section>

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
