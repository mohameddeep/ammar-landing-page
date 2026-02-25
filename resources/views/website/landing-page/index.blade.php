
@extends('website.layouts.app')
@section('title', __('dashboard.users'))
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
                <button class="about-tab {{ $index === 0 ? 'active' : '' }} px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="{{ $tab['key'] }}">
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
                                  <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" />
                                @else
                                  <img src="/assets/images/icons/sex.svg" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" />
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
                                <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-12 h-12 object-contain" />
                              @else
                                <img src="/assets/images/icons/four.svg" alt="{{ $child->t('title') }}" class="w-12 h-12 object-contain" />
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
                              <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-10 h-10 object-contain" />
                            @else
                              <img src="/assets/images/icons/ten.svg" alt="{{ $child->t('title') }}" class="w-10 h-10 object-contain" />
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
                    <img src="@image($service->image)" alt="{{ $service->t('title') }}" class="w-16 h-16 object-cover rounded-xl" />
                  @else
                    <img src="/assets/images/icons/{{ $icon }}.svg" alt="{{ $service->t('title') }}" class="w-12 h-12 object-contain" />
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
