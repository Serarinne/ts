<div class="bg-white p-4 font-sans">
    @if($BlogData->total() < 1)
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-sm text-center">
    <p class="mb-6 text-lg font-light text-black-500 dark:text-black-400">No posts</p>
    </div>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($BlogData as $Data)
        <div class="bg-purple-100 cursor-pointer rounded-md overflow-hidden group">
            <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}/{{ $Data->slug }}">
                <div class="relative overflow-hidden">
                    <img src="{{ $Data->thumbnail }}" alt="{{ $Data->title }}" class="w-full h-60 object-cover group-hover:scale-125 transition-all duration-300" />
                    <div class="px-4 py-2.5 text-white text-sm tracking-wider bg-gray-800 absolute bottom-0 right-0">{{ date("F d, Y", strtotime($Data->date)) }}</div>
                    </div>
                    <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800">{{ $Data->title }}</h3>
                    <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}/{{ $Data->slug }}" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-gray-800 dark:bg-gray-900 hover:bg-blue-700 text-white text-[13px]">Read More</a>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>