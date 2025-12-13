@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 px-6 bg-slate-900/50">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 text-slate-400">
          <a href="landing-page" class="hover:text-emerald-400 transition">الرئيسية</a>
          <span>/</span>
          <a href="services" class="hover:text-emerald-400 transition">الخدمات</a>
          <span>/</span>
          <span class="text-white">{{ $service['name'] ?? 'تفاصيل الخدمة' }}</span>
        </div>
      </div>
    </section>

    <!-- Service Header -->
    <section class="py-16 px-6 relative overflow-hidden">
      <!-- Background Effects -->
      <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900"></div>
      <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>

      <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Image -->
          <div class="order-2 lg:order-1">
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 rounded-2xl blur-2xl group-hover:blur-3xl transition-all"></div>
              <img 
                src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                alt="{{ $service['name'] ?? 'Service' }}"
                class="relative w-full rounded-2xl shadow-2xl"
              />
            </div>
          </div>

          <!-- Content -->
          <div class="order-1 lg:order-2">
            <span class="px-4 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold inline-block mb-6">
              {{ $service['badge'] ?? '✨ خدمة متميزة' }}
            </span>
            <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
              {{ $service['name'] ?? 'تفاصيل الخدمة' }}
            </h1>
            <p class="text-xl text-slate-300 leading-relaxed mb-8">
              {{ $service['description'] ?? 'نحن نقدم خدمات متخصصة وعالية الجودة لضمان نجاح مشروعك' }}
            </p>
            
            <div class="space-y-4 mb-8">
              <div class="flex items-start gap-4">
                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <span class="text-white text-sm font-bold">✓</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">متخصصون معتمدون</h3>
                  <p class="text-slate-400">فريقنا يتكون من متخصصين معتمدين بخبرة عملية طويلة</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <span class="text-white text-sm font-bold">✓</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">جودة مضمونة</h3>
                  <p class="text-slate-400">نلتزم بأعلى معايير الجودة والاحترافية في جميع خدماتنا</p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <span class="text-white text-sm font-bold">✓</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">دعم شامل</h3>
                  <p class="text-slate-400">نوفر دعماً مستمراً من بداية المشروع إلى نهايته</p>
                </div>
              </div>
            </div>

            <div class="flex gap-4 flex-wrap">
              <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105">
                احجز استشارة الآن
              </button>
              <button class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105">
                اتصل بنا
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Service Features -->
    <section class="py-20 px-6 bg-slate-800/30 border-t border-slate-700/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">مميزات هذه الخدمة</h2>
          <p class="text-xl text-slate-300 max-w-2xl mx-auto">
            نقدم مجموعة شاملة من المميزات التي تضمن نجاح مشروعك
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              ⚡
            </div>
            <h3 class="text-xl font-bold mb-3">سرعة في الإنجاز</h3>
            <p class="text-slate-400">
              نعمل بكفاءة عالية لضمان إنجاز الخدمة في أسرع وقت ممكن دون التأثير على الجودة
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              🎯
            </div>
            <h3 class="text-xl font-bold mb-3">دقة عالية</h3>
            <p class="text-slate-400">
              كل تفصيلة في الخدمة تتم بدقة واهتمام لضمان تحقيق أهدافك بالكامل
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              💰
            </div>
            <h3 class="text-xl font-bold mb-3">أسعار تنافسية</h3>
            <p class="text-slate-400">
              نقدم خدماتنا بأسعار مناسبة وتنافسية مع الحفاظ على أعلى معايير الجودة
            </p>
          </div>

          <!-- Feature 4 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              📋
            </div>
            <h3 class="text-xl font-bold mb-3">توثيق شامل</h3>
            <p class="text-slate-400">
              توثيق كامل لجميع خطوات الخدمة مع تقارير دورية تفصيلية
            </p>
          </div>

          <!-- Feature 5 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              🤝
            </div>
            <h3 class="text-xl font-bold mb-3">تعاون وثيق</h3>
            <p class="text-slate-400">
              نعمل بتعاون وثيق مع فريقك لضمان تحقيق الأهداف المطلوبة
            </p>
          </div>

          <!-- Feature 6 -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all">
            <div class="w-14 h-14 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6 text-2xl">
              🔒
            </div>
            <h3 class="text-xl font-bold mb-3">السرية والأمان</h3>
            <p class="text-slate-400">
              نضمن السرية التامة لجميع معلومات وبيانات مشروعك
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">كيف تعمل هذه الخدمة</h2>
          <p class="text-xl text-slate-300 max-w-2xl mx-auto">
            خطوات سهلة وبسيطة لضمان حصولك على أفضل خدمة
          </p>
        </div>

        <div class="relative">
          <!-- Timeline Line -->
          <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500/0 via-emerald-500/50 to-emerald-500/0 transform -translate-x-1/2"></div>

          <div class="space-y-12">
            <!-- Step 1 -->
            <div class="relative">
              <div class="lg:flex items-center">
                <div class="lg:w-1/2 lg:text-right lg:pr-16 mb-8 lg:mb-0">
                  <h3 class="text-2xl font-bold mb-3">الاستشارة المجانية</h3>
                  <p class="text-slate-400 text-lg">
                    نبدأ بالاستماع إلى احتياجاتك وفهم متطلبات مشروعك بالتفصيل
                  </p>
                </div>
                <div class="hidden lg:flex w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full items-center justify-center absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 border-4 border-slate-900 font-bold text-white z-10">
                  1
                </div>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
              <div class="lg:flex items-center flex-row-reverse">
                <div class="lg:w-1/2 lg:text-left lg:pl-16 mb-8 lg:mb-0">
                  <h3 class="text-2xl font-bold mb-3">الخطة التفصيلية</h3>
                  <p class="text-slate-400 text-lg">
                    نعد خطة تفصيلية شاملة تحدد الخطوات والجدول الزمني والموارد المطلوبة
                  </p>
                </div>
                <div class="hidden lg:flex w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full items-center justify-center absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 border-4 border-slate-900 font-bold text-white z-10">
                  2
                </div>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
              <div class="lg:flex items-center">
                <div class="lg:w-1/2 lg:text-right lg:pr-16 mb-8 lg:mb-0">
                  <h3 class="text-2xl font-bold mb-3">التنفيذ والمتابعة</h3>
                  <p class="text-slate-400 text-lg">
                    نبدأ التنفيذ مع متابعة دورية ومستمرة لضمان الالتزام بالخطة
                  </p>
                </div>
                <div class="hidden lg:flex w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full items-center justify-center absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 border-4 border-slate-900 font-bold text-white z-10">
                  3
                </div>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
              <div class="lg:flex items-center flex-row-reverse">
                <div class="lg:w-1/2 lg:text-left lg:pl-16 mb-8 lg:mb-0">
                  <h3 class="text-2xl font-bold mb-3">التسليم والدعم</h3>
                  <p class="text-slate-400 text-lg">
                    تسليم الخدمة مع ضمانات شاملة ودعم مستمر بعد الانتهاء
                  </p>
                </div>
                <div class="hidden lg:flex w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full items-center justify-center absolute left-1/2 top-0 transform -translate-x-1/2 -translate-y-1/2 border-4 border-slate-900 font-bold text-white z-10">
                  4
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing -->
    <section class="py-20 px-6 bg-slate-800/30 border-t border-slate-700/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">الخطط والأسعار</h2>
          <p class="text-xl text-slate-300 max-w-2xl mx-auto">
            اختر الخطة التي تناسب احتياجات مشروعك
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Basic Plan -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-cyan-500/50 transition-all">
            <h3 class="text-2xl font-bold mb-2">الخطة الأساسية</h3>
            <p class="text-slate-400 mb-6">للمشاريع الصغيرة والمتوسطة</p>
            <div class="mb-6">
              <span class="text-4xl font-bold">5,000</span>
              <span class="text-slate-400">ر.س</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                استشارة أولية
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                خطة أساسية
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                متابعة شهرية
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-600 rounded-full"></span>
                دعم بريدي
              </li>
            </ul>
            <button class="w-full px-6 py-3 bg-cyan-500/20 border border-cyan-500/50 rounded-lg hover:bg-cyan-500/30 transition-all font-semibold text-cyan-400">
              اختر الآن
            </button>
          </div>

          <!-- Professional Plan -->
          <div class="bg-gradient-to-br from-slate-800/60 to-slate-800/30 backdrop-blur-md border border-emerald-500/50 rounded-2xl p-8 hover:border-emerald-500 transition-all relative ring-1 ring-emerald-500/30">
            <div class="absolute -top-4 right-8 bg-gradient-to-r from-emerald-500 to-emerald-600 px-4 py-2 rounded-full text-sm font-semibold">
              الأشهر
            </div>
            <h3 class="text-2xl font-bold mb-2">الخطة الاحترافية</h3>
            <p class="text-slate-400 mb-6">للمشاريع المتوسطة والكبيرة</p>
            <div class="mb-6">
              <span class="text-4xl font-bold">12,000</span>
              <span class="text-slate-400">ر.س</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                استشارة شاملة
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                خطة مفصلة
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                متابعة أسبوعية
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                دعم هاتفي وبريدي
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                تقارير شهرية مفصلة
              </li>
            </ul>
            <button class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-lg font-semibold text-white shadow-lg shadow-emerald-500/50">
              اختر الآن
            </button>
          </div>

          <!-- Enterprise Plan -->
          <div class="bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-rose-500/50 transition-all">
            <h3 class="text-2xl font-bold mb-2">الخطة الشاملة</h3>
            <p class="text-slate-400 mb-6">للمشاريع الكبيرة والمعقدة</p>
            <div class="mb-6">
              <span class="text-4xl font-bold">25,000</span>
              <span class="text-slate-400">ر.س +</span>
            </div>
            <ul class="space-y-3 mb-8">
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                استشارة متكاملة
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                خطة مخصصة
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                متابعة يومية
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                دعم 24/7
              </li>
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                فريق مخصص
              </li>
            </ul>
            <button class="w-full px-6 py-3 bg-rose-500/20 border border-rose-500/50 rounded-lg hover:bg-rose-500/30 transition-all font-semibold text-rose-400">
              اختر الآن
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 px-6">
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">الأسئلة الشائعة</h2>
        </div>

        <div class="space-y-4">
          <!-- FAQ Item 1 -->
          <details class="group bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all">
            <summary class="flex cursor-pointer items-center justify-between p-6 font-bold text-lg hover:text-emerald-400 transition">
              <span>كم يستغرق الحصول على هذه الخدمة؟</span>
              <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-400 group-open:bg-red-500/20 group-open:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 transition duration-300 group-open:-rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
              </span>
            </summary>
            <div class="border-t border-slate-700/50 px-6 py-4 text-slate-300">
              <p>يعتمد الوقت على نوع وحجم الخدمة المطلوبة. عادة يستغرق من 5-10 أيام عمل، لكن يمكن تسريعها حسب الحاجة.</p>
            </div>
          </details>

          <!-- FAQ Item 2 -->
          <details class="group bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all">
            <summary class="flex cursor-pointer items-center justify-between p-6 font-bold text-lg hover:text-emerald-400 transition">
              <span>هل تقدمون ضمانات للخدمة؟</span>
              <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-400 group-open:bg-red-500/20 group-open:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 transition duration-300 group-open:-rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
              </span>
            </summary>
            <div class="border-t border-slate-700/50 px-6 py-4 text-slate-300">
              <p>نعم، نقدم ضمانات شاملة للخدمة مع دعم مستمر بعد الانتهاء. جميع أعمالنا مضمونة 100%</p>
            </div>
          </details>

          <!-- FAQ Item 3 -->
          <details class="group bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all">
            <summary class="flex cursor-pointer items-center justify-between p-6 font-bold text-lg hover:text-emerald-400 transition">
              <span>هل يمكن تعديل الخطة بعد البدء؟</span>
              <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-400 group-open:bg-red-500/20 group-open:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 transition duration-300 group-open:-rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
              </span>
            </summary>
            <div class="border-t border-slate-700/50 px-6 py-4 text-slate-300">
              <p>بالتأكيد، يمكن تعديل الخطة حسب احتياجاتك المتغيرة. نحن مرنون جداً في التعامل مع تطورات المشروع.</p>
            </div>
          </details>

          <!-- FAQ Item 4 -->
          <details class="group bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all">
            <summary class="flex cursor-pointer items-center justify-between p-6 font-bold text-lg hover:text-emerald-400 transition">
              <span>ما هي طرق الدفع المتاحة؟</span>
              <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-emerald-400 group-open:bg-red-500/20 group-open:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 transition duration-300 group-open:-rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
              </span>
            </summary>
            <div class="border-t border-slate-700/50 px-6 py-4 text-slate-300">
              <p>نقبل التحويل البنكي والدفع الإلكتروني والدفع عند الاستلام. يمكن ترتيب خطة دفع مناسبة لك.</p>
            </div>
          </details>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6 bg-slate-800/30 border-t border-slate-700/50">
      <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500/20 via-slate-800/40 to-cyan-500/20 rounded-3xl border border-emerald-500/30 p-12 text-center">
        <h2 class="text-4xl font-bold mb-6">جاهز لبدء مشروعك؟</h2>
        <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
          تواصل معنا الآن واحصل على استشارة مجانية من فريقنا المتخصص
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
          <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105">
            احجز استشارة مجانية
          </button>
          <button class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105">
            اتصل بنا
          </button>
        </div>
      </div>
    </section>

   @endsection