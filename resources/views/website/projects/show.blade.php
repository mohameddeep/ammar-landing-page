@extends('website.layouts.app')
@section('title', $project->t('title'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags((string) ($project->t('summary') ?: $project->t('content') ?: $project->t('title'))), 160))
@section('og_type', 'article')
@section('og_image', \App\Support\WebsiteImage::url($project->image, 'project', $project->id))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      $title = $project->t('title');

      // Main image first, then the gallery; all open in the lightbox.
      $galleryImages = collect([$project->image])
        ->merge($project->images->pluck('image'))
        ->filter()
        ->values();
      if ($galleryImages->isEmpty()) {
        $galleryImages = collect([null]);
      }

      $details = collect([
        ['label' => trans('website.projectCategory', [], $currentLocale), 'value' => $project->t('category'), 'icon' => 'M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
        ['label' => trans('website.projectCity', [], $currentLocale), 'value' => $project->t('city'), 'icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        ['label' => trans('website.projectClient', [], $currentLocale), 'value' => $project->t('client'), 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['label' => trans('website.projectArea', [], $currentLocale), 'value' => $project->area, 'icon' => 'M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4'],
        ['label' => trans('website.projectYear', [], $currentLocale), 'value' => $project->year, 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
      ])->filter(fn ($row) => filled($row['value']));

      $whatsappDigits = preg_replace('/\D/', '', (string) ($footerContent['all']['whatsapp'] ?? $footerContent['whatsapp'] ?? ''));
      $whatsappUrl = $whatsappDigits !== ''
        ? 'https://wa.me/'.$whatsappDigits.'?text='.rawurlencode(trans('website.whatsappServiceMessage', ['service' => $title], $currentLocale))
        : null;
    @endphp

    <!-- Project Hero -->
    <section class="project-hero relative overflow-hidden">
      <x-website.image
        :src="$project->image"
        type="project"
        :seed="$project->id"
        :alt="$title"
        class="project-hero__img"
        loading="eager"
        fetchpriority="high"
        decoding="async"
      />
      <div class="project-hero__shade" aria-hidden="true"></div>
      <div class="relative mx-auto flex min-h-[inherit] max-w-7xl flex-col justify-end px-6 pb-10 pt-24 md:pb-14">
        <nav aria-label="{{ trans('website.breadcrumb', [], $currentLocale) }}" class="mb-6 flex flex-wrap items-center gap-2 text-sm text-slate-300">
          <a href="{{ route('website.landing-page') }}" class="transition hover:text-emerald-400">{{ trans('website.home', [], $currentLocale) }}</a>
          <span aria-hidden="true">/</span>
          <a href="{{ route('website.projects.index') }}" class="transition hover:text-emerald-400">{{ trans('website.projectsTitle', [], $currentLocale) }}</a>
          <span aria-hidden="true">/</span>
          <span class="text-white" aria-current="page">{{ $title }}</span>
        </nav>
        <div class="max-w-3xl">
          @if($project->t('category'))
            <span class="mb-4 inline-block rounded-full border border-emerald-400/40 bg-emerald-500/20 px-4 py-1.5 text-sm font-semibold text-emerald-200 backdrop-blur-sm">{{ $project->t('category') }}</span>
          @endif
          <h1 class="section-title mb-3 font-bold text-white">{{ $title }}</h1>
          @if($project->t('city'))
            <p class="flex items-center gap-2 text-lg text-slate-200">
              <svg class="h-5 w-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              {{ $project->t('city') }}
            </p>
          @endif
        </div>
      </div>
    </section>

    <!-- Overview + Details -->
    <section class="px-6 py-16">
      <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-3">
        <div class="lg:col-span-2">
          <h2 class="mb-5 text-2xl font-bold text-white md:text-3xl">{{ trans('website.projectOverview', [], $currentLocale) }}</h2>
          @if($project->t('summary'))
            <p class="mb-6 text-lg leading-relaxed text-slate-200">{{ $project->t('summary') }}</p>
          @endif
          @if($project->t('content'))
            <div class="project-content text-slate-300 leading-loose">{!! $project->t('content') !!}</div>
          @endif
        </div>

        <aside class="h-fit rounded-3xl border border-slate-700/60 bg-slate-800/40 p-6 lg:sticky lg:top-28">
          @if($details->isNotEmpty())
            <h2 class="mb-5 text-lg font-bold text-white">{{ trans('website.projectDetails', [], $currentLocale) }}</h2>
            <dl class="space-y-4">
              @foreach($details as $row)
                <div class="flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $row['icon'] }}"/></svg>
                  </span>
                  <div>
                    <dt class="text-sm text-slate-400">{{ $row['label'] }}</dt>
                    <dd class="font-semibold text-white">{{ $row['value'] }}</dd>
                  </div>
                </div>
              @endforeach
            </dl>
            <hr class="my-6 border-slate-700/60">
          @endif

          <p class="mb-2 font-bold text-white">{{ trans('website.projectCtaTitle', [], $currentLocale) }}</p>
          <p class="mb-5 text-sm leading-relaxed text-slate-400">{{ trans('website.projectCtaDesc', [], $currentLocale) }}</p>
          <div class="flex flex-col gap-3">
            <a href="{{ route('website.contact.index') }}" class="rounded-full bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-3 text-center font-semibold text-white shadow-lg shadow-emerald-500/30 transition hover:from-emerald-600 hover:to-emerald-700">
              {{ trans('website.bookConsultation', [], $currentLocale) }}
            </a>
            @if($whatsappUrl)
              <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" data-turbo="false" class="rounded-full border border-[#25d366]/60 bg-[#25d366]/10 px-6 py-3 text-center font-semibold text-[#25d366] transition hover:bg-[#25d366] hover:text-white">
                {{ trans('website.whatsappCta', [], $currentLocale) }}
              </a>
            @endif
          </div>
        </aside>
      </div>
    </section>

    <!-- Gallery -->
    <section class="border-t border-slate-700/50 px-6 py-16" aria-labelledby="project-gallery-title">
      <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-3">
          <h2 id="project-gallery-title" class="text-2xl font-bold text-white md:text-3xl">{{ trans('website.projectGallery', [], $currentLocale) }}</h2>
          <p class="text-sm text-slate-400">{{ trans('website.projectGalleryHint', [], $currentLocale) }}</p>
        </div>
        <div class="project-gallery" data-lightbox-gallery>
          @foreach($galleryImages as $index => $image)
            @php $imageAlt = trans('website.projectImageAlt', ['project' => $title, 'number' => $index + 1], $currentLocale); @endphp
            <button type="button" class="project-gallery__item {{ $index === 0 ? 'project-gallery__item--lead' : '' }}" data-lightbox-index="{{ $index }}" aria-label="{{ $imageAlt }}">
              <x-website.image :src="$image" type="project" :seed="$project->id + $index" :alt="$imageAlt" class="project-gallery__img" loading="lazy" decoding="async" />
            </button>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="project-lightbox" role="dialog" aria-modal="true" aria-label="{{ trans('website.lightboxLabel', [], $currentLocale) }}" aria-hidden="true" hidden>
      <button type="button" class="lightbox__close" data-lightbox-close aria-label="{{ trans('website.lightboxClose', [], $currentLocale) }}">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      @if($galleryImages->count() > 1)
        <button type="button" class="lightbox__nav lightbox__nav--prev" data-lightbox-prev aria-label="{{ trans('website.lightboxPrev', [], $currentLocale) }}">
          <svg class="h-7 w-7 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" class="lightbox__nav lightbox__nav--next" data-lightbox-next aria-label="{{ trans('website.lightboxNext', [], $currentLocale) }}">
          <svg class="h-7 w-7 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      @endif
      <figure class="lightbox__figure">
        <img class="lightbox__img" alt="" data-lightbox-image>
        <figcaption class="lightbox__caption"><span data-lightbox-counter dir="ltr"></span></figcaption>
      </figure>
    </div>

    <!-- Related Projects -->
    @if($relatedProjects->isNotEmpty())
      <section class="border-t border-slate-700/50 bg-slate-800/20 px-6 py-16">
        <div class="mx-auto max-w-7xl">
          <div class="mb-10 flex flex-wrap items-end justify-between gap-4">
            <div>
              <h2 class="mb-2 text-2xl font-bold text-white md:text-3xl">{{ trans('website.relatedProjects', [], $currentLocale) }}</h2>
              <p class="text-slate-400">{{ trans('website.relatedProjectsDesc', [], $currentLocale) }}</p>
            </div>
            <a href="{{ route('website.projects.index') }}" class="font-semibold text-emerald-400 hover:text-emerald-300">{{ trans('website.backToProjects', [], $currentLocale) }}</a>
          </div>
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            @foreach($relatedProjects as $related)
              @include('website.projects.partials.card', ['project' => $related, 'locale' => $currentLocale])
            @endforeach
          </div>
        </div>
      </section>
    @endif

    @push('scripts')
    <script>
      (function () {
        var box = document.getElementById('project-lightbox');
        var gallery = document.querySelector('[data-lightbox-gallery]');
        if (!box || !gallery) return;

        // Sources come from the rendered thumbnails, so local fallbacks are reused.
        var thumbs = Array.prototype.slice.call(gallery.querySelectorAll('img'));
        var img = box.querySelector('[data-lightbox-image]');
        var counter = box.querySelector('[data-lightbox-counter]');
        var current = 0;
        var lastFocus = null;
        var isRtl = function () { return document.documentElement.dir === 'rtl'; };

        function show(index) {
          current = (index + thumbs.length) % thumbs.length;
          var thumb = thumbs[current];
          img.src = thumb.currentSrc || thumb.src;
          img.alt = thumb.alt;
          img.dataset.fallbackSrc = thumb.dataset.fallbackSrc || '';
          img.onerror = function () { img.onerror = null; if (img.dataset.fallbackSrc) img.src = img.dataset.fallbackSrc; };
          if (counter) counter.textContent = (current + 1) + ' / ' + thumbs.length;
        }

        function open(index) {
          lastFocus = document.activeElement;
          show(index);
          box.hidden = false;
          box.setAttribute('aria-hidden', 'false');
          document.body.style.overflow = 'hidden';
          requestAnimationFrame(function () { box.classList.add('is-open'); });
          box.querySelector('[data-lightbox-close]').focus();
        }

        function close() {
          box.classList.remove('is-open');
          box.setAttribute('aria-hidden', 'true');
          document.body.style.overflow = '';
          setTimeout(function () { box.hidden = true; }, 200);
          if (lastFocus) lastFocus.focus();
        }

        gallery.addEventListener('click', function (e) {
          var item = e.target.closest('[data-lightbox-index]');
          if (item) open(parseInt(item.getAttribute('data-lightbox-index'), 10) || 0);
        });

        box.addEventListener('click', function (e) {
          if (e.target.closest('[data-lightbox-close]') || e.target === box) return close();
          if (e.target.closest('[data-lightbox-next]')) return show(current + 1);
          if (e.target.closest('[data-lightbox-prev]')) return show(current - 1);
        });

        function onKey(e) {
          if (box.hidden) return;
          if (e.key === 'Escape') return close();
          // Arrow keys follow reading direction: "forward" is left in Arabic, right in English.
          if (e.key === 'ArrowRight') show(current + (isRtl() ? -1 : 1));
          if (e.key === 'ArrowLeft') show(current + (isRtl() ? 1 : -1));
        }
        document.addEventListener('keydown', onKey);
        document.addEventListener('turbo:before-render', function () {
          document.removeEventListener('keydown', onKey);
          document.body.style.overflow = '';
        }, { once: true });

        var touchX = null;
        box.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].clientX; }, { passive: true });
        box.addEventListener('touchend', function (e) {
          if (touchX === null) return;
          var dx = e.changedTouches[0].clientX - touchX;
          touchX = null;
          if (Math.abs(dx) < 50) return;
          var forward = isRtl() ? dx > 0 : dx < 0;
          show(current + (forward ? 1 : -1));
        });
      })();
    </script>
    @endpush

@endsection
