@php echo '<?xml version="1.0" encoding="UTF-8" ?>' @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($Data as $Wallpaper)
<url>
    <loc>{{ str_replace(request()->getHost(), $ServerDomain, url('/' . $Wallpaper['slug'])) }}</loc>
    <lastmod>{{ date(DATE_W3C, strtotime($Wallpaper["date_modified"])) }}</lastmod>
</url>
@endforeach
</urlset>