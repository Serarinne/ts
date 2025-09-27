<section name="Navbar">
	<nav class="bg-gray-800">
		<div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
			<div class="relative flex h-16 items-center justify-between">
				<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
					<!-- Mobile menu button-->
					<button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-white bg-gray-600 hover:bg-purple-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white mobile-menu-button" aria-controls="mobile-menu" aria-expanded="false">
						<span class="absolute -inset-0.5"></span>
						<span class="sr-only">Menu</span>
						<svg class=" h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
						</svg>
					</button>
				</div>
				<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
					<div class="hidden sm:ml-6 sm:block">
						<div class="flex space-x-4">
							<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}" {!! Route::currentRouteName() == "Index" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Home</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/character')) }}" {!! Route::currentRouteName() == "Character" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Characters</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/series')) }}" {!! Route::currentRouteName() == "Series" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Series</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/tag')) }}" {!! Route::currentRouteName() == "Tag" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Tags</a>
							<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}" {!! Route::currentRouteName() == "Blog" ? 'class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"' !!}>Blog</a>
						</div>
					</div>
				</div>
				<div class="mr-4">
					<form action="{{ str_replace(request()->getHost(), $ServerDomain, url('/search')) }}" method="GET" class="relative hidden sm:block">
						<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
							<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
							</svg>
						</div>
						<input type="text" id="search-navbar-desktop" name="q" class="block w-full p-2 pl-10 text-sm text-black-900 rounded-lg bg-gray-50  dark:text-black dark:focus:ring-blue-500 " placeholder="Search..." itemprop="query-input" required>
					</form>
				</div>

				@if(session()->has('session'))
				<div class='flex items-center max-sm:ml-auto space-x-6'>
					<ul>
						<li id="profile-dropdown-toggle" class="relative px-1">
							<button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white profile-menu-button" aria-controls="profile-menu" aria-expanded="false">
								<span class="absolute -inset-0.5"></span>
								<span class="sr-only">Account</span>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="cursor-pointer fill-white size-6">
									<path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
								</svg>
							</button>

							<div id="profile-menu" class="bg-white hidden profile-menu z-20 shadow-lg py-6 px-6 rounded sm:min-w-[320px] max-sm:min-w-[250px] absolute right-0 top-10">
								<h6 class="font-semibold text-[15px]">Welcome, <b>{{ $UserData->name }}</b>.</h6>
								<hr class="border-b-0 my-4" />
								<ul class="space-y-1.5">
									<li><a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile?view=account')) }}" class="text-sm text-gray-500 hover:text-black">My Account</a></li>
									<li><a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile?view=favorites')) }}" class="text-sm text-gray-500 hover:text-black">My Favorites</a></li>
									<li><a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile?view=wallpapers')) }}" class="text-sm text-gray-500 hover:text-black">My Wallpapers</a></li>
									<li><a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile?view=posts')) }}" class="text-sm text-gray-500 hover:text-black">My Posts</a></li>
									<li><a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/profile?view=edit')) }}" class="text-sm text-gray-500 hover:text-black">Edit Profile</a></li>
								</ul>
								<hr class="border-b-0 my-4" />
								<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signout')) }}" class="bg-transparent border border-gray-300 hover:border-black rounded px-4 py-2 mt-4 text-sm text-black">Logout</a>
							</div>
						</li>
					</ul>
				</div>
				@else
				<div class='flex items-center max-lg:ml-auto space-x-4'>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signin')) }}" class="bg-gray-600 hover:bg-purple-700 px-4 py-2 rounded-full text-white text-[15px] font-semibold flex items-center justify-center gap-2">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="cursor-pointer fill-white inline w-5 h-5">
							<path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6Zm-5.03 4.72a.75.75 0 0 0 0 1.06l1.72 1.72H2.25a.75.75 0 0 0 0 1.5h10.94l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 0 0-1.06 0Z" clip-rule="evenodd" />
						</svg>
						Sign In
					</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/signup')) }}" class="bg-gray-600 hover:bg-purple-700 px-4 py-2 rounded-full text-white text-[15px] font-semibold flex items-center justify-center gap-2">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="cursor-pointer fill-white inline w-5 h-5">
							<path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
						</svg>
						Sign Up
					</a>
				</div>
				@endif
			</div>
		</div>

		<!-- Mobile menu, show/hide based on menu state. -->
		<div class="hidden mobile-menu" id="mobile-menu">
			<div class="space-y-1 px-2 pb-3 pt-2">
				<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
				<div class="relative mt-3 md:hidden">
					<div>
						<form action="{{ str_replace(request()->getHost(), $ServerDomain, url('/search')) }}" method="GET" class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
							<svg class="w-4 h-4 text-white-500 dark:text-white-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
							</svg>
					</div>
					<input type="text" id="search-navbar" name="q" class="block w-full p-2 pl-10 text-sm text-black-900 rounded-lg bg-gray-50  dark:text-black dark:focus:ring-blue-500 " placeholder="Search..." itemprop="query-input" required>
					</form>
				</div>
				<div class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-white rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}" {!! Route::currentRouteName() == "Index" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Home</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/character')) }}" {!! Route::currentRouteName() == "Character" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Characters</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/series')) }}" {!! Route::currentRouteName() == "Series" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Series</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/tag')) }}" {!! Route::currentRouteName() == "Tag" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Tags</a>
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/blog')) }}" {!! Route::currentRouteName() == "Blog" ? 'class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page"' : 'class="text-white hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"' !!}>Blog</a>
				</div>
			</div>
		</div>
	</nav>
</section>