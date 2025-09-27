<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Contact Us | WaifuWall</title>
	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="robots"content="index, nofollow" />
	<meta name="description" content="Get in touch with us at WaifuWall through our contact form or by emailing admin@waifuwall.com. We are ready to assist you with any queries or concerns."> 

	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Contact Us | WaifuWall" />
	<meta property="og:description" content="Get in touch with us at WaifuWall through our contact form or by emailing admin@waifuwall.com. We are ready to assist you with any queries or concerns." />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Contact Us | WaifuWall" />
	<meta name="twitter:description" content="Get in touch with us at WaifuWall through our contact form or by emailing admin@waifuwall.com. We are ready to assist you with any queries or concerns." />
	
	@include("Component/Assets")

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
		"name": "Contact Us",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}"  
	}]
	}
	</script>
  
  	<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">Contact Us</h1>
		</div>

		<article class="max-w-auto px-6 py-16 mx-auto space-y-12 dark:bg-white-800 dark:text-white-50 rounded-lg">
			<div class="dark:text-white-100">
				<div class="px-4 mx-auto max-w-screen-md">
					@if ($Success == true)
						<p class="mb-8 lg:mb-16 font-light text-center text-white-500 dark:text-white-400 sm:text-xl">
							Thank you for contacting us, we will respond to your message as soon as possible.
						</p>
					@elseif ($Success == "failed")
						<p class="mb-8 lg:mb-16 font-light text-center text-white-500 dark:text-white-400 sm:text-xl">
							Failed to send message, please try again. Or try sending your message to our email <a class="text-dark-1 fw-bold fs-1" href="/cdn-cgi/l/email-protection#f190959c989fb1869098978486909d9ddf929e9c"><span class="__cf_email__" data-cfemail="ceafaaa3a7a08eb9afa7a8bbb9afa2a2e0ada1a3">[email&#160;protected]</span></a>.
						</p>
					@else
						<p class="mb-8 lg:mb-16 font-light text-center text-white-500 dark:text-white-400 sm:text-xl">Got a technical issue? Want to send feedback about a feature? Let us know.</p>
					@endif
                  
                  	@if(session()->has('cf-msg'))
                  	<div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                  			<strong class="font-bold text-sm mr-4">{{ session()->get('cf-msg') }}</strong>
                    	</div>
                    </div>
                  	@endif
					<form action="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" method="post" class="space-y-8">
						@csrf
						<div>
							<label for="name" class="block mb-2 text-sm font-medium text-white-900 dark:text-white-300">Your Name</label>
							<input type="text" name="name" id="name" class="block p-3 w-full text-sm text-black-900 bg-white-50 rounded-lg border border-white-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Your name" required>
						</div>
						<div>
							<label for="email" class="block mb-2 text-sm font-medium text-white-900 dark:text-white-300">Your email</label>
							<input type="email" id="email" name="email" class="shadow-sm bg-white-50 border border-white-300 text-black-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="your@email.com" required>
						</div>
						<div class="sm:col-span-2">
							<label for="message" class="block mb-2 text-sm font-medium text-white-900 dark:text-white-400">Your message</label>
							<textarea id="message" name="message" rows="6" class="block p-2.5 w-full text-sm text-black-900 bg-white-50 rounded-lg shadow-sm border border-white-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
						</div>
                      
                      	<div class="flex items-center mt-6">
                            <x-turnstile-widget
                                theme="dark"
                                language="en-US"
                                size="normal"
                                callback="callbackFunction"
                                errorCallback="errorCallbackFunction"
                            />
                        </div>
						<button type="submit" class="text-white bg-gray-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Send message</button>
					</form>
				</div>
			</div>
		</article>

	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>

</html>
