@extends('website.layouts.app')
@section('title', trans('website.aboutTitle'))
@section('meta_description', trans('website.seoAboutDescription'))
@section('content')

    <!-- About Section -->
    <section id="about" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
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
          $aboutTitle = $aboutData['title'] ?? trans('website.aboutTitle', [], $currentLocale);
          $aboutDesc = $aboutData['desc'] ?? trans('website.aboutSubtitle', [], $currentLocale);
        @endphp
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">
              <img src="/assets/images/icons/sex.svg" alt="{{ trans('website.aboutBadge', [], $currentLocale) }}" class="inline w-6 h-6 object-contain align-middle" />  {{ trans('website.aboutBadge', [], $currentLocale) }}
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
                                  <img src="{{ asset($child->image) }}" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" loading="lazy" decoding="async" />
                                @else
                                  <img src="/assets/images/icons/sex.svg" alt="{{ $child->t('title') }}" class="w-20 h-20 object-contain" loading="lazy" decoding="async" />
                                @endif
                              </div>
                              <h3 class="text-3xl font-bold mb-4 gradient-text">{{ $child->t('title') }}</h3>
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
                            {!! nl2br(e($child->t('content'))) !!}
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
            @else
              <div class="text-center py-12">
                <p class="text-slate-400 text-lg">{{ trans('website.noAboutContent', [], $currentLocale) }}</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabButtons = document.querySelectorAll('.about-tab');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all tabs and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Show corresponding content
                    const targetContent = document.querySelector(`[data-content="${targetTab}"]`);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });

            // Tab button styles
            const style = document.createElement('style');
            style.textContent = `
                .about-tab {
                    background: transparent;
                    color: #94a3b8;
                    border: none;
                    cursor: pointer;
                    position: relative;
                }
                .about-tab:hover {
                    color: #10b981;
                }
                .about-tab.active {
                    color: #10b981;
                }
                .about-tab.active::after {
                    content: '';
                    position: absolute;
                    bottom: -17px;
                    left: 0;
                    right: 0;
                    height: 3px;
                    background: linear-gradient(to right, #10b981, #06b6d4);
                    border-radius: 3px 3px 0 0;
                }
                .tab-content {
                    display: none;
                }
                .tab-content.active {
                    display: block;
                    animation: fadeIn 0.5s ease-in;
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
    @endpush

   @endsection
