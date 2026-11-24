<?php

return [

    'noindex' => (bool) env('SEO_NOINDEX', false),

    // Public origin used for canonical, hreflang, Open Graph and sitemap URLs (defaults to APP_URL).
    'site_url' => env('SEO_SITE_URL', ''),

    'twitter_site' => env('SEO_TWITTER_SITE', ''),

    'og_image' => env('SEO_OG_IMAGE', ''),

    'json_ld_enabled' => (bool) env('SEO_JSON_LD', true),

];
