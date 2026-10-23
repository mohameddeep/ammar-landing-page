<!doctype html>
@php
  use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
  $currentLocale = LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
  app()->setLocale($currentLocale);
@endphp
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
      use App\Support\WebsiteMeta;
      use Illuminate\Support\Str;
      $siteTitle = $headerWebsiteName ?? config('app.name');
      $pageTitle = trim($__env->yieldContent('title'));
      if ($pageTitle === '') {
        $pageTitle = __('website.seoHomeTitle');
      }
      $fullTitle = $pageTitle.' | '.$siteTitle;
      $metaDescription = $__env->hasSection('meta_description')
        ? Str::limit(strip_tags(trim($__env->yieldContent('meta_description'))), 160, '')
        : WebsiteMeta::metaDescription();
      $ogImageSection = $__env->hasSection('og_image') ? trim($__env->yieldContent('og_image')) : null;
      $ogImage = WebsiteMeta::absoluteOgImage($ogImageSection !== '' ? $ogImageSection : null);
      $canonical = WebsiteMeta::canonicalUrl();
      $robotsDirectives = $__env->hasSection('robots')
        ? trim($__env->yieldContent('robots'))
        : (config('seo.noindex') ? 'noindex, nofollow' : 'index, follow');
      $ogType = $__env->hasSection('og_type') ? trim($__env->yieldContent('og_type')) : 'website';
    @endphp
    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}" />
    <meta name="robots" content="{{ $robotsDirectives }}" />
    <link rel="canonical" href="{{ $canonical }}" />
    @foreach (WebsiteMeta::hreflangAlternates() as $alt)
    <link rel="alternate" hreflang="{{ $alt['hreflang'] }}" href="{{ $alt['href'] }}" />
    @endforeach
    <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_SA' : 'en_US' }}" />
    @if(app()->getLocale() === 'ar')
    <meta property="og:locale:alternate" content="en_US" />
    @else
    <meta property="og:locale:alternate" content="ar_SA" />
    @endif
    <meta property="og:type" content="{{ e($ogType) }}" />
    <meta property="og:title" content="{{ $fullTitle }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:url" content="{{ $canonical }}" />
    <meta property="og:site_name" content="{{ $siteTitle }}" />
    @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{ $ogImage }}" />
    @else
    <meta name="twitter:card" content="summary" />
    @endif
    <meta name="twitter:title" content="{{ $fullTitle }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />
    @if(filled(config('seo.twitter_site')))
    <meta name="twitter:site" content="{{ config('seo.twitter_site') }}" />
    @endif
    <meta name="theme-color" content="#0f172a" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />
    <link rel="icon" href="{{ asset(\App\Support\WebsiteImage::MARK) }}" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="{{ asset('images/branding/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    @stack('seo-extra')
    @if(config('seo.json_ld_enabled', true))
    @php
      $orgLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $siteTitle,
        'url' => rtrim(config('app.url'), '/'),
      ];
      $orgLd['logo'] = asset('images/branding/icon-512.png');
      $webLd = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $siteTitle,
        'url' => rtrim(config('app.url'), '/'),
        'inLanguage' => ['ar', 'en'],
      ];
    @endphp
    <script type="application/ld+json">{!! json_encode($orgLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($webLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    @vite(['resources/css/website.css'])
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">

    {{-- Turbo Drive + تنقّل يحسّ إنه فوري: سكرول فور النقر، prefetch عند اللمس/المرور، شريط تقدم بدون تأخير --}}
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.13/dist/turbo.es2017-umd.js" defer></script>
    <script defer>
      (function () {
        function turboInstantFeedback() {
          try {
            if (window.Turbo && window.Turbo.config && window.Turbo.config.drive) {
              window.Turbo.config.drive.progressBarDelay = 0;
            }
          } catch (e) {}
        }

        function isInternalNavLink(a) {
          if (!a || a.getAttribute('data-turbo') === 'false') return false;
          if (a.target === '_blank' || a.hasAttribute('download')) return false;
          var href = a.getAttribute('href');
          if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return false;
          try {
            return new URL(a.href, window.location.origin).origin === window.location.origin;
          } catch (e) {
            return false;
          }
        }

        function markInternalLinksForPrefetch() {
          document.querySelectorAll('a[href]').forEach(function (a) {
            if (!isInternalNavLink(a)) return;
            if (a.hasAttribute('data-turbo-preload')) return;
            a.setAttribute('data-turbo-preload', '');
          });
        }

        /** أول ما تدوس: لفّ فوق فوراً عشان الإحساس إن الصفحة اتفتحت على طول */
        document.addEventListener('click', function (e) {
          var a = e.target.closest('a[href]');
          if (!a || e.defaultPrevented || !isInternalNavLink(a)) return;
          try {
            var u = new URL(a.href, window.location.origin);
            if (u.pathname === window.location.pathname && u.search === window.location.search) {
              if (u.hash) return;
              return;
            }
          } catch (err) {
            return;
          }
          window.scrollTo(0, 0);
        }, true);

        /** Prefetch من أول ما الماوس/الإصبع ينزل على الرابط (أسرع من الانتظار لحد الـ hover لوحده) */
        var prefetchQueue = [];
        var PREFETCH_MAX = 28;
        document.addEventListener('pointerdown', function (e) {
          if (e.pointerType === 'mouse' && e.button !== 0) return;
          var a = e.target.closest('a[href]');
          if (!isInternalNavLink(a)) return;
          var url;
          try {
            url = new URL(a.href, window.location.origin).href;
          } catch (err) {
            return;
          }
          if (prefetchQueue.indexOf(url) !== -1) return;
          prefetchQueue.push(url);
          if (prefetchQueue.length > PREFETCH_MAX) prefetchQueue.shift();
          var l = document.createElement('link');
          l.rel = 'prefetch';
          l.href = url;
          l.setAttribute('as', 'document');
          document.head.appendChild(l);
        }, true);

        function boot() {
          turboInstantFeedback();
          markInternalLinksForPrefetch();
        }
        document.addEventListener('turbo:load', boot);
        document.addEventListener('DOMContentLoaded', boot);

        /** Turbo copies <html lang> on render but not dir; keep both in sync with the new page. */
        document.addEventListener('turbo:before-render', function (e) {
          var newDoc = e.detail && e.detail.newBody && e.detail.newBody.ownerDocument;
          var newDir = newDoc && newDoc.documentElement && newDoc.documentElement.getAttribute('dir');
          if (newDir) document.documentElement.setAttribute('dir', newDir);
        });
      })();
    </script>
  </head>
  <body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
    @php
      $otherLocale = $currentLocale === 'ar' ? 'en' : 'ar';
      // Same page in the other language; keeps path segments (e.g. service id) and the query string.
      $switchUrl = LaravelLocalization::getLocalizedURL($otherLocale, request()->fullUrl(), [], true);
      $navItems = [
        ['url' => route('website.landing-page'), 'label' => trans('website.navHome', [], $currentLocale), 'active' => request()->routeIs('website.landing-page')],
        ['url' => route('website.services.index'), 'label' => trans('website.navServices', [], $currentLocale), 'active' => request()->routeIs('website.services.index', 'website.service.show'), 'services' => true],
        ['url' => route('website.projects.index'), 'label' => trans('website.navProjects', [], $currentLocale), 'active' => request()->routeIs('website.projects.*')],
        ['url' => route('website.about.index'), 'label' => trans('website.navAbout', [], $currentLocale), 'active' => request()->routeIs('website.about.index')],
        ['url' => route('website.contact.index'), 'label' => trans('website.navContact', [], $currentLocale), 'active' => request()->routeIs('website.contact.index')],
      ];
      $navServices = $navServices ?? collect();
      $chevron = '<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
      // Points toward the inline-start side, where the children flyout opens.
      $chevronStart = '<svg class="w-4 h-4 shrink-0 rtl:-scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>';
    @endphp
    <!-- Navigation -->
    <nav class="w-full bg-slate-900/95 backdrop-blur-xl z-50 border-b border-slate-700/50 shadow-lg shadow-slate-900/50 transition-all duration-300" id="navbar">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 sm:py-3">
        <div class="flex items-center justify-between gap-3">
          <!-- Logo (first in source order: right in RTL, left in LTR) -->
          <a href="{{ route('website.landing-page') }}" class="brand-logo group shrink-0" id="logoLink">
            <img src="{{ $headerLogo }}" alt="{{ trans('website.logoAlt', [], $currentLocale) }}" width="1269" height="243" class="brand-logo__img" data-fallback-src="{{ asset(\App\Support\WebsiteImage::LOGO) }}" onerror="this.onerror=null;if(this.src!==this.dataset.fallbackSrc){this.src=this.dataset.fallbackSrc;}" />
            <span class="sr-only">{{ $headerWebsiteName }}</span>
          </a>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex gap-2 items-center">
            @foreach($navItems as $item)
              @if(($item['services'] ?? false) && $navServices->isNotEmpty())
                {{-- Services dropdown: parents listed; hovering a parent opens its children (toward inline-start). --}}
                <div class="nav-dropdown relative">
                  <a href="{{ $item['url'] }}" class="nav-link inline-flex items-center gap-1 px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400 {{ $item['active'] ? 'active' : '' }}" aria-haspopup="true" @if($item['active']) aria-current="page" @endif>
                    {{ $item['label'] }} {!! $chevron !!}
                  </a>
                  <div class="nav-dropdown__panel">
                    <ul class="nav-dropdown__menu">
                      @foreach($navServices as $navParent)
                        <li class="nav-dropdown__item">
                          <a href="{{ route('website.service.show', $navParent->id) }}" class="nav-dropdown__link">
                            <span>{{ $navParent->t('title') }}</span>
                            @if($navParent->activeChildren->isNotEmpty())
                              {!! $chevronStart !!}
                            @endif
                          </a>
                          @if($navParent->activeChildren->isNotEmpty())
                            <div class="nav-dropdown__flyout">
                              <ul class="nav-dropdown__menu">
                                <li class="nav-dropdown__heading">{{ $navParent->t('title') }}</li>
                                @foreach($navParent->activeChildren as $navChild)
                                  <li><a href="{{ route('website.service.show', $navChild->id) }}" class="nav-dropdown__link">{{ $navChild->t('title') }}</a></li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                        </li>
                      @endforeach
                      <li class="nav-dropdown__footer">
                        <a href="{{ $item['url'] }}" class="nav-dropdown__link text-emerald-400">{{ trans('website.navServicesAll', [], $currentLocale) }}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              @else
                <a href="{{ $item['url'] }}" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400 {{ $item['active'] ? 'active' : '' }}" @if($item['active']) aria-current="page" @endif>{{ $item['label'] }}</a>
              @endif
            @endforeach
            <a href="{{ $switchUrl }}" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}" data-turbo="false" class="ms-2 px-4 py-2 bg-slate-800/80 hover:bg-emerald-500/20 hover:border-emerald-500/50 rounded-lg border border-slate-700 transition-all hover:scale-105 font-semibold text-sm" aria-label="{{ trans('website.switchLanguage', [], $currentLocale) }}">
              {{ $otherLocale === 'ar' ? 'العربية' : 'English' }}
            </a>
          </div>

          <!-- Mobile Menu Button -->
          <div class="flex lg:hidden items-center gap-3 relative z-50">
            <a href="{{ $switchUrl }}" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}" data-turbo="false" class="relative z-50 px-3 py-2 bg-slate-800/80 hover:bg-slate-700/80 rounded-lg border border-slate-700 transition-all font-semibold text-sm" aria-label="{{ trans('website.switchLanguage', [], $currentLocale) }}">
              {{ $otherLocale === 'ar' ? 'ع' : 'EN' }}
            </a>
            <button type="button" id="mobileMenuBtn" class="relative z-50 w-10 h-10 flex flex-col items-center justify-center gap-1.5 p-2 rounded-lg hover:bg-slate-800/80 transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500/50" aria-label="{{ trans('website.toggleMenu', [], $currentLocale) }}" aria-controls="mobileMenu" aria-expanded="false">
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Menu (drops down below the bar) -->
      <div id="mobileMenu" class="lg:hidden bg-slate-900 border-b border-slate-700/50 shadow-2xl -translate-y-2 opacity-0 invisible transition-all duration-300 ease-in-out z-40 mobile-menu-backdrop pointer-events-none">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-2">
          @foreach($navItems as $item)
            @if(($item['services'] ?? false) && $navServices->isNotEmpty())
              {{-- Services accordion: each parent expands to show its children. --}}
              <details class="mobile-services group/services" @if($item['active']) open @endif>
                <summary class="mobile-nav-link flex items-center justify-between px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30 cursor-pointer {{ $item['active'] ? 'active' : '' }}">
                  <span>{{ $item['label'] }}</span>
                  <span class="transition-transform group-open/services:rotate-180">{!! $chevron !!}</span>
                </summary>
                <div class="mt-1 ms-4 ps-3 border-s border-slate-700/60 space-y-1">
                  @foreach($navServices as $navParent)
                    @if($navParent->activeChildren->isNotEmpty())
                      <details class="group/parent">
                        <summary class="flex items-center justify-between px-3 py-2 rounded-lg text-slate-300 hover:text-emerald-400 cursor-pointer">
                          <span>{{ $navParent->t('title') }}</span>
                          <span class="transition-transform group-open/parent:rotate-180">{!! $chevron !!}</span>
                        </summary>
                        <div class="ms-3 ps-3 border-s border-slate-700/60 space-y-1 pb-1">
                          <a href="{{ route('website.service.show', $navParent->id) }}" class="block px-3 py-1.5 rounded-lg text-sm font-semibold text-emerald-400 hover:bg-emerald-500/10">{{ trans('website.viewDetails', [], $currentLocale) }}</a>
                          @foreach($navParent->activeChildren as $navChild)
                            <a href="{{ route('website.service.show', $navChild->id) }}" class="block px-3 py-1.5 rounded-lg text-sm text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10">{{ $navChild->t('title') }}</a>
                          @endforeach
                        </div>
                      </details>
                    @else
                      <a href="{{ route('website.service.show', $navParent->id) }}" class="block px-3 py-2 rounded-lg text-slate-300 hover:text-emerald-400">{{ $navParent->t('title') }}</a>
                    @endif
                  @endforeach
                  <a href="{{ $item['url'] }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-emerald-400 hover:bg-emerald-500/10">{{ trans('website.navServicesAll', [], $currentLocale) }}</a>
                </div>
              </details>
            @else
              <a href="{{ $item['url'] }}" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30 {{ $item['active'] ? 'active' : '' }}" @if($item['active']) aria-current="page" @endif>{{ $item['label'] }}</a>
            @endif
          @endforeach
        </div>
      </div>
    </nav>
    <script>
      (function () {
        var btn = document.getElementById('mobileMenuBtn');
        var menu = document.getElementById('mobileMenu');
        if (!btn || !menu) return;
        function setOpen(open) {
          btn.classList.toggle('active', open);
          btn.setAttribute('aria-expanded', open ? 'true' : 'false');
          menu.classList.toggle('is-open', open);
          ['-translate-y-2', 'opacity-0', 'invisible', 'pointer-events-none'].forEach(function (c) { menu.classList.toggle(c, !open); });
        }
        btn.addEventListener('click', function (e) {
          e.stopPropagation();
          setOpen(!menu.classList.contains('is-open'));
        });
        menu.addEventListener('click', function (e) {
          if (e.target.closest('a')) setOpen(false);
        });
        document.addEventListener('click', function (e) {
          if (menu.classList.contains('is-open') && !menu.contains(e.target) && !btn.contains(e.target)) setOpen(false);
        });
        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape' && menu.classList.contains('is-open')) { setOpen(false); btn.focus(); }
        });
      })();
    </script>
