{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($urls as $row)
  <url>
    <loc>{{ $row['loc'] }}</loc>
@foreach ($row['alternates'] as $alt)
    <xhtml:link rel="alternate" hreflang="{{ $alt['hreflang'] }}" href="{{ $alt['href'] }}" />
@endforeach
@if ($row['lastmod'])
    <lastmod>{{ $row['lastmod'] }}</lastmod>
@endif
    <changefreq>{{ $row['changefreq'] }}</changefreq>
    <priority>{{ $row['priority'] }}</priority>
  </url>
@endforeach
</urlset>
