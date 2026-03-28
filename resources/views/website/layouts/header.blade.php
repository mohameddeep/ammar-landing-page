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
    @stack('seo-extra')
    @if(config('seo.json_ld_enabled', true))
    @php
      $orgLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $siteTitle,
        'url' => rtrim(config('app.url'), '/'),
      ];
      if ($ogImage) {
        $orgLd['logo'] = $ogImage;
      }
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
      })();
    </script>
  </head>
  <body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-slate-900/95 backdrop-blur-xl z-50 border-b border-slate-700/50 shadow-lg shadow-slate-900/50 transition-all duration-300" id="navbar">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 sm:py-3 lg:py-4">
        <div class="flex items-center justify-between">
          <!-- Logo -->
          <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="flex items-center gap-2 group" id="logoLink">
            @if(isset($headerLogo) && $headerLogo)
              <img src="{{ asset($headerLogo) }}" alt="{{ $headerWebsiteName ?? 'البناء المتقدم' }}" class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 object-contain rounded-xl flex-shrink-0 group-hover:scale-110 transition-transform" />
            @else
              <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-all group-hover:scale-110 flex-shrink-0">
                <span class="text-white font-bold text-base sm:text-lg lg:text-xl">🏗</span>
              </div>
            @endif
            <span class="text-lg sm:text-xl lg:text-2xl font-bold leading-tight gradient-text logo-text relative inline-block px-4 py-2 rounded-lg transition-all duration-300" data-i18n="companyName">{{ $headerWebsiteName ?? 'البناء المتقدم' }}</span>
          </a>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex gap-2 items-center">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400">{{ trans('website.navHome', [], $currentLocale) }}</a>
            <a href="{{ LaravelLocalization::localizeUrl('/services') }}" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400">{{ trans('website.navServices', [], $currentLocale) }}</a>
            <a href="{{ LaravelLocalization::localizeUrl('/about-us') }}" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400">{{ trans('website.navAbout', [], $currentLocale) }}</a>
            <a href="{{ route('website.contact.index') }}" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400">{{ trans('website.navContact', [], $currentLocale) }}</a>
            @php
              $otherLocale = $currentLocale === 'ar' ? 'en' : 'ar';
              $switchUrl = LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
            @endphp
            <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL(app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="ml-2 px-4 py-2 bg-slate-800/80 hover:bg-emerald-500/20 hover:border-emerald-500/50 rounded-lg border border-slate-700 transition-all hover:scale-105 font-semibold text-sm">
              {{ strtoupper($otherLocale) }}
            </a>
          </div>

          <!-- Mobile Menu Button -->
          <div class="flex lg:hidden items-center gap-3 relative z-50">
            @php
              $otherLocale = $currentLocale === 'ar' ? 'en' : 'ar';
              $switchUrl = LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
            @endphp
            <a href="{{ $switchUrl }}" class="relative z-50 px-3 py-2 bg-slate-800/80 hover:bg-slate-700/80 rounded-lg border border-slate-700 transition-all font-semibold text-sm">
              {{ strtoupper($otherLocale) }}
            </a>
            <button id="mobileMenuBtn" class="relative z-50 w-10 h-10 flex flex-col items-center justify-center gap-1.5 p-2 rounded-lg hover:bg-slate-800/80 transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500/50" aria-label="Toggle menu">
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
              <span class="mobile-menu-line w-6 h-0.5 bg-white transition-all duration-300 origin-center"></span>
            </button>
          </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden fixed left-0 right-0 bg-slate-900 backdrop-blur-2xl border-b border-slate-700/50 shadow-2xl transform -translate-y-full opacity-0 transition-all duration-300 ease-in-out z-40 mobile-menu-backdrop pointer-events-none">
          <div class="max-w-7xl mx-auto px-4 py-4 space-y-2">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30">{{ trans('website.navHome', [], $currentLocale) }}</a>
            <a href="{{ LaravelLocalization::localizeUrl('/services') }}" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30">{{ trans('website.navServices', [], $currentLocale) }}</a>
            <a href="{{ LaravelLocalization::localizeUrl('/about-us') }}" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30">{{ trans('website.navAbout', [], $currentLocale) }}</a>
            <a href="{{ route('website.contact.index') }}" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30">{{ trans('website.navContact', [], $currentLocale) }}</a>
          </div>
        </div>
      </div>
    </nav>