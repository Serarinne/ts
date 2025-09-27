<div class="bg-white p-4 font-sans">
	@if($PaginationData->total() < 1)
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-sm text-center">
    <p class="mb-6 text-lg font-light text-black-500 dark:text-black-400">No wallpapers</p>
    </div>
    </div>
    @else
	<div class="columns-2 md:columns-3 lg:columns-4">
	@foreach ($WallpaperData as $Wallpaper)
	<div class="relative mb-4 before:rounded-md " id="post-{{ $Wallpaper['id'] }}" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
      	<meta itemprop="contentUrl" content="@include('/Component/ImageUrl'){{ str_replace('https://storage.serarinne.my.id/serarinne1hdd', '', str_replace('?AccessKey=2d8eb2b3-105e-4003-8e714f2578b0-1f64-42bf', '', $Wallpaper['image'])) }}">
      	<meta itemprop="url" content="{{ str_replace(request()->getHost(), $ServerDomain, url('/' . $Wallpaper['slug'])) }}">
      	<meta itemprop="keywords" content="{{str_replace('#', ',', $Wallpaper['keyword'])}}">

		<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/' . $Wallpaper['slug'])) }}">
			<picture>
				<source type="image/webp" srcset="@include('/Component/ImageUrl')/thumbnail/{{$Wallpaper['id']}}.webp" />
				<source type="image/jpeg" srcset="@include('/Component/ImageUrl')/thumbnail/{{$Wallpaper['id']}}.jpg" />
				<img class="w-full rounded-md" src="@include('/Component/ImageUrl')/thumbnail/{{$Wallpaper['id']}}.jpg" alt="{{ $Wallpaper['seo_title'] }}" width="300" height="{{ round((($Wallpaper['height']/$Wallpaper['width'])*300),0) }}">
			</picture>
		</a>
	</div>
	@endforeach
	</div>
	@endif
</div>