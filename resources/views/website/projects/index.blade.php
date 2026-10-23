@extends('website.layouts.app')
@section('title', trans('website.projectsTitle'))
@section('meta_description', trans('website.seoProjectsDescription'))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
    @endphp

    <!-- Page Hero -->
    <section class="projects-hero relative overflow-hidden px-6 pt-14 pb-12 md:pt-20 md:pb-16">
      <div class="projects-hero__grid" aria-hidden="true"></div>
      <div class="absolute top-10 start-10 h-72 w-72 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 end-10 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>

      <div class="relative mx-auto max-w-4xl text-center">
        <span class="mb-5 inline-block rounded-full border border-emerald-500/30 bg-emerald-500/15 px-5 py-2 text-sm font-semibold text-emerald-300">
          {{ trans('website.projectsBadge', [], $currentLocale) }}
        </span>
        <h1 class="section-title mb-5 font-bold">{{ trans('website.projectsTitle', [], $currentLocale) }}</h1>
        <p class="mx-auto max-w-3xl text-lg leading-relaxed text-slate-300 md:text-xl">
          {{ trans('website.projectsSubtitle', [], $currentLocale) }}
        </p>
        @if($projects->isNotEmpty())
          <p class="mt-6 text-sm font-semibold text-slate-400">{{ trans('website.projectsCount', ['count' => $projects->count()], $currentLocale) }}</p>
        @endif
      </div>
    </section>

    <!-- Projects Gallery -->
    <section class="px-6 pb-24" id="projects-gallery">
      <div class="mx-auto max-w-7xl">
        @if($projects->isEmpty())
          <div class="rounded-3xl border border-slate-700/50 bg-slate-800/30 px-6 py-20 text-center">
            <p class="text-lg text-slate-400">{{ trans('website.projectsEmpty', [], $currentLocale) }}</p>
          </div>
        @else
          @if($categories->count() > 1)
            <div class="mb-10 flex flex-wrap justify-center gap-2" role="group" aria-label="{{ trans('website.projectsFilterLabel', [], $currentLocale) }}" data-project-filters>
              <button type="button" class="project-filter is-active" data-filter="all" aria-pressed="true">{{ trans('website.projectsAll', [], $currentLocale) }}</button>
              @foreach($categories as $category)
                <button type="button" class="project-filter" data-filter="{{ $category['key'] }}" aria-pressed="false">{{ $category['label'] }}</button>
              @endforeach
            </div>
          @endif

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8" data-project-grid>
            @foreach($projects as $project)
              @include('website.projects.partials.card', ['project' => $project, 'locale' => $currentLocale])
            @endforeach
          </div>

          <p class="hidden py-16 text-center text-slate-400" data-project-filter-empty>{{ trans('website.projectsFilterEmpty', [], $currentLocale) }}</p>
        @endif
      </div>
    </section>

    @push('scripts')
    <script>
      (function () {
        var filters = document.querySelector('[data-project-filters]');
        if (!filters) return;
        var cards = document.querySelectorAll('[data-project-card]');
        var empty = document.querySelector('[data-project-filter-empty]');

        filters.addEventListener('click', function (e) {
          var button = e.target.closest('[data-filter]');
          if (!button) return;
          var filter = button.getAttribute('data-filter');
          var visible = 0;

          filters.querySelectorAll('[data-filter]').forEach(function (b) {
            var active = b === button;
            b.classList.toggle('is-active', active);
            b.setAttribute('aria-pressed', active ? 'true' : 'false');
          });

          cards.forEach(function (card) {
            var show = filter === 'all' || card.getAttribute('data-category') === filter;
            card.hidden = !show;
            if (show) visible++;
          });

          if (empty) empty.classList.toggle('hidden', visible > 0);
        });
      })();
    </script>
    @endpush

@endsection
