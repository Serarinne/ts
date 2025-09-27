@if ($paginator->hasPages())
<section name="PaginationData">
	<div class="flex flex-col space-y-4 items-center justify-center lg:mx-0 px-5 py-5">
		<span class="text-sm text-black-700 dark:text-black-400">
			Showing <span class="font-medium">{{$paginator->firstItem()}}</span> to
			<span class="font-medium">{{$paginator->lastItem()}}</span> of <span
				class="font-medium">{{$paginator->total()}}</span> Data
		</span>
		<ul class="inline-flex -space-x-px text-base h-10">
			@if (!$paginator->onFirstPage())
			<li>
				<a rel="prev" href="{{ $paginator->previousPageUrl() }}"
					class="flex items-center justify-center mr-2 px-4 h-10 select-none rounded-l-lg bg-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none dark:bg-gray-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</a>
			</li>
			@endif

			@foreach ($elements as $element)
			@if (is_array($element))
			@foreach ($element as $page => $url)
			@if ($page == $paginator->currentPage())
			@if ($paginator->onFirstPage())
			<li>
				<span aria-current="page"
					class="flex items-center justify-center px-4 h-10 rounded-l-lg select-none bg-gray-800 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">{{
					$page }}</span>
			</li>
			@elseif ($paginator->onLastPage())
			<li>
				<span aria-current="page"
					class="flex items-center justify-center px-4 h-10 rounded-r-lg select-none bg-gray-800 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">{{
					$page }}</span>
			</li>
			@else
			<li>
				<span aria-current="page"
					class="flex items-center justify-center px-4 h-10 select-none bg-gray-800 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">{{
					$page }}</span>
			</li>
			@endif
			@else
			@endif
			@endforeach
			@endif
			@endforeach

			@if ($paginator->hasMorePages())
			<li>
				<a rel="next" href="{{ $paginator->nextPageUrl() }}"
					class="flex items-center justify-center ml-2 px-4 h-10 select-none rounded-r-lg bg-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none dark:bg-gray-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</a>
			</li>
			@endif
		</ul>
	</div>
</section>
@endif