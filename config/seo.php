<?php

return [

    'noindex' => (bool) env('SEO_NOINDEX', false),

    'twitter_site' => env('SEO_TWITTER_SITE', ''),

    'og_image' => env('SEO_OG_IMAGE', ''),

    'json_ld_enabled' => (bool) env('SEO_JSON_LD', true),

];
