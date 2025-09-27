<footer class="rounded-t-lg shadow bg-gray-800">
	<div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
		<nav class="flex flex-wrap justify-center text-sm font-medium">
            <div class="px-5 py-2">
                <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/about-us')) }}" class="text-base leading-6 text-white hover:underline">
                    About Us
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/contact-us')) }}" class="text-base leading-6 text-white hover:underline">
                    Contact Us
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/privacy')) }}" class="text-base leading-6 text-white hover:underline">
                    Privacy Policy
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/terms')) }}" class="text-base leading-6 text-white hover:underline">
                    Terms of Service
                </a>
            </div>
        </nav>
		<hr class="my-6 border-white sm:mx-auto lg:my-8" />
		<span class="block text-sm text-white sm:text-center">© <?php echo date("Y"); ?> <a href="{{ str_replace(request()->getHost(), $ServerDomain, url('/')) }}" class="hover:underline">WaifuWall</a>.</span>
	</div>
</footer>