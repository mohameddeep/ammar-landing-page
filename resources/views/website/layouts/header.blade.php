<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>البناء المتقدم - خدمات البناء والتراخيص</title>
        <title> @lang('website.Home') | @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/landingpage/index.css') }}">
  </head>
  <body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-slate-900/95 backdrop-blur-xl z-50 border-b border-slate-700/50 shadow-lg shadow-slate-900/50 transition-all duration-300" id="navbar">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 sm:py-3 lg:py-4">
        <div class="flex items-center justify-between">
          <!-- Logo -->
          <a href="/landing-page" class="flex items-center gap-2 group" id="logoLink">
            <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-all group-hover:scale-110 flex-shrink-0">
              <span class="text-white font-bold text-base sm:text-lg lg:text-xl">🏗</span>
            </div>
            <span class="text-lg sm:text-xl lg:text-2xl font-bold  leading-tight" data-i18n="companyName">البناء المتقدم</span>
          </a>

          <!-- Desktop Navigation -->
          <div class="hidden lg:flex gap-2 items-center">
            <a href="/services" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400" data-i18n="navServices">الخدمات</a>
            <a href="/about-us" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400" data-i18n="navAbout">من نحن</a>
            <a href="/contact-us" class="nav-link px-4 py-2 rounded-lg font-medium transition-all hover:bg-emerald-500/10 hover:text-emerald-400" data-i18n="navContact">اتصل بنا</a>
            <button id="langBtn" class="ml-2 px-4 py-2 bg-slate-800/80 hover:bg-emerald-500/20 hover:border-emerald-500/50 rounded-lg border border-slate-700 transition-all hover:scale-105 font-semibold text-sm">EN</button>
          </div>

          <!-- Mobile Menu Button -->
          <div class="flex lg:hidden items-center gap-3 relative z-50">
            <button id="langBtnMobile" class="relative z-50 px-3 py-2 bg-slate-800/80 hover:bg-slate-700/80 rounded-lg border border-slate-700 transition-all font-semibold text-sm">EN</button>
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
            <a href="#services" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30" data-i18n="navServices">الخدمات</a>
            <a href="#about" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30" data-i18n="navAbout">من نحن</a>
            <a href="#contact" class="mobile-nav-link block px-4 py-2.5 rounded-xl font-medium text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-400 transition-all border border-transparent hover:border-emerald-500/30" data-i18n="navContact">اتصل بنا</a>
          </div>
        </div>
      </div>
    </nav>