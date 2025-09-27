@php echo '<?xml version="1.0" encoding="UTF-8" ?>' @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($Data as $Wallpaper)
  @php
  if(str_contains($Wallpaper['image'], "png")){
      $fileExt = ".png";
      $fileDirectory = "image/";
  }elseif(str_contains($Wallpaper['image'], "jpg")){
      $fileExt = ".jpg";
      $fileDirectory = "image/";
  }elseif(str_contains($Wallpaper['image'], "jpeg")){
      $fileExt = ".jpeg";
      $fileDirectory = "image/";
  }elseif(str_contains($Wallpaper['image'], "mp4")){
      $fileExt = ".mp4";
      $fileDirectory = "video/";
  }
  @endphp
<url>
    <loc>{{ str_replace(request()->getHost(), $ServerDomain, url('/' . $Wallpaper['slug'])) }}</loc>
    <image:image>
        <image:loc>@include('/Component/ImageUrl')/{{$fileDirectory}}{{$Wallpaper['id']}}{{$fileExt}}</image:loc>
    </image:image>
    <lastmod>{{ date(DATE_W3C, strtotime($Wallpaper["date_modified"])) }}</lastmod>
</url>
@endforeach
</urlset>