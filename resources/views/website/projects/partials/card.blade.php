{{-- Project card: image with category chip; title and location over a soft gradient; whole card is the link. --}}
@php
    $locale = $locale ?? app()->getLocale();
    $category = $project->t('category');
    $city = $project->t('city');
@endphp
<a href="{{ route('website.projects.show', $project->slug) }}"
   class="project-card group"
   data-project-card
   data-category="{{ $project->categoryKey() }}"
   aria-label="{{ $project->t('title') }}">
  <figure class="project-card__media">
    <x-website.image
      :src="$project->image"
      type="project"
      :seed="$project->id"
      :alt="$project->t('title')"
      class="project-card__img"
      loading="lazy"
      decoding="async"
      width="800"
      height="600"
    />
    <span class="project-card__shade" aria-hidden="true"></span>

    @if($category)
      <span class="project-card__chip">{{ $category }}</span>
    @endif

    <figcaption class="project-card__body">
      <h3 class="project-card__title">{{ $project->t('title') }}</h3>
      @if($city)
        <p class="project-card__meta">
          <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span>{{ $city }}</span>
        </p>
      @endif
      <span class="project-card__cta">
        {{ trans('website.projectViewDetails', [], $locale) }}
        <svg class="h-4 w-4 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </span>
    </figcaption>
  </figure>
</a>
