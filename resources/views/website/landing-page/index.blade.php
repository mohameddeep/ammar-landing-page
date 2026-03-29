
@extends('website.layouts.app')
@section('title', __('website.Home'))
@section('meta_description', __('website.seoHomeDescription'))
@section('content')
    <!-- Hero Slider Section -->
    <section class=" pb-20 px-6 relative overflow-hidden hero-slider min-h-[90vh] flex items-center">
      <!-- Background Effects -->
      <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900"></div>
      <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>

      <div class="max-w-7xl mx-auto relative w-full">
        @forelse($sliders as $index => $slider)
          <div class="slide {{ $index === 0 ? 'active' : '' }} slide-bg-{{ $index + 1 }}">
            <div class="slide-image-wrapper">
              <img 
                src="@image($slider->image)" 
                alt="{{ $slider->t('title_one') }}" 
                class="slide-image"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                decoding="async"
                fetchpriority="{{ $index === 0 ? 'high' : 'low' }}"
              />
              <div class="slide-overlay"></div>
            </div>
            <div class="text-center slide-content py-20 relative z-10">
              @if($slider->t('title_one'))
                <div class="mb-6 inline-block">
                  <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm inline-flex items-center gap-2">
                    <img src="/assets/images/icons/sex.svg" alt="icon" class="w-5 h-5 object-contain" />
                    {{ $slider->t('title_one') }}
                  </span>
                </div>
              @endif
              <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
                @if($slider->t('title_two'))
                  <span>{{ $slider->t('title_two') }}</span>
                @endif
                @if($slider->t('title_three'))
                  <span class="block gradient-text mt-2 {{ $index === 0 ? 'animate-float' : '' }}">{{ $slider->t('title_three') }}</span>
                @endif
              </h1>
              @if($slider->t('content'))
                <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10">
                  {{ $slider->t('content') }}
                </p>
              @endif
            </div>
          </div>
        @empty
          <!-- Default slide if no sliders -->
          <div class="slide active slide-bg-1">
            <div class="slide-image-wrapper">
              <img 
                src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                alt="Modern Construction Building" 
                class="slide-image"
                loading="eager"
                decoding="async"
                fetchpriority="high"
              />
              <div class="slide-overlay"></div>
            </div>
            <div class="text-center slide-content py-20 relative z-10">
              <div class="mb-6 inline-block">
                <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm inline-flex items-center gap-2">
                  <img src="/assets/images/icons/sex.svg" alt="icon" class="w-5 h-5 object-contain" />
                  🏗️ خبرة 15+ سنة
                </span>
              </div>
              <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
                <span>شريكك الموثوق في</span>
                <span class="block gradient-text mt-2 animate-float">البناء والتراخيص</span>
              </h1>
              <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10">
                نقدم خدمات متكاملة في إصدار التراخيص والإشراف على المشاريع والمقاولات بأعلى معايير الجودة والاحترافية
              </p>
            </div>
          </div>
        @endforelse

        <!-- Navigation Arrows -->
        <button id="prevBtn" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 slider-nav-btn w-14 h-14 bg-slate-800/80 backdrop-blur-sm border border-slate-700 rounded-full flex items-center justify-center text-white hover:bg-emerald-500/20 hover:border-emerald-500 transition-all">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button id="nextBtn" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 slider-nav-btn w-14 h-14 bg-slate-800/80 backdrop-blur-sm border border-slate-700 rounded-full flex items-center justify-center text-white hover:bg-emerald-500/20 hover:border-emerald-500 transition-all">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>

        <!-- Slider Dots -->
        @if($sliders->count() > 0)
          <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex gap-3">
            @foreach($sliders as $index => $slider)
              <button class="slider-dot w-3 h-3 rounded-full bg-slate-600 hover:bg-emerald-500 transition-all {{ $index === 0 ? 'active' : '' }}"></button>
            @endforeach
          </div>
        @endif
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden">
      <!-- Background Effects -->
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
      </div>
      
      <div class="relative max-w-7xl mx-auto">
        <!-- Header -->
        @php
          $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
          // Ensure app locale is set correctly
          app()->setLocale($currentLocale);
          $aboutData = $aboutContent[$currentLocale] ?? ($aboutContent['ar'] ?? []);
          $aboutTitle = $aboutData['title'] ?? 'من نحن';
          $aboutDesc = $aboutData['desc'] ?? 'شركة متخصصة في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي';
        @endphp
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm" data-i18n="aboutBadge">
              <img src="/assets/images/icons/sex.svg" alt="@lang('website.aboutBadge')" class="inline w-6 h-6 object-contain align-middle" />  {{ trans('website.aboutBadge', [], $currentLocale) }}
            </span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">
            <span>{{ $aboutTitle }}</span>
          </h2>
          <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
            {!! $aboutDesc !!}
          </p>
        </div>

        <!-- Tab System -->
        <div class="mt-16">
          <!-- Tab Navigation -->
          @if(isset($aboutTabs) && $aboutTabs->count() > 0)
            <div class="flex flex-wrap justify-center gap-3 mb-8 border-b border-slate-800/50 pb-4">
              @foreach($aboutTabs as $index => $tab)
                <button type="button" class="about-tab {{ $index === 0 ? 'active' : '' }} px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="{{ $tab['key'] }}">
                  <span>{{ $tab['title'] }}</span>
                </button>
              @endforeach
            </div>
          @endif

          <!-- Tab Content -->
          <div class="tab-content-wrapper">
            @if(isset($aboutTabs) && $aboutTabs->count() > 0)
              @foreach($aboutTabs as $index => $tab)
                @php
                  $childrenCount = $tab['children']->count();
                  // Determine layout based on number of children
                  if ($childrenCount === 1) {
                    // Single child - Overview style layout
                    $layout = 'overview';
                  } elseif ($childrenCount === 3) {
                    // 3 children - Stats/Mission style layout
                    $layout = 'three-column';
                  } else {
                    // 4+ children - Features style layout
                    $layout = 'grid';
                  }
                  
                  $colors = [
                    ['gradient' => 'from-emerald-500 to-emerald-600', 'border' => 'hover:border-emerald-500/50', 'shadow' => 'hover:shadow-emerald-500/20', 'shadow-lg' => 'shadow-emerald-500/30'],
                    ['gradient' => 'from-cyan-500 to-cyan-600', 'border' => 'hover:border-cyan-500/50', 'shadow' => 'hover:shadow-cyan-500/20', 'shadow-lg' => 'shadow-cyan-500/30'],
                    ['gradient' => 'from-blue-500 to-blue-600', 'border' => 'hover:border-blue-500/50', 'shadow' => 'hover:shadow-blue-500/20', 'shadow-lg' => 'shadow-blue-500/30'],
                    ['gradient' => 'from-violet-500 to-violet-600', 'border' => 'hover:border-violet-500/50', 'shadow' => 'hover:shadow-violet-500/20', 'shadow-lg' => 'shadow-violet-500/30'],
                    ['gradient' => 'from-rose-500 to-rose-600', 'border' => 'hover:border-rose-500/50', 'shadow' => 'hover:shadow-rose-500/20', 'shadow-lg' => 'shadow-rose-500/30'],
                    ['gradient' => 'from-orange-500 to-orange-600', 'border' => 'hover:border-orange-500/50', 'shadow' => 'hover:shadow-orange-500/20', 'shadow-lg' => 'shadow-orange-500/30'],
                  ];
                @endphp
                
                @if($layout === 'overview' && $childrenCount === 1)
                  {{-- Overview Layout: Single child with 2 columns --}}
                  @php $child = $tab['children']->first(); @endphp
                  <div class="tab-content {{ $index === 0 ? 'active' : '' }}" data-content="{{ $tab['key'] }}">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                      <div class="relative">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                          <div class="aspect-[4/3] bg-gradient-to-br from-emerald-500/20 via-cyan-500/20 to-blue-500/20 flex items-center justify-center">
                            <div class="text-center p-8">
                              <div class="w-32 h-32 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-emerald-500/50">
                                @if($child->image)
                                  <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" loading="lazy" decoding="async" />
                                @else
                                  <img src="/assets/images/icons/sex.svg" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" loading="lazy" decoding="async" />
                                @endif
                              </div>
                              <h3 class="text-3xl font-bold mb-4 gradient-text">{{ $child->t('title') }}</h3>
                              {{-- @if($aboutContent && isset($aboutContent['ar']['desc']))
                                <p class="text-slate-300 text-lg">{{ $aboutContent['ar']['desc'] }}</p>
                              @endif --}}
                            </div>
                          </div>
                          <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-500/30 rounded-full blur-2xl"></div>
                          <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-cyan-500/30 rounded-full blur-2xl"></div>
                        </div>
                      </div>
                      <div>
                        <h3 class="text-3xl font-bold mb-6 text-white">{{ $child->t('title') }}</h3>
                        @if($child->t('content'))
                          <p class="text-slate-400 text-lg leading-relaxed mb-6">
                            {{ $child->t('content') }}
                          </p>
                        @endif
                      </div>
                    </div>
                  </div>
                @elseif($layout === 'three-column' && $childrenCount === 3)
                  {{-- Three Column Layout: Stats/Mission style --}}
                  <div class="tab-content {{ $index === 0 ? 'active' : '' }}" data-content="{{ $tab['key'] }}">
                    <div class="grid md:grid-cols-3 gap-8">
                      @foreach($tab['children'] as $childIndex => $child)
                        @php $color = $colors[$childIndex % count($colors)]; @endphp
                        <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 {{ $color['border'] }} transition-all hover:scale-105 hover:shadow-2xl {{ $color['shadow-lg'] }} text-center group relative overflow-hidden">
                          <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                          <div class="relative z-10">
                            <div class="w-20 h-20 bg-gradient-to-br {{ $color['gradient'] }} rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 group-hover:rotate-6 transition-transform shadow-lg {{ $color['shadow-lg'] }}">
                              @if($child->image)
                                <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-12 h-12 object-contain" loading="lazy" decoding="async" />
                              @else
                                <img src="/assets/images/icons/four.svg" alt="{{ $child->t('title') }}" class="w-12 h-12 object-contain" loading="lazy" decoding="async" />
                              @endif
                            </div>
                            @php
                              $contentValue = $child->t('content');
                              $isNumeric = is_numeric(str_replace(['+', '%'], '', $contentValue));
                            @endphp
                            @if($isNumeric)
                              <h3 class="text-5xl font-bold mb-3 bg-gradient-to-r {{ $color['gradient'] }} bg-clip-text text-transparent">{{ $contentValue }}</h3>
                              <p class="text-slate-400 text-lg font-medium">{{ $child->t('title') }}</p>
                            @else
                              <h3 class="text-2xl font-bold mb-4 text-white">{{ $child->t('title') }}</h3>
                              @if($contentValue)
                                <p class="text-slate-400 leading-relaxed">{{ $contentValue }}</p>
                              @endif
                            @endif
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @else
                  {{-- Grid Layout: Features style (4+ children or other) --}}
                  <div class="tab-content {{ $index === 0 ? 'active' : '' }}" data-content="{{ $tab['key'] }}">
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                      @foreach($tab['children'] as $childIndex => $child)
                        @php $color = $colors[$childIndex % count($colors)]; @endphp
                        <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700/50 {{ $color['border'] }} transition-all hover:scale-105 {{ $color['shadow'] }} text-center group">
                          <div class="w-16 h-16 bg-gradient-to-br {{ $color['gradient'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            @if($child->image)
                              <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-10 h-10 object-contain" loading="lazy" decoding="async" />
                            @else
                              <img src="/assets/images/icons/ten.svg" alt="{{ $child->t('title') }}" class="w-10 h-10 object-contain" loading="lazy" decoding="async" />
                            @endif
                          </div>
                          <h4 class="text-xl font-bold mb-2 text-white">{{ $child->t('title') }}</h4>
                          @if($child->t('content'))
                            <p class="text-slate-400 text-sm">{{ $child->t('content') }}</p>
                          @endif
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden">
      <!-- Background Effects -->
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 right-10 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
      </div>

      <div class="relative max-w-7xl mx-auto">
        <!-- Header -->
        @php
          $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
          app()->setLocale($currentLocale);
          $serviceData = $serviceContent[$currentLocale] ?? ($serviceContent['ar'] ?? []);
          $serviceBadge = $serviceData['badge'] ?? '✨ خدماتنا';
          $serviceTitle = $serviceData['title'] ?? 'خدماتنا المتميزة';
          $serviceDesc = $serviceData['content'] ?? 'حلول شاملة لجميع احتياجاتك في البناء والتراخيص';
        @endphp
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">
              {{ $serviceBadge }}
            </span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">
            <span class="gradient-text">{{ $serviceTitle }}</span>
          </h2>
          <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
            {!! $serviceDesc !!}
          </p>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          @php
            $colorClasses = [
              ['border' => 'hover:border-emerald-500/50', 'shadow' => 'hover:shadow-emerald-500/30', 'bg' => 'bg-emerald-500/10', 'bg2' => 'bg-emerald-500/5', 'gradient' => 'from-emerald-500 to-emerald-600', 'shadow-lg' => 'shadow-emerald-500/50', 'shadow-icon' => 'shadow-emerald-500/30', 'text' => 'group-hover:text-emerald-400', 'button' => 'hover:bg-emerald-500/20'],
              ['border' => 'hover:border-cyan-500/50', 'shadow' => 'hover:shadow-cyan-500/30', 'bg' => 'bg-cyan-500/10', 'bg2' => 'bg-cyan-500/5', 'gradient' => 'from-cyan-500 to-cyan-600', 'shadow-lg' => 'shadow-cyan-500/50', 'shadow-icon' => 'shadow-cyan-500/30', 'text' => 'group-hover:text-cyan-400', 'button' => 'hover:bg-cyan-500/20'],
              ['border' => 'hover:border-blue-500/50', 'shadow' => 'hover:shadow-blue-500/30', 'bg' => 'bg-blue-500/10', 'bg2' => 'bg-blue-500/5', 'gradient' => 'from-blue-500 to-blue-600', 'shadow-lg' => 'shadow-blue-500/50', 'shadow-icon' => 'shadow-blue-500/30', 'text' => 'group-hover:text-blue-400', 'button' => 'hover:bg-blue-500/20'],
              ['border' => 'hover:border-violet-500/50', 'shadow' => 'hover:shadow-violet-500/30', 'bg' => 'bg-violet-500/10', 'bg2' => 'bg-violet-500/5', 'gradient' => 'from-violet-500 to-violet-600', 'shadow-lg' => 'shadow-violet-500/50', 'shadow-icon' => 'shadow-violet-500/30', 'text' => 'group-hover:text-violet-400', 'button' => 'hover:bg-violet-500/20'],
              ['border' => 'hover:border-rose-500/50', 'shadow' => 'hover:shadow-rose-500/30', 'bg' => 'bg-rose-500/10', 'bg2' => 'bg-rose-500/5', 'gradient' => 'from-rose-500 to-rose-600', 'shadow-lg' => 'shadow-rose-500/50', 'shadow-icon' => 'shadow-rose-500/30', 'text' => 'group-hover:text-rose-400', 'button' => 'hover:bg-rose-500/20'],
              ['border' => 'hover:border-orange-500/50', 'shadow' => 'hover:shadow-orange-500/30', 'bg' => 'bg-orange-500/10', 'bg2' => 'bg-orange-500/5', 'gradient' => 'from-orange-500 to-orange-600', 'shadow-lg' => 'shadow-orange-500/50', 'shadow-icon' => 'shadow-orange-500/30', 'text' => 'group-hover:text-orange-400', 'button' => 'hover:bg-orange-500/20'],
            ];
            $icons = ['one', 'two', 'three', 'four', 'five', 'sex', 'seven', 'eight', 'nine', 'ten'];
          @endphp
          @forelse($services as $index => $service)
            @php
              $colorClass = $colorClasses[$index % count($colorClasses)];
              $icon = $icons[$index % count($icons)];
              $number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            @endphp
            <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 {{ $colorClass['border'] }} transition-all duration-300 hover:scale-105 hover:shadow-2xl {{ $colorClass['shadow'] }} overflow-hidden">
              <!-- Decorative Background -->
              <div class="absolute top-0 right-0 w-32 h-32 {{ $colorClass['bg'] }} rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="absolute bottom-0 left-0 w-24 h-24 {{ $colorClass['bg2'] }} rounded-full blur-xl"></div>
              
              <div class="relative z-10">
                <!-- Service Number Badge -->
                <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br {{ $colorClass['gradient'] }} rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg {{ $colorClass['shadow-lg'] }}">{{ $number }}</div>
                
                <div class="w-20 h-20 bg-gradient-to-br {{ $colorClass['gradient'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg {{ $colorClass['shadow-icon'] }}">
                  @if($service->image)
                    <img src="@image($service->image)" alt="{{ $service->t('title') }}" class="w-16 h-16 object-cover rounded-xl" loading="lazy" decoding="async" />
                  @else
                    <img src="/assets/images/icons/{{ $icon }}.svg" alt="{{ $service->t('title') }}" class="w-12 h-12 object-contain" loading="lazy" decoding="async" />
                  @endif
                </div>
                <h3 class="text-2xl font-bold mb-4 text-white {{ $colorClass['text'] }} transition-colors">{{ $service->t('title') }}</h3>
                @if($service->t('content'))
                  <p class="text-slate-400 leading-relaxed">{{ Str::limit($service->t('content'), 100) }}</p>
                @endif

                <a href="{{ route('website.service.show', $service->id) }}" class="block mt-6 px-4 py-2 bg-slate-800/80 {{ $colorClass['button'] }} rounded-lg border border-slate-700 text-sm font-semibold transition-all text-center">
                  <span>{{ trans('website.viewDetails', [], $currentLocale) }}</span>
                </a>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12">
              <p class="text-slate-400 text-lg">لا توجد خدمات متاحة حالياً</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Pricing CTA -->
    <section id="pricing-cta" class="pricing-cta-section relative py-20 px-6 overflow-hidden border-y border-emerald-500/20">
      <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950/50"></div>
      <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-emerald-500/15 via-transparent to-transparent pointer-events-none"></div>
      <div class="absolute inset-0 bg-slate-950/40 pointer-events-none"></div>
      <div class="relative max-w-7xl mx-auto">
        <p class="text-center text-lg md:text-xl text-slate-300 max-w-4xl mx-auto leading-relaxed mb-14 md:mb-16">
          {{ trans('website.pricingCtaLead', [], $currentLocale) }}
        </p>
        <div class="grid md:grid-cols-2 gap-10 md:gap-12 items-center">
          <div class="{{ $currentLocale !== 'ar' ? 'md:order-2' : '' }} flex {{ $currentLocale === 'ar' ? 'md:justify-start' : 'md:justify-end' }} justify-center">
            <button
              type="button"
              data-pricing-modal-open
              class="pricing-cta-btn group inline-flex items-center gap-3 px-8 py-4 rounded-2xl font-semibold text-white bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 shadow-lg shadow-emerald-500/30 border border-emerald-400/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-emerald-500/40 whitespace-normal text-center max-w-full cursor-pointer"
            >
              <svg class="w-5 h-5 shrink-0 transition-transform group-hover:-translate-x-1 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              <span>{{ trans('website.pricingCtaButton', [], $currentLocale) }}</span>
            </button>
          </div>
          <div class="{{ $currentLocale !== 'ar' ? 'md:order-1' : '' }} text-center {{ $currentLocale === 'ar' ? 'md:text-right' : 'md:text-left' }}">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
              {{ trans('website.pricingCtaNamePart1', [], $currentLocale) }}<span class="gradient-text">{{ trans('website.pricingCtaNameHighlight', [], $currentLocale) }}</span>{{ trans('website.pricingCtaNamePart2', [], $currentLocale) }}
            </h2>
            <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-xl {{ $currentLocale === 'ar' ? 'md:mr-0 md:ml-auto' : 'md:ml-0 md:mr-auto' }}">
              {{ trans('website.pricingCtaDesc', [], $currentLocale) }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing quote modal -->
    @php
      $pricingTypeSlugs = [
        ['slug' => 'residential_building', 'key' => 'pricingTypeResidential'],
        ['slug' => 'commercial_showrooms', 'key' => 'pricingTypeCommercial'],
        ['slug' => 'villa', 'key' => 'pricingTypeVilla'],
        ['slug' => 'warehouses', 'key' => 'pricingTypeWarehouses'],
        ['slug' => 'other', 'key' => 'pricingTypeOther'],
        ['slug' => 'tourism', 'key' => 'pricingTypeTourism'],
        ['slug' => 'hospital', 'key' => 'pricingTypeHospital'],
        ['slug' => 'hotel', 'key' => 'pricingTypeHotel'],
      ];
      $oldProjectTypes = old('project_types', []);
    @endphp
    <div
      id="pricing-quote-modal"
      class="fixed inset-0 z-[100] hidden overflow-y-auto overflow-x-hidden overscroll-y-contain px-4 py-8 sm:px-6 sm:py-10"
      role="dialog"
      aria-modal="true"
      aria-labelledby="pricing-quote-modal-title"
      aria-hidden="true"
    >
      <div class="absolute inset-0 z-0 min-h-full bg-slate-950/80 backdrop-blur-sm" data-pricing-modal-backdrop data-pricing-modal-close></div>
      <div class="relative z-10 mx-auto flex min-h-[calc(100dvh-4rem)] w-full max-w-lg items-center justify-center py-2 sm:min-h-[calc(100dvh-5rem)] sm:py-4">
        <div class="rounded-2xl border border-slate-700 bg-gradient-to-br from-slate-900 to-slate-950 shadow-2xl shadow-emerald-900/20" style="overflow-y: auto;height:80vh">
        <div class="sticky top-0 z-10 flex items-center justify-between gap-4 border-b border-slate-700/80 bg-slate-900/95 px-5 py-4 backdrop-blur-sm">
          <h3 id="pricing-quote-modal-title" class="text-lg font-bold text-white sm:text-xl">
            {{ trans('website.pricingQuoteModalTitle', [], $currentLocale) }}
          </h3>
          <button
            type="button"
            class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-800 hover:text-white"
            data-pricing-modal-close
            aria-label="{{ trans('website.pricingQuoteClose', [], $currentLocale) }}"
          >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="p-5 sm:p-6">
          <form
            action="{{ route('website.pricing-quote.store') }}"
            method="post"
            enctype="multipart/form-data"
            data-turbo="false"
          >
            @csrf
            <input type="hidden" name="pricing_form" value="1">

            <div class="flex flex-col gap-10 py-1" style="gap:20px;">
            <div>
              <label for="pricing-name" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteName', [], $currentLocale) }}</label>
              <input
                id="pricing-name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                maxlength="100"
                class="w-full rounded-xl border bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 {{ $errors->has('name') ? 'border-red-500' : 'border-slate-600' }}"
              />
              @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="pricing-email" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteEmail', [], $currentLocale) }}</label>
              <input
                id="pricing-email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                maxlength="255"
                dir="ltr"
                class="w-full rounded-xl border bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 {{ $errors->has('email') ? 'border-red-500' : 'border-slate-600' }}"
              />
              @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="pricing-phone" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuotePhone', [], $currentLocale) }}</label>
              <input
                id="pricing-phone"
                type="tel"
                name="phone"
                value="{{ old('phone') }}"
                required
                maxlength="20"
                dir="ltr"
                class="w-full rounded-xl border bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 {{ $errors->has('phone') ? 'border-red-500' : 'border-slate-600' }}"
              />
              @error('phone')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <fieldset class="space-y-4 py-1">
              <legend class="mb-1 block w-full text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteProjectType', [], $currentLocale) }}</legend>
              <div class="flex flex-wrap gap-3">
                @foreach ($pricingTypeSlugs as $pt)
                  <label class="flex cursor-pointer items-start gap-2 rounded-lg border border-slate-700/80 bg-slate-800/40 px-3 py-2.5 text-sm text-slate-200 transition hover:border-emerald-500/40">
                    <input
                      type="checkbox"
                      name="project_types[]"
                      value="{{ $pt['slug'] }}"
                      class="mt-0.5 rounded border-slate-600 text-emerald-500 focus:ring-emerald-500/30"
                      @checked(in_array($pt['slug'], $oldProjectTypes, true))
                    />
                    <span>{{ trans('website.'.$pt['key'], [], $currentLocale) }}</span>
                  </label>
                @endforeach
              </div>
              @if ($errors->has('project_types'))
                <p class="text-sm text-red-400">{{ $errors->first('project_types') }}</p>
              @else
                @foreach ($errors->getMessages() as $field => $messages)
                  @if (str_starts_with($field, 'project_types.'))
                    @foreach ($messages as $message)
                      <p class="text-sm text-red-400">{{ $message }}</p>
                    @endforeach
                    @break
                  @endif
                @endforeach
              @endif
            </fieldset>

            <div>
              <label for="pricing-space" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteSpace', [], $currentLocale) }}</label>
              <input
                id="pricing-space"
                type="text"
                name="project_space"
                value="{{ old('project_space') }}"
                required
                maxlength="400"
                class="w-full rounded-xl border bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 {{ $errors->has('project_space') ? 'border-red-500' : 'border-slate-600' }}"
              />
              @error('project_space')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="pricing-city" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteCity', [], $currentLocale) }}</label>
              <input
                id="pricing-city"
                type="text"
                name="city"
                value="{{ old('city') }}"
                required
                maxlength="400"
                class="w-full rounded-xl border bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 {{ $errors->has('city') ? 'border-red-500' : 'border-slate-600' }}"
              />
              @error('city')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <span class="mb-1.5 block text-sm font-semibold text-slate-300" id="pricing-attachment-label">{{ trans('website.pricingQuoteAttachment', [], $currentLocale) }}</span>
              <div class="relative overflow-hidden rounded-xl border border-dashed {{ $errors->has('attachment') ? 'border-red-500/70 bg-red-950/20' : 'border-slate-600 bg-slate-800/50' }} transition-colors hover:border-emerald-500/40 hover:bg-slate-800/80">
                <input
                  id="pricing-attachment"
                  type="file"
                  name="attachment"
                  accept="image/*,.pdf,.doc,.docx"
                  class="absolute inset-0 z-10 h-full min-h-[5.5rem] w-full cursor-pointer opacity-0"
                  aria-labelledby="pricing-attachment-label"
                />
                <div class="pointer-events-none flex min-h-[5.5rem] items-center gap-3 px-4 py-3">
                  <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-500/15 text-emerald-400 ring-1 ring-emerald-500/25">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                  </div>
                  <div class="min-w-0 flex-1 text-start">
                    <p
                      id="pricing-attachment-filename"
                      class="truncate text-sm font-medium text-slate-400"
                      data-empty="{{ e(trans('website.pricingQuoteFilePlaceholder', [], $currentLocale)) }}"
                    >{{ trans('website.pricingQuoteFilePlaceholder', [], $currentLocale) }}</p>
                    <p class="mt-0.5 text-xs text-slate-500">{{ trans('website.pricingQuoteFileHint', [], $currentLocale) }}</p>
                  </div>
                  <span class="shrink-0 rounded-lg bg-gradient-to-r from-emerald-600 to-emerald-500 px-3 py-2 text-xs font-semibold text-white shadow-sm shadow-emerald-900/30">
                    {{ trans('website.pricingQuoteFileBrowse', [], $currentLocale) }}
                  </span>
                </div>
              </div>
              @error('attachment')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="pricing-notes" class="mb-1.5 block text-sm font-semibold text-slate-300">{{ trans('website.pricingQuoteNotes', [], $currentLocale) }}</label>
              <textarea
                id="pricing-notes"
                name="notes"
                rows="4"
                maxlength="2000"
                class="w-full resize-none rounded-xl border border-slate-600 bg-slate-800/80 px-4 py-3 text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
              >{{ old('notes') }}</textarea>
              @error('notes')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <button
              type="submit"
              class="w-full rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 py-3.5 font-semibold text-white shadow-lg shadow-emerald-500/25 transition hover:from-emerald-500 hover:to-emerald-400"
            >
              {{ trans('website.pricingQuoteSubmit', [], $currentLocale) }}
            </button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-slate-900/50">
      <div class="max-w-7xl mx-auto">
        @php
          $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
          app()->setLocale($currentLocale);
        @endphp
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">{{ trans('website.contactTitle', [], $currentLocale) }}</h2>
          <p class="text-xl text-slate-400">{{ trans('website.contactSubtitle', [], $currentLocale) }}</p>
        </div>

        <!-- Contact Info Cards -->
        @php
          $footerWhatsApp = $footerContent['all']['whatsapp'] ?? $footerContent['whatsapp'] ?? '+966 XX XXX XXXX';
          $footerEmail = $footerContent['all']['email'] ?? $footerContent['email'] ?? 'info@example.com';
          $footerLocation = $footerContent['all']['location'] ?? $footerContent['location'] ?? 'المملكة العربية السعودية';
          $footerLocationEn = $footerContent['all']['location_en'] ?? $footerContent['location_en'] ?? 'Saudi Arabia';
          $mapLink = $footerContent['all']['google_map_link'] ?? $footerContent['google_map_link'] ?? 'https://www.google.com/maps/search/?api=1&query=Riyadh+Saudi+Arabia';
          $locationText = $currentLocale === 'ar' ? $footerLocation : $footerLocationEn;
          
          // Clean WhatsApp number for URL (remove spaces, dashes, parentheses, and keep only numbers and +)
          $whatsappNumber = preg_replace('/[^0-9+]/', '', $footerWhatsApp);
          $whatsappUrl = 'https://wa.me/' . $whatsappNumber;
        @endphp
        <div class="grid md:grid-cols-3 gap-8 mb-16">
          <!-- WhatsApp -->
          <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-green-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-white">{{ trans('website.whatsapp', [], $currentLocale) }}</h3>
            <p class="text-slate-400 group-hover:text-green-400 transition-colors font-medium" dir="ltr">{{ $footerWhatsApp }}</p>
          </a>

          <!-- Email -->
          <a href="mailto:{{ $footerEmail }}" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-cyan-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              ✉
            </div>
            <h3 class="text-xl font-bold mb-3 text-white">{{ trans('website.contactEmail', [], $currentLocale) }}</h3>
            <p class="text-slate-400 group-hover:text-cyan-400 transition-colors font-medium break-all">{{ $footerEmail }}</p>
          </a>

          <!-- Location -->
          <a href="{{ $mapLink }}" target="_blank" rel="noopener noreferrer" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-blue-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              📍
            </div>
            <h3 class="text-xl font-bold mb-3 text-white">{{ trans('website.contactLocation', [], $currentLocale) }}</h3>
            <p class="text-slate-400 group-hover:text-blue-400 transition-colors font-medium">{{ $locationText }}</p>
          </a>
        </div>

        <!-- Contact Form and Map -->
        <div class="grid lg:grid-cols-2 gap-8">
          <!-- Contact Form -->
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6">{{ trans('website.contactFormTitle', [], $currentLocale) }}</h3>
            
            <form action="{{ route('website.contact.store') }}" method="POST" class="space-y-6">
              @csrf
              <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-slate-300">{{ trans('website.contactName', [], $currentLocale) }}</label>
                <input 
                  type="text" 
                  id="name" 
                  name="name" 
                  value="{{ old('name') }}"
                  required
                  minlength="2"
                  maxlength="100"
                  class="w-full px-4 py-3 bg-slate-700/50 border {{ $errors->has('name') ? 'border-red-500' : 'border-slate-600' }} rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                  placeholder="{{ trans('website.contactNamePlaceholder', [], $currentLocale) }}"
                />
                @error('name')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>

              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <label for="email" class="block text-sm font-semibold mb-2 text-slate-300">{{ trans('website.contactEmailLabel', [], $currentLocale) }}</label>
                  <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    maxlength="255"
                    class="w-full px-4 py-3 bg-slate-700/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-600' }} rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                    placeholder="example@email.com"
                    dir="ltr"
                  />
                  @error('email')
                    <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                  @enderror
                </div>

                <div>
                  <label for="phone" class="block text-sm font-semibold mb-2 text-slate-300">{{ trans('website.contactPhoneLabel', [], $currentLocale) }}</label>
                  <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    required
                    pattern="[+]?[0-9\s\-\(\)]{8,20}"
                    maxlength="20"
                    class="w-full px-4 py-3 bg-slate-700/50 border {{ $errors->has('phone') ? 'border-red-500' : 'border-slate-600' }} rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                    placeholder="+966 XX XXX XXXX"
                    dir="ltr"
                  />
                  @error('phone')
                    <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div>
                <label for="subject" class="block text-sm font-semibold mb-2 text-slate-300">{{ trans('website.contactSubject', [], $currentLocale) }}</label>
                <input 
                  type="text" 
                  id="subject" 
                  name="subject" 
                  value="{{ old('subject') }}"
                  required
                  minlength="3"
                  maxlength="200"
                  class="w-full px-4 py-3 bg-slate-700/50 border {{ $errors->has('subject') ? 'border-red-500' : 'border-slate-600' }} rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                  placeholder="{{ trans('website.contactSubjectPlaceholder', [], $currentLocale) }}"
                />
                @error('subject')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label for="message" class="block text-sm font-semibold mb-2 text-slate-300">{{ trans('website.contactMessage', [], $currentLocale) }}</label>
                <textarea 
                  id="message" 
                  name="message" 
                  rows="5" 
                  required
                  minlength="10"
                  maxlength="1000"
                  class="w-full px-4 py-3 bg-slate-700/50 border {{ $errors->has('message') ? 'border-red-500' : 'border-slate-600' }} rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none"
                  placeholder="{{ trans('website.contactMessagePlaceholder', [], $currentLocale) }}"
                >{{ old('message') }}</textarea>
                @error('message')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>

              <button 
                type="submit"
                class="w-full px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105 hover:shadow-xl"
              >
                {{ trans('website.contactSubmit', [], $currentLocale) }}
              </button>
            </form>
          </div>

          <!-- Map -->
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6">{{ trans('website.contactMapTitle', [], $currentLocale) }}</h3>
            <div class="rounded-2xl overflow-hidden border border-slate-600 shadow-2xl">
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.2385099999997!2d46.67527731500001!3d24.713554984123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1699123456789!5m2!1sen!2sus"
                width="100%" 
                height="500" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full"
                title="{{ trans('website.contactMapTitle', [], $currentLocale) }}"
              ></iframe>
            </div>
            <div class="mt-6 p-4 bg-slate-700/30 rounded-xl">
              <p class="text-slate-300 text-center">
                <span class="font-semibold">{{ trans('website.contactAddress', [], $currentLocale) }}:</span> <span>{{ $locationText }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    @push('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var aboutSection = document.getElementById('about');
            if (aboutSection) {
                aboutSection.addEventListener('click', function (e) {
                    var button = e.target.closest('.about-tab');
                    if (!button || !aboutSection.contains(button)) {
                        return;
                    }
                    e.preventDefault();
                    var targetTab = button.getAttribute('data-tab');
                    if (!targetTab) {
                        return;
                    }
                    aboutSection.querySelectorAll('.about-tab').forEach(function (btn) {
                        btn.classList.remove('active');
                    });
                    aboutSection.querySelectorAll('.tab-content').forEach(function (content) {
                        content.classList.remove('active');
                    });
                    button.classList.add('active');
                    aboutSection.querySelectorAll('.tab-content').forEach(function (content) {
                        if (content.getAttribute('data-content') === targetTab) {
                            content.classList.add('active');
                        }
                    });
                });
            }

            var pricingModal = document.getElementById('pricing-quote-modal');
            if (pricingModal) {
                var pricingOpeners = document.querySelectorAll('[data-pricing-modal-open]');
                var pricingClosers = pricingModal.querySelectorAll('[data-pricing-modal-close]');

                function openPricingModal() {
                    pricingModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    pricingModal.setAttribute('aria-hidden', 'false');
                }
                function closePricingModal() {
                    pricingModal.classList.add('hidden');
                    document.body.style.overflow = '';
                    pricingModal.setAttribute('aria-hidden', 'true');
                }

                pricingOpeners.forEach(function (el) {
                    el.addEventListener('click', openPricingModal);
                });
                pricingClosers.forEach(function (el) {
                    el.addEventListener('click', function (e) {
                        e.preventDefault();
                        closePricingModal();
                    });
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && !pricingModal.classList.contains('hidden')) {
                        closePricingModal();
                    }
                });
            }

            var pricingFileInput = document.getElementById('pricing-attachment');
            var pricingFileNameEl = document.getElementById('pricing-attachment-filename');
            if (pricingFileInput && pricingFileNameEl) {
                var pricingFileEmpty = pricingFileNameEl.getAttribute('data-empty') || '';
                pricingFileInput.addEventListener('change', function () {
                    if (pricingFileInput.files && pricingFileInput.files.length) {
                        pricingFileNameEl.textContent = pricingFileInput.files[0].name;
                        pricingFileNameEl.classList.remove('text-slate-400');
                        pricingFileNameEl.classList.add('text-emerald-400');
                    } else {
                        pricingFileNameEl.textContent = pricingFileEmpty;
                        pricingFileNameEl.classList.add('text-slate-400');
                        pricingFileNameEl.classList.remove('text-emerald-400');
                    }
                });
            }

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    background: '#1e293b',
                    color: '#fff',
                    iconColor: '#10b981',
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('error') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    background: '#1e293b',
                    color: '#fff',
                    iconColor: '#ef4444',
                });
            @endif
        });
    </script>
    @endpush

    @endsection
