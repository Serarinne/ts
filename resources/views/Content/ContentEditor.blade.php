<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Add Post | WaifuWall</title>

	<link rel="canonical" href="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta name="description" content="Add Post" />
	<meta name="keywords" content="waifuwall, waifu wallpaper, anime girl wallpaper, 4k wallpaper, hd wallpaper, wallpaper smartphone, wallpaper pc, anime wallpaper, game wallpaper, anime waifu wallpaper, ai wallpaper" />
	<meta name="author" content="Serarinne" />
	<meta name="robots" content="noindex, nofollow" />
    <meta name="robots" content="max-image-preview:standard">
	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Add Post | WaifuWall" />
	<meta property="og:description" content="Add Post" />
	<meta property="og:url" content="{{ str_replace(request()->getHost(), $ServerDomain, url()->current()) }}" />
	<meta property="og:site_name" content="WaifuWall" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Add Post | WaifuWall" />
	<meta name="twitter:description" content="Add Post" />

	@include("Component/Assets")

    <link rel="stylesheet" href="/editor/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="/editor/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='/editor/richtexteditor/plugins/all_plugins.js'></script>
</head>

<body>
	@include("Component/Navbar")

	<form action="{{ url()->current() }}" method="POST" name="PostData" class="mx-3 my-3">
        @csrf
        <div class="flex flex-col font-[sans-serif] bg-gradient-to-r p-6">
            <div class="flex flex-col items-center space-x-6">
                <div class="shrink-0">
                    <img id='thumbnailImage' class="h-25 w-25 object-cover" src="https://cdn.iconscout.com/icon/free/png-256/free-no-image-icon-download-in-svg-png-gif-file-formats--picture-disable-sharing-site-pack-user-interface-icons-1505134.png" />
                </div>
                <label class="block">
                    <span class="sr-only">Thumbnail</span>
                    <input name="image" type="file" onchange="checkFileSize(event)" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700" accept="image/png, image/webp, image/jpeg"/>
                    <p class="mt-1 text-sm text-black">Thumbnail Ext: PNG, JPG or WEBP (Max 300KB)</p>
                    <div id="fileTooLarge" class="hidden bg-red-100 text-red-800 p-4 rounded-lg" role="alert">
                        <strong class="font-bold text-sm mr-4">Error!</strong>
                        <span class="block text-sm sm:inline max-sm:mt-2">Image size is too large!</span>
                    </div>
                </label>
            </div>
            <div class="w-full items-center my-2">
                <input type="text" name="title" value="" placeholder="Post title" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
            </div>
            <div class="w-full items-center my-2">
                <textarea id="postEditor" name="content"></textarea>
            </div>
            <div class="w-full items-center my-2">
                <input type="text" name="tag" value="" placeholder="Post tag (separate with ,)" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required/>
            </div>
            <div class="w-full items-center my-2">
                <textarea name="keyword" placeholder="Post keyword (for SEO)" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required></textarea>
            </div>
            <div class="w-full items-center my-2">
                <textarea name="description" placeholder="Post description (for SEO)" class="px-4 py-3.5 bg-white text-black w-full text-sm border-2 border-gray-100 focus:border-blue-500 rounded outline-none" required></textarea>
            </div>
        </div>
        <button type="submit" class="mt-8 px-6 py-2.5 w-full text-sm bg-gray-800 text-white rounded hover:bg-gray-600 transition-all">Post</button>
	</form>

	@include("Component/Footer")
	@include("Component/FooterScript")
</body>

<script>
    var thumbnailImage = document.getElementById('thumbnailImage');

    var checkFileSize = function(event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;
        
        const maxAllowedSize = 2400000;
        if (event.target.files[0].size > maxAllowedSize) {
            document.getElementById('fileTooLarge').classList.remove("hidden");
        }else{
            document.getElementById('fileTooLarge').classList.add("hidden");
            thumbnailImage.src = URL.createObjectURL(event.target.files[0]);
            thumbnailImage.onload = function() {
                URL.revokeObjectURL(thumbnailImage.src)
            }
        }
    };
</script>

<script>
	var config = {};
	config.file_upload_handler = function (file, callback, optionalIndex, optionalFiles) {
		var uploadhandlerpath = "/blog/upload-image";

		console.log("upload", file, "to", uploadhandlerpath)

		function append(parent, tagname, csstext) {
			var tag = parent.ownerDocument.createElement(tagname);
			if (csstext) tag.style.cssText = csstext;
			parent.appendChild(tag);
			return tag;
		}

		var uploadcancelled = false;

		var dialogouter = append(document.body, "div", "display:flex;align-items:center;justify-content:center;z-index:999999;position:fixed;left:0px;top:0px;width:100%;height:100%;background-color:rgba(128,128,128,0.5)");
		var dialoginner = append(dialogouter, "div", "background-color:white;border:solid 1px gray;border-radius:15px;padding:15px;min-width:200px;box-shadow:2px 2px 6px #7777");

		var line1 = append(dialoginner, "div", "text-align:center;font-size:1.2em;margin:0.5em;");
		line1.innerText = "Uploading...";

		var totalsize = file.size;
		var sentsize = 0;

		if (optionalFiles && optionalFiles.length > 1) {
			totalsize = 0;
			for (var i = 0; i < optionalFiles.length; i++) {
				totalsize += optionalFiles[i].size;
				if (i < optionalIndex) sentsize = totalsize;
			}
			console.log(totalsize, optionalIndex, optionalFiles)
			line1.innerText = "Uploading..." + (optionalIndex + 1) + "/" + optionalFiles.length;
		}

		var line2 = append(dialoginner, "div", "text-align:center;font-size:1.0em;margin:0.5em;");
		line2.innerText = "0%";

		var progressbar = append(dialoginner, "div", "border:solid 1px gray;margin:0.5em;");
		var progressbg = append(progressbar, "div", "height:12px");

		var line3 = append(dialoginner, "div", "text-align:center;font-size:1.0em;margin:0.5em;");
		var btn = append(line3, "button");
		btn.className = "btn btn-primary";
		btn.innerText = "cancel";
		btn.onclick = function () {
			uploadcancelled = true;
			xh.abort();
		}

		var xh = new XMLHttpRequest();
		xh.open("POST", uploadhandlerpath, true);
		xh.onload = xh.onabort = xh.onerror = function (pe) {
			console.log(pe);
			console.log(xh);
			dialogouter.parentNode.removeChild(dialogouter);
			console.log(xh.responseText);
			if (pe.type == "load") {
				if (xh.status != 200) {
					console.log("uploaderror", pe);
					if (xh.responseText.startsWith("ERROR:")) {
						callback(null, "http-error-" + xh.responseText.substring(6));
					}
					else {
						callback(null, "http-error-" + xh.status);
					}
				}
				else if (xh.responseText.startsWith("READY:")) {
					console.log("File uploaded to " + xh.responseText.substring(6));
					callback(xh.responseText.substring(6));
				}
				else {
					callback(null, "http-error-" + xh.responseText);
				}
			}
			else if (uploadcancelled) {
				console.log("uploadcancelled", pe);
				callback(null, "cancelled");
			}
			else {
				console.log("uploaderror", pe);
				callback(null, pe.type);
			}
		}
		xh.upload.onprogress = function (pe) {
			console.log(pe);
			//pe.total
			var percent = Math.floor(100 * (sentsize + pe.loaded) / totalsize);
			line2.innerText = percent + "%";

			progressbg.style.cssText = "background-color:green;width:" + (percent * progressbar.offsetWidth / 100) + "px;height:12px;";
		}
		var formData = new FormData();
		formData.append("image", file);
		xh.send(formData);
	}

	var editor1 = new RichTextEditor("#postEditor", config);
</script>
</html>