@php echo '<?xml version="1.0" encoding="UTF-8" ?>' @endphp
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @for ($i = 1; $i <= $Data; $i++)
        <sitemap>
            <loc>{{ str_replace(request()->getHost(), $ServerDomain, url('/sitemap-character-' . $i . '.xml')) }}</loc>
            <lastmod>{{ date(DATE_W3C, strtotime($Date[$i-1]->date_modified)) }}</lastmod>
        </sitemap>
    @endfor
</sitemapindex>