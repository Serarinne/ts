<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Copyright Policy | WaifuWall</title>
	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="robots"content="index, nofollow" />
	<meta name="description" content="Explore the Copyright Policy on WaifuWall, ensuring a smooth and enjoyable user experience while adhering to our guidelines and policies. Stay informed and make the most of our platform."> 

	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Copyright Policy | WaifuWall" />
	<meta property="og:description" content="Explore the Copyright Policy on WaifuWall, ensuring a smooth and enjoyable user experience while adhering to our guidelines and policies. Stay informed and make the most of our platform." />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Copyright Policy | WaifuWall" />
	<meta name="twitter:description" content="Explore the Copyright Policy on WaifuWall, ensuring a smooth and enjoyable user experience while adhering to our guidelines and policies. Stay informed and make the most of our platform." />
	
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
		"name": "Copyright Policy",
		"item": "{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}"  
	}]
	}
	</script>
</head>

<body>
	@include("Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="lg:mx-0 px-5 py-5">
			<h1 class="text-3xl text-center font-bold tracking-tight text-gray-900 sm:text-4xl">Copyright Policy</h1>
		</div>

		<article class="max-w-auto px-6 py-16 mx-auto space-y-12 dark:bg-white-800 dark:text-white-50 rounded-lg">
			<div class="dark:text-white-100">
				<p class="last-updated">Last Updated: September 22, 2025</p>

        <p>WaifuWall.com ("we", "us", "our") respects the intellectual property rights of others and expects its users to do the same. This Copyright Policy is intended to comply with the requirements of the Digital Millennium Copyright Act ("DMCA") and other applicable intellectual property laws.</p>
        <p>As a platform for user-generated content, we do not monitor user submissions proactively. We rely on copyright holders to help us identify and remove infringing content.</p>
		<br>
        <h2><b>1. Procedure for Reporting Copyright Infringement</b></h2>
        <p>If you are a copyright owner, or are authorized to act on behalf of one, and you believe that your copyrighted work has been copied in a way that constitutes copyright infringement and is accessible via the Service, please submit a Takedown Notice to our designated Copyright Agent containing the following information:</p>
        <ol>
            <li><strong>Your Signature:</strong> A physical or electronic signature of the copyright owner or a person authorized to act on their behalf.</li>
            <li><strong>Identification of the Copyrighted Work:</strong> A description of the copyrighted work that you claim has been infringed. If multiple copyrighted works are covered by a single notification, you may provide a representative list of such works.</li>
            <li><strong>Identification of the Infringing Material:</strong> A description of the material that is claimed to be infringing, including information reasonably sufficient to permit us to locate the material. The most effective way to do this is to provide the direct URL(s) for each image you are reporting (e.g., <code>https://waifuwall.com/image/12345</code>).</li>
            <li><strong>Your Contact Information:</strong> Your full legal name, mailing address, telephone number, and email address.</li>
            <li><strong>A Statement of Good Faith Belief:</strong> A statement by you that you have a good faith belief that the disputed use of the material is not authorized by the copyright owner, its agent, or the law.</li>
            <li><strong>A Statement Under Penalty of Perjury:</strong> A statement that the information in your notice is accurate and, under penalty of perjury, that you are the copyright owner or authorized to act on the copyright owner's behalf.</li>
        </ol>
        <p>Please send your completed Takedown Notice to our designated Copyright Agent.</p>
		<br>
        <h2><b>2. Designated Copyright Agent</b></h2>
        <p>All Takedown Notices should be sent to our designated Copyright Agent at the following email address for the fastest processing:</p>
        <p class="email-address">Email: <code>dmca@waifuwall.com</code></p>
        <p>Please note that we may share your notice, including your contact information, with the user who posted the allegedly infringing content.</p>
		<br>
        <h2><b>3. Counter-Notification Procedure</b></h2>
        <p>If you are a user who believes that your content was removed or disabled as a result of a mistake or misidentification, you may send a Counter-Notice to our Copyright Agent. Your Counter-Notice must include the following information:</p>
        <ol>
            <li>- Your physical or electronic signature.</li>
            <li>- Identification of the content that has been removed and the location at which the content appeared before it was removed (the original URL).</li>
            <li>- A statement under penalty of perjury that you have a good faith belief that the content was removed as a result of mistake or misidentification.</li>
            <li>- Your name, address, telephone number, and email address.</li>
            <li>- A statement that you consent to the jurisdiction of the Federal District Court for the judicial district in which your address is located (or <strong>Indonesia</strong> if your address is outside of the United States), and that you will accept service of process from the person who provided the original infringement notification.</li>
        </ol>
        <p>Upon receipt of a valid Counter-Notice, we may, at our discretion, reinstate the content in question.</p>
		<br>
        <h2><b>4. Policy on Repeat Infringers</b></h2>
        <p>WaifuWall.com has a policy of terminating, in appropriate circumstances, the accounts of users who are determined to be repeat infringers. We may also, at our sole discretion, limit access to the Service and/or terminate the accounts of any users who infringe any intellectual property rights of others, whether or not there is any repeat infringement.</p>
		<br>
        <h2><b>5. Disclaimer</b></h2>
        <div class="disclaimer">
            <p>Please be aware that under the DMCA, you may be liable for damages (including costs and attorneys' fees) if you knowingly misrepresent that material or activity is infringing. This Copyright Policy does not constitute legal advice, and we encourage you to consult with an attorney if you have specific questions.</p>
        </div>
			</div>
		</article>

	</section>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

</html>
