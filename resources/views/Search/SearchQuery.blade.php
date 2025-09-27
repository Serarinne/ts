<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Search for "{{ app('request')->input('q') }}" | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="author" content="Serarinne" />
	<meta name="robots"content="noindex, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
	
	@include("/Component/Assets")
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $PaginationData->total() }} @if ($PaginationData->total() <= 1)
					image
				@else
					images
				@endif
				found for the keyword "{{ app('request')->input('q') }}"</h1>
		</div>
		<div class="lg:mx-0 px-5 py-5">
			<form action="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" method="GET">
				<label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
				<div class="relative">
					<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
						<svg class="w-4 h-4 text-white-500 dark:text-white-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
						</svg>
					</div>
					<input type="search" name="q" id="default-search" class="block w-full p-4 pl-10 text-sm text-black-900 border border-white-300 rounded-lg bg-white-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for the character or series name..." value="{{ app('request')->input('q') }}" required>
					<button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-gray-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
				</div>
			</form>
			@include("/Component/Ads")
		</div>

		<section name="PostData" class="mx-3 my-3">
			@include("/Component/PostData")
		</section>
	</section>

	{{ $PaginationData->onEachSide(1)->links("/Component/Pagination") }}

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

</html>
