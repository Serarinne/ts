<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>About Us | WaifuWall</title>
	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="robots"content="index, nofollow" />
	<meta name="description" content="Welcome to WaifuWall, your ultimate destination for all things waifu-related. Delve into a mesmerizing gallery of stunning artwork, showcasing the most beloved characters from anime, manga, and more. Unleash your passion for waifus and indulge in the captivating world of WaifuWall."> 

	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="About Us | WaifuWall" />
	<meta property="og:description" content="Welcome to WaifuWall, your ultimate destination for all things waifu-related. Delve into a mesmerizing gallery of stunning artwork, showcasing the most beloved characters from anime, manga, and more. Unleash your passion for waifus and indulge in the captivating world of WaifuWall." />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="About Us | WaifuWall" />
	<meta name="twitter:description" content="Welcome to WaifuWall, your ultimate destination for all things waifu-related. Delve into a mesmerizing gallery of stunning artwork, showcasing the most beloved characters from anime, manga, and more. Unleash your passion for waifus and indulge in the captivating world of WaifuWall." />
	
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
			"name": "About Us",
			"item": "{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}"  
		}]
	}
	</script>
</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">About Us</h1>
		</div>
		
		<div class="py-24 relative">
			<div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
				<div class="w-full justify-start items-center gap-12 grid grid-cols-1">
					<div class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex">
						<div class="w-full flex-col justify-center items-start gap-8 flex">
							<div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
								<h3
									class="text-gray-900 text-4xl font-bold font-manrope leading-normal lg:text-start text-center">Learn more about us</h3>
								<p class="text-gray-500 text-base font-normal leading-relaxed lg:text-start text-center">
									Waifuwall is a website that provides high-quality character images from various anime, games and manga. Each image is always carefully selected so that users can always find the best quality images and wallpapers about their favorite characters.</p>
								<p class="text-gray-500 text-base font-normal leading-relaxed lg:text-start text-center">
									At first, we only provided anime girl images. But because of the many requests for wallpapers, we also provide male anime images even though the number is limited. As long as the image is good, we will present it to you.</p>
							</div>
						</div>
					</div>
				</div>
        	</div>
    	</div>
	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>
