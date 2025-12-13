
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
        <!-- Slide 1 -->
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
              <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm" data-i18n="slide1Badge">
                🏗️ خبرة 15+ سنة
              </span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
              <span data-i18n="slide1Title1">شريكك الموثوق في</span>
              <span class="block gradient-text mt-2 animate-float" data-i18n="slide1Title2">البناء والتراخيص</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10" data-i18n="slide1Desc">
              نقدم خدمات متكاملة في إصدار التراخيص والإشراف على المشاريع والمقاولات بأعلى معايير الجودة والاحترافية
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105 hover:shadow-xl" data-i18n="slide1Btn1">
                ابدأ مشروعك الآن
              </button>
              <button class="px-8 py-4 bg-slate-800/80 backdrop-blur-sm hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105" data-i18n="slide1Btn2">
                استشارة مجانية
              </button>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide slide-bg-2">
          <div class="slide-image-wrapper">
            <img 
              src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80" 
              alt="Construction Site" 
              class="slide-image"
              loading="lazy"
            />
            <div class="slide-overlay"></div>
          </div>
          <div class="text-center slide-content py-20 relative z-10">
            <div class="mb-6 inline-block">
              <span class="px-6 py-2 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-400 text-sm font-semibold backdrop-blur-sm" data-i18n="slide2Badge">
                ✅ +500 مشروع مكتمل
              </span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
              <span data-i18n="slide2Title1">رخص البناء</span>
              <span class="block gradient-text mt-2" data-i18n="slide2Title2">بسرعة وكفاءة عالية</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10" data-i18n="slide2Desc">
              نحن نضمن لك الحصول على جميع التراخيص المطلوبة في أسرع وقت ممكن مع الالتزام الكامل بجميع المعايير والمواصفات
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
              <button class="px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-full font-semibold shadow-lg shadow-blue-500/50 transition-all hover:scale-105 hover:shadow-xl" data-i18n="slide2Btn1">
                احصل على رخصة الآن
              </button>
              <button class="px-8 py-4 bg-slate-800/80 backdrop-blur-sm hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105" data-i18n="slide2Btn2">
                تعرف على الخدمات
              </button>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide slide-bg-3">
          <div class="slide-image-wrapper">
            <img 
              src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2092&q=80" 
              alt="Architectural Building" 
              class="slide-image"
              loading="lazy"
            />
            <div class="slide-overlay"></div>
          </div>
          <div class="text-center slide-content py-20 relative z-10">
            <div class="mb-6 inline-block">
              <span class="px-6 py-2 bg-rose-500/20 border border-rose-500/30 rounded-full text-rose-400 text-sm font-semibold backdrop-blur-sm" data-i18n="slide3Badge">
                🛡️ الأمن والسلامة أولاً
              </span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
              <span data-i18n="slide3Title1">إشراف احترافي</span>
              <span class="block gradient-text mt-2" data-i18n="slide3Title2">على مشاريعك</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10" data-i18n="slide3Desc">
              فريقنا المتخصص يضمن تنفيذ مشروعك بأعلى معايير الجودة والأمان مع متابعة مستمرة في كل مرحلة
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
              <button class="px-8 py-4 bg-gradient-to-r from-rose-500 to-orange-500 hover:from-rose-600 hover:to-orange-600 text-white rounded-full font-semibold shadow-lg shadow-rose-500/50 transition-all hover:scale-105 hover:shadow-xl" data-i18n="slide3Btn1">
                ابدأ مشروعك الآن
              </button>
              <button class="px-8 py-4 bg-slate-800/80 backdrop-blur-sm hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105" data-i18n="slide3Btn2">
                تواصل معنا
              </button>
            </div>
          </div>
        </div>

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
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex gap-3">
          <button class="slider-dot w-3 h-3 rounded-full bg-slate-600 hover:bg-emerald-500 transition-all active"></button>
          <button class="slider-dot w-3 h-3 rounded-full bg-slate-600 hover:bg-emerald-500 transition-all"></button>
          <button class="slider-dot w-3 h-3 rounded-full bg-slate-600 hover:bg-emerald-500 transition-all"></button>
        </div>
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
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm" data-i18n="aboutBadge">
              <img src="/assets/images/icons/sex.svg" alt="عن الشركة" class="inline w-6 h-6 object-contain align-middle" /> عن الشركة
            </span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">
            <span data-i18n="aboutTitle">من نحن</span>
          </h2>
          <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed" data-i18n="aboutDesc">
            شركة متخصصة في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي
          </p>
        </div>

        <!-- Tab System -->
        <div class="mt-16">
          <!-- Tab Navigation -->
          <div class="flex flex-wrap justify-center gap-3 mb-8 border-b border-slate-800/50 pb-4">
            <button class="about-tab active px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="overview">
              <span data-i18n="aboutTabOverview">نظرة عامة</span>
            </button>
            <button class="about-tab px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="stats">
              <span data-i18n="aboutTabStats">الإحصائيات</span>
            </button>
            <button class="about-tab px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="mission">
              <span data-i18n="aboutTabMission">الرؤية والمهمة</span>
            </button>
            <button class="about-tab px-6 py-3 rounded-xl font-semibold transition-all relative" data-tab="features">
              <span data-i18n="aboutTabFeatures">المميزات</span>
            </button>
          </div>

          <!-- Tab Content -->
          <div class="tab-content-wrapper">
            <!-- Overview Tab -->
            <div class="tab-content active" data-content="overview">
              <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                  <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <div class="aspect-[4/3] bg-gradient-to-br from-emerald-500/20 via-cyan-500/20 to-blue-500/20 flex items-center justify-center">
                      <div class="text-center p-8">
                        <div class="w-32 h-32 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-emerald-500/50">
                          <img src="/assets/images/icons/sex.svg" alt="البناء المتقدم" class="w-20 h-20 object-contain" />
                        </div>
                        <h3 class="text-3xl font-bold mb-4 gradient-text" data-i18n="companyName">البناء المتقدم</h3>
                        <p class="text-slate-300 text-lg" data-i18n="aboutYears">15+ سنة من الخبرة</p>
                      </div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-emerald-500/30 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-cyan-500/30 rounded-full blur-2xl"></div>
                  </div>
                </div>
                <div>
                  <h3 class="text-3xl font-bold mb-6 text-white" data-i18n="aboutOverviewTitle">شركة رائدة في مجال البناء</h3>
                  <p class="text-slate-400 text-lg leading-relaxed mb-6" data-i18n="aboutOverviewDesc">
                    نحن شركة متخصصة في تقديم خدمات البناء والتراخيص في المملكة العربية السعودية. مع أكثر من 15 عاماً من الخبرة المتراكمة، نقدم حلولاً شاملة ومبتكرة لعملائنا.
                  </p>
                  <div class="space-y-4">
                    <div class="flex items-center gap-3">
                      <img src="/assets/images/icons/one.svg" alt="فريق محترف" class="w-5 h-5 object-contain" />
                      <span class="text-slate-300" data-i18n="aboutOverviewPoint1">فريق محترف ومتخصص</span>
                    </div>
                    <div class="flex items-center gap-3">
                      <img src="/assets/images/icons/two.svg" alt="خدمات متكاملة" class="w-5 h-5 object-contain" />
                      <span class="text-slate-300" data-i18n="aboutOverviewPoint2">خدمات متكاملة وشاملة</span>
                    </div>
                    <div class="flex items-center gap-3">
                      <img src="/assets/images/icons/three.svg" alt="التزام الجودة" class="w-5 h-5 object-contain" />
                      <span class="text-slate-300" data-i18n="aboutOverviewPoint3">التزام بأعلى معايير الجودة</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Stats Tab -->
            <div class="tab-content" data-content="stats">
              <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-emerald-500/50 transition-all hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/30 text-center group relative overflow-hidden">
                  <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 group-hover:rotate-6 transition-transform shadow-lg shadow-emerald-500/30">
                      <img src="/assets/images/icons/four.svg" alt="مشروع مكتمل" class="w-12 h-12 object-contain" />
                    </div>
                    <h3 class="text-5xl font-bold mb-3 bg-gradient-to-r from-emerald-400 to-emerald-600 bg-clip-text text-transparent">+500</h3>
                    <p class="text-slate-400 text-lg font-medium" data-i18n="statsProjects">مشروع مكتمل</p>
                  </div>
                </div>
                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-cyan-500/50 transition-all hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/30 text-center group relative overflow-hidden">
                  <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 group-hover:rotate-6 transition-transform shadow-lg shadow-cyan-500/30">
                      <img src="/assets/images/icons/five.svg" alt="التزام بالمعايير" class="w-12 h-12 object-contain" />
                    </div>
                    <h3 class="text-5xl font-bold mb-3 bg-gradient-to-r from-cyan-400 to-cyan-600 bg-clip-text text-transparent">100%</h3>
                    <p class="text-slate-400 text-lg font-medium" data-i18n="statsCompliance">التزام بالمعايير</p>
                  </div>
                </div>
                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-blue-500/50 transition-all hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/30 text-center group relative overflow-hidden">
                  <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  <div class="relative z-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 group-hover:rotate-6 transition-transform shadow-lg shadow-blue-500/30">
                      <img src="/assets/images/icons/six.svg" alt="سنة خبرة" class="w-12 h-12 object-contain" />
                    </div>
                    <h3 class="text-5xl font-bold mb-3 bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">15+</h3>
                    <p class="text-slate-400 text-lg font-medium" data-i18n="statsExperience">سنة خبرة</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Mission/Vision Tab -->
            <div class="tab-content" data-content="mission">
              <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 hover:border-emerald-500/50 transition-all hover:shadow-xl hover:shadow-emerald-500/20">
                  <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                      <img src="/assets/images/icons/seven.svg" alt="رؤيتنا" class="w-10 h-10 object-contain" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white" data-i18n="aboutMissionTitle">رؤيتنا</h3>
                    <p class="text-slate-400 leading-relaxed" data-i18n="aboutMission">أن نكون الرائدين في مجال خدمات البناء والتراخيص في المملكة العربية السعودية من خلال تقديم حلول مبتكرة وخدمات عالية الجودة</p>
                  </div>
                </div>

                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 hover:border-cyan-500/50 transition-all hover:shadow-xl hover:shadow-cyan-500/20">
                  <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                      <img src="/assets/images/icons/eight.svg" alt="مهمتنا" class="w-10 h-10 object-contain" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white" data-i18n="aboutVisionTitle">مهمتنا</h3>
                    <p class="text-slate-400 leading-relaxed" data-i18n="aboutVision">تقديم خدمات متكاملة وشاملة في مجال البناء والتراخيص مع الالتزام بأعلى معايير الجودة والاحترافية لضمان رضا عملائنا</p>
                  </div>
                </div>

                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 hover:border-blue-500/50 transition-all hover:shadow-xl hover:shadow-blue-500/20">
                  <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                      <img src="/assets/images/icons/nine.svg" alt="قيمنا" class="w-10 h-10 object-contain" />
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-white" data-i18n="aboutValuesTitle">قيمنا</h3>
                    <p class="text-slate-400 leading-relaxed" data-i18n="aboutValues">الجودة، الاحترافية، الشفافية، والالتزام بمواعيد التسليم هي القيم الأساسية التي نؤمن بها ونطبقها في كل مشروع</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Features Tab -->
            <div class="tab-content" data-content="features">
              <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700/50 hover:border-emerald-500/50 transition-all hover:scale-105 hover:shadow-xl hover:shadow-emerald-500/20 text-center group">
                  <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <img src="/assets/images/icons/ten.svg" alt="خبرة واسعة" class="w-10 h-10 object-contain" />
                  </div>
                  <h4 class="text-xl font-bold mb-2 text-white" data-i18n="aboutFeature1Title">خبرة واسعة</h4>
                  <p class="text-slate-400 text-sm" data-i18n="aboutFeature1">أكثر من 15 عاماً من الخبرة المتراكمة</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700/50 hover:border-cyan-500/50 transition-all hover:scale-105 hover:shadow-xl hover:shadow-cyan-500/20 text-center group">
                  <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <img src="/assets/images/icons/eleven.svg" alt="جودة عالية" class="w-10 h-10 object-contain" />
                  </div>
                  <h4 class="text-xl font-bold mb-2 text-white" data-i18n="aboutFeature2Title">جودة عالية</h4>
                  <p class="text-slate-400 text-sm" data-i18n="aboutFeature2">التزام بأعلى معايير الجودة</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700/50 hover:border-blue-500/50 transition-all hover:scale-105 hover:shadow-xl hover:shadow-blue-500/20 text-center group">
                  <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <img src="/assets/images/icons/twelve.svg" alt="سرعة الإنجاز" class="w-10 h-10 object-contain" />
                  </div>
                  <h4 class="text-xl font-bold mb-2 text-white" data-i18n="aboutFeature3Title">سرعة الإنجاز</h4>
                  <p class="text-slate-400 text-sm" data-i18n="aboutFeature3">إنجاز المشاريع في الوقت المحدد</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-700/50 hover:border-rose-500/50 transition-all hover:scale-105 hover:shadow-xl hover:shadow-rose-500/20 text-center group">
                  <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <img src="/assets/images/icons/thirteen.svg" alt="خدمة عملاء" class="w-10 h-10 object-contain" />
                  </div>
                  <h4 class="text-xl font-bold mb-2 text-white" data-i18n="aboutFeature4Title">خدمة عملاء</h4>
                  <p class="text-slate-400 text-sm" data-i18n="aboutFeature4">دعم مستمر ومتابعة دقيقة</p>
                </div>
              </div>
            </div>
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
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm" data-i18n="servicesBadge">✨ خدماتنا</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">
            <span class="gradient-text" data-i18n="servicesTitle">خدماتنا المتميزة</span>
          </h2>
          <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed" data-i18n="servicesSubtitle">
            حلول شاملة لجميع احتياجاتك في البناء والتراخيص
          </p>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Service 1 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-emerald-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/30 overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <!-- Service Number Badge -->
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-emerald-500/50">01</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-emerald-500/30">
                <img src="/assets/images/icons/one.svg" alt="رخص البناء" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-emerald-400 transition-colors" data-i18n="service1Title">رخص البناء</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service1Desc">إصدار رخص البناء بكفاءة عالية وسرعة في الإنجاز مع ضمان استيفاء جميع المتطلبات القانونية</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-emerald-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service1Desc">إصدار رخص البناء بكفاءة عالية وسرعة في الإنجاز مع ضمان استيفاء جميع المتطلبات القانونية</div>
            </div>
          </div>

          <!-- Service 2 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-cyan-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/30 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-cyan-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-cyan-500/50">02</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-cyan-500/30">
                <img src="/assets/images/icons/two.svg" alt="رخص الهدم والترميم" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-cyan-400 transition-colors" data-i18n="service2Title">رخص الهدم والترميم</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service2Desc">استخراج تراخيص الهدم والترميم وفقاً للمواصفات والإجراءات المعتمدة</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-cyan-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service2Desc">استخراج تراخيص الهدم والترميم وفقاً للمواصفات والإجراءات المعتمدة</div>
            </div>
          </div>

          <!-- Service 3 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-blue-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/30 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-blue-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-500/50">03</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-blue-500/30">
                <img src="/assets/images/icons/three.svg" alt="شهادات إتمام البناء" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-blue-400 transition-colors" data-i18n="service3Title">شهادات إتمام البناء</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service3Desc">إصدار شهادات إتمام البناء بعد التأكد من مطابقة المشروع للمخططات المعتمدة</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-blue-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service3Desc">إصدار شهادات إتمام البناء بعد التأكد من مطابقة المشروع للمخططات المعتمدة</div>
            </div>
          </div>

          <!-- Service 4 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-violet-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-violet-500/30 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-violet-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-violet-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-violet-500 to-violet-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-violet-500/50">04</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-violet-500 to-violet-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-violet-500/30">
                <img src="/assets/images/icons/four.svg" alt="تصحيح أوضاع المباني" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-violet-400 transition-colors" data-i18n="service4Title">تصحيح أوضاع المباني</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service4Desc">إصدار رخص تصحيح وضع المباني القائمة وتوفيق أوضاعها القانونية</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-violet-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service4Desc">إصدار رخص تصحيح وضع المباني القائمة وتوفيق أوضاعها القانونية</div>
            </div>
          </div>

          <!-- Service 5 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-rose-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-rose-500/30 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-rose-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-rose-500/50">05</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-rose-500/30">
                <img src="/assets/images/icons/five.svg" alt="الأمن والسلامة" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-rose-400 transition-colors" data-i18n="service5Title">الأمن والسلامة</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service5Desc">إعداد مخططات الأمن والسلامة وتقارير السلامة الإنشائية المعتمدة</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-rose-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service5Desc">إعداد مخططات الأمن والسلامة وتقارير السلامة الإنشائية المعتمدة</div>
            </div>
          </div>

          <!-- Service 6 -->
          <div class="service-card group relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:border-orange-500/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-orange-500/30 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-orange-500/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
              <div class="absolute -top-3 -right-3 w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-orange-500/50">06</div>
              
              <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 text-4xl shadow-lg shadow-orange-500/30">
                <img src="/assets/images/icons/sex.svg" alt="المقاولات والإشراف" class="w-12 h-12 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4 text-white group-hover:text-orange-400 transition-colors" data-i18n="service6Title">المقاولات والإشراف</h3>
              <p class="text-slate-400 leading-relaxed" data-i18n="service6Desc">تنفيذ أعمال المقاولات والترميم مع الإشراف الكامل على تنفيذ المشاريع</p>

              <button type="button" class="service-toggle mt-6 px-4 py-2 bg-slate-800/80 hover:bg-orange-500/20 rounded-lg border border-slate-700 text-sm font-semibold transition-all" aria-expanded="false">
                <span data-i18n="serviceLearnMore">اعرف المزيد</span>
              </button>

              <div class="service-details hidden mt-4 text-slate-300 text-sm" data-i18n="service6Desc">تنفيذ أعمال المقاولات والترميم مع الإشراف الكامل على تنفيذ المشاريع</div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-slate-900/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4" data-i18n="contactTitle">تواصل معنا</h2>
          <p class="text-xl text-slate-400" data-i18n="contactSubtitle">نحن هنا للإجابة على جميع استفساراتك</p>
        </div>

        <!-- Contact Info Cards -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
          <!-- Phone -->
          <a href="tel:+966XXXXXXXXX" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-emerald-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              ☎
            </div>
            <h3 class="text-xl font-bold mb-3 text-white" data-i18n="contactPhone">الهاتف</h3>
            <p class="text-slate-400 group-hover:text-emerald-400 transition-colors font-medium" dir="ltr">+966 XX XXX XXXX</p>
          </a>

          <!-- Email -->
          <a href="mailto:info@construction.com" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-cyan-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              ✉
            </div>
            <h3 class="text-xl font-bold mb-3 text-white" data-i18n="contactEmail">البريد الإلكتروني</h3>
            <p class="text-slate-400 group-hover:text-cyan-400 transition-colors font-medium break-all">info@construction.com</p>
          </a>

          <!-- Location -->
          <a href="https://www.google.com/maps/search/?api=1&query=Riyadh+Saudi+Arabia" target="_blank" rel="noopener noreferrer" class="contact-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700 text-center hover:border-blue-500 transition-all hover:scale-105 cursor-pointer block group">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl group-hover:scale-110 transition-transform">
              📍
            </div>
            <h3 class="text-xl font-bold mb-3 text-white" data-i18n="contactLocation">الموقع</h3>
            <p class="text-slate-400 group-hover:text-blue-400 transition-colors font-medium" data-i18n="contactLocationText">المملكة العربية السعودية</p>
          </a>
        </div>

        <!-- Contact Form and Map -->
        <div class="grid lg:grid-cols-2 gap-8">
          <!-- Contact Form -->
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6" data-i18n="contactFormTitle">أرسل لنا رسالة</h3>
            <form id="contactForm" class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-slate-300" data-i18n="contactName">الاسم الكامل</label>
                <input 
                  type="text" 
                  id="name" 
                  name="name" 
                  required
                  minlength="2"
                  maxlength="100"
                  class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                  data-i18n="contactNamePlaceholder"
                  placeholder="أدخل اسمك الكامل"
                />
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>

              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <label for="email" class="block text-sm font-semibold mb-2 text-slate-300" data-i18n="contactEmailLabel">البريد الإلكتروني</label>
                  <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    maxlength="255"
                    class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                    placeholder="example@email.com"
                    dir="ltr"
                  />
                  <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
                </div>

                <div>
                  <label for="phone" class="block text-sm font-semibold mb-2 text-slate-300" data-i18n="contactPhoneLabel">رقم الهاتف</label>
                  <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    required
                    pattern="[+]?[0-9\s\-\(\)]{8,20}"
                    maxlength="20"
                    class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                    placeholder="+966 XX XXX XXXX"
                    dir="ltr"
                  />
                  <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
                </div>
              </div>

              <div>
                <label for="subject" class="block text-sm font-semibold mb-2 text-slate-300" data-i18n="contactSubject">الموضوع</label>
                <input 
                  type="text" 
                  id="subject" 
                  name="subject" 
                  required
                  minlength="3"
                  maxlength="200"
                  class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all"
                  data-i18n="contactSubjectPlaceholder"
                  placeholder="موضوع الرسالة"
                />
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>

              <div>
                <label for="message" class="block text-sm font-semibold mb-2 text-slate-300" data-i18n="contactMessage">الرسالة</label>
                <textarea 
                  id="message" 
                  name="message" 
                  rows="5" 
                  required
                  minlength="10"
                  maxlength="1000"
                  class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none"
                  data-i18n="contactMessagePlaceholder"
                  placeholder="اكتب رسالتك هنا..."
                ></textarea>
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>

              <button 
                type="submit"
                class="w-full px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105 hover:shadow-xl"
                data-i18n="contactSubmit"
              >
                إرسال الرسالة
              </button>

              <div id="formMessage" class="hidden mt-4 p-4 rounded-xl text-center font-semibold"></div>
            </form>
          </div>

          <!-- Map -->
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6" data-i18n="contactMapTitle">موقعنا</h3>
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
                data-i18n-title="contactMapTitle"
                title="موقع الشركة على الخريطة"
              ></iframe>
            </div>
            <div class="mt-6 p-4 bg-slate-700/30 rounded-xl">
              <p class="text-slate-300 text-center">
                <span class="font-semibold" data-i18n="contactAddress">العنوان:</span> <span data-i18n="contactAddressText">المملكة العربية السعودية، الرياض</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>


    @endsection
