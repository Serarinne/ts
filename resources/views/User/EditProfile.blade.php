<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Edit Profile | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
    <meta name="robots" content="noindex, nofollow" />

	<meta property="og:type" content="website" />
	<meta property="og:title" content="Edit Profile | WaifuWall" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />
	<meta property="og:image" content="{{ $UserData->image }}" />
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Edit Profile | WaifuWall">
	<meta name="twitter:image" content="{{ $UserData->image }}">

	@include("/Component/Assets")
</head>

<body>
	@include("/Component/Navbar")

	<section name="PostData" class="mx-3 my-3">
		<div class="bg-gray-800 intro-y box mt-5 px-5 pt-5 rounded-md">
			<div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
				<div class="flex flex-1 items-center justify-start px-5">
					<div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
						<img class="rounded-full object-cover h-20 w-20 sm:h-24 sm:w-24 lg:h-32 lg:w-32" src="{{ $UserData->image }}" alt="{{ $UserData->name }}">
					</div>
					<div class="ml-5 mb-1 truncate min-w-0">
						<div class="flex flex-row items-center">
							<h1 class="truncate text-lg font-medium text-white">
								{{ $UserData->name }}
							</h1>
							@if(is_null($UserData->validate_token))<svg class="ml-2 w-5 h-5 items-center justify-center text-sm font-semibold text-blue-800 bg-blue-400 rounded-full dark:bg-gray-700 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
								<path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
							</svg>@endif
						</div>
						<div class="text-white">Role: @if($UserData->role == 0)Admin @elseif($UserData->role == 1)Member @elseif($UserData->role == 2)Moderator @endif</div>
					</div>
				</div>
			</div>
			<ul role="tablist" class="w-full flex flex-col my-2 justify-center text-center sm:flex-row lg:justify-start">
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=account" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">Account</a>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=favorites" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">My Favorites</a>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=wallpapers" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">My Wallpapers</a>
				</li>
				<li role="presentation" class="focus-visible:outline-none">
					<a href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}?view=posts" role="tab" class="block hover:bg-gray-700 text-white font-medium py-2 px-5 mb-2 mx-2">My Posts</a>
				</li>
                <li role="presentation" class="focus-visible:outline-none">
					<span role="tab" class="block bg-gray-900 text-white font-medium py-2 px-5 mb-2 mx-2" aria-current="page">Edit Profile</span>
				</li>
			</ul>
		</div>
        
        <div class="grid sm:grid-cols-2 gap-10">
            <div class="flex flex-col">
                <div class="container mx-auto">
                    <h3 class="font-medium text-gray-900 text-left">Update Profile</h3>
                    @if(session()->has('msg'))
                    <div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                            <strong class="font-bold text-sm mr-4">{{ session()->get('msg') }}</strong>
                        </div>
                    </div>
                    @endif
                    @if(session()->has('errmsg'))
                    <div id="fileTooLarge" class="hidden bg-red-100 text-red-800 p-4 rounded-lg" role="alert">
                        <strong class="font-bold text-sm mr-4">Error!</strong>
                        <span class="block text-sm sm:inline max-sm:mt-2">{{ session()->get('errmsg') }}</span>
                    </div>
                    @endif
                </div>
                <form action="{{ url()->current() }}" method="POST" class="font-[sans-serif] m-6 w-full mx-auto" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="profile">
                    <div class="grid sm:grid-cols-1 gap-10">
                        <div class="flex flex-col items-center space-x-6">
                            <div class="shrink-0">
                                <img id='originalImage' class="h-25 w-25 object-cover rounded-full" src="{{ $UserData->image }}" />
                                <img id='imagePreview' class="hidden h-25 w-25 object-cover rounded-full" src="{{ $UserData->image }}" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input name="image" type="file" onchange="checkFileSize(event)" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700" accept="image/png, image/webp, image/jpeg"/>
                                <p class="mt-1 text-sm text-black">PNG, JPG or WEBP (Max 300KB)</p>
                                <div id="fileTooLarge" class="hidden bg-red-100 text-red-800 p-4 rounded-lg" role="alert">
                                    <strong class="font-bold text-sm mr-4">Error!</strong>
                                    <span class="block text-sm sm:inline max-sm:mt-2">Image size is too large!</span>
                                </div>
                            </label>
                        </div>

                        <div class="relative flex items-center">
                        <label class="text-[13px] bg-white text-black absolute px-2 top-[-10px] left-[18px]">Full Name</label>
                        <input type="text" name="fullname" value="{{ $UserData->name }}" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>
                        </div>
                    </div>

                    <button type="submit" id="saveProfile" class="mt-8 px-6 py-2.5 w-full text-sm bg-gray-800 text-white rounded hover:bg-gray-600 transition-all">Save</button>
                </form>
            </div>

            <div class="flex flex-col">
                <div class="container mx-auto">
                    <h3 class="font-medium text-gray-900 text-left">Change Password</h3>
                    @if(session()->has('pmsg'))
                    <div class="font-[sans-serif] space-y-6 py-3">
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg" role="alert">
                            <strong class="font-bold text-sm mr-4">{{ session()->get('pmsg') }}</strong>
                        </div>
                    </div>
                    @endif
                </div>
                <form action="{{ url()->current() }}" method="POST" class="font-[sans-serif] m-6 w-full mx-auto">
                    @csrf
                    <input type="hidden" name="type" value="password">
                    <div class="grid sm:grid-cols-2 gap-10">
                        <div class="relative flex items-center">
                        <label class="text-[13px] bg-white text-black absolute px-2 top-[-10px] left-[18px]">New Password</label>
                        <input type="password" name="password" value="" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                        </svg>
                        </div>

                        <div class="relative flex items-center">
                        <label class="text-[13px] bg-white text-black absolute px-2 top-[-10px] left-[18px]">Confirm New Password</label>
                        <input type="password" name="cpassword" value="" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                        </svg>
                        </div>
                    </div>

                    <button type="submit" class="mt-8 px-6 py-2.5 w-full text-sm bg-gray-800 text-white rounded hover:bg-gray-600 transition-all">Change Password</button>
                </form>
            </div>
        </div>
	</section>

	@include("/Component/Footer")
	@include("/Component/FooterScript")
</body>

<script>
    var originalImage = document.getElementById('originalImage');
    var imagePreview = document.getElementById('imagePreview');

    var checkFileSize = function(event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;
        
        const maxAllowedSize = 2400000;
        if (event.target.files[0].size > maxAllowedSize) {
            document.getElementById('fileTooLarge').classList.remove("hidden");
            imagePreview.classList.add("hidden");
            originalImage.classList.remove("hidden");
            event.target.value = null;
        }else{
            document.getElementById('fileTooLarge').classList.add("hidden");
            originalImage.classList.add("hidden");
            imagePreview.classList.remove("hidden");
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.onload = function() {
                URL.revokeObjectURL(imagePreview.src)
            }
        }
    };
</script>

</html>
