{{--
  Sub-services of a parent service card. The count badge is always visible; the list
  expands on card hover/focus (mouse devices) and stays open on touch devices.
  Expects $service->activeChildren to be eager-loaded.
--}}
@props(['service'])
@php
    $locale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale();
    $children = $service->activeChildren;
@endphp
@if($children->isNotEmpty())
  <div {{ $attributes->merge(['class' => 'relative z-10']) }}>
    <span class="mt-4 inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">
      <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h10"/></svg>
      {{ trans('website.subServicesCount', ['count' => $children->count()], $locale) }}
    </span>
    <ul class="service-children space-y-1.5 text-start" aria-label="{{ trans('website.showSubServices', ['name' => $service->t('title')], $locale) }}">
      @foreach($children as $child)
        <li>
          <a href="{{ route('website.service.show', $child->id) }}" class="group/child flex items-center gap-2 rounded-lg px-2 py-1.5 text-sm text-slate-300 transition-colors hover:bg-emerald-500/10 hover:text-emerald-400">
            <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-500"></span>
            <span>{{ $child->t('title') }}</span>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endif
