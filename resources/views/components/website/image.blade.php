{{--
  Public website image with a local fallback.
  - Server side: empty or missing images resolve to a local default (App\Support\WebsiteImage).
  - Browser side: if the image still fails (e.g. a remote URL returns an error), it swaps to the
    fallback once; onerror is cleared first so a failing fallback can never loop.
--}}
@props([
    'src' => null,
    'type' => 'generic',
    'seed' => null,
    'alt' => '',
])
@php
    $fallbackSrc = \App\Support\WebsiteImage::fallback($type, $seed);
    $resolvedSrc = \App\Support\WebsiteImage::url($src, $type, $seed);
@endphp
<img
  src="{{ $resolvedSrc }}"
  alt="{{ $alt }}"
  data-fallback-src="{{ $fallbackSrc }}"
  onerror="this.onerror=null;if(this.dataset.fallbackSrc&&this.src!==this.dataset.fallbackSrc){this.src=this.dataset.fallbackSrc;}"
  {{ $attributes }}
/>
