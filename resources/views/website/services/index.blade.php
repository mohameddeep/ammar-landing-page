@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- Page Header -->
    <section class="pt-32 pb-16 px-6 relative overflow-hidden min-h-screen flex items-center">
      <!-- Background Effects -->
      <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900"></div>
      <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>

      <div class="max-w-7xl mx-auto relative w-full">
        <div class="text-center mb-16">
          <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm inline-block mb-6">
            🎯 خدماتنا المتكاملة
          </span>
          <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            <span class="block">خدمات متميزة</span>
            <span class="block gradient-text">لنجاح مشروعك</span>
          </h1>
          <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            نقدم مجموعة شاملة من الخدمات المتخصصة في البناء والتراخيص والإشراف على المشاريع
          </p>
        </div>
      </div>
    </section>

    <!-- Services Grid -->
    <section id="services" class="py-20 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          
          <!-- Service 1: Building Licenses -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-emerald-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/one.svg" alt="تراخيص البناء" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">تراخيص البناء</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                نحصل على جميع التراخيص المطلوبة لمشروعك بسرعة واحترافية عالية، مع ضمان الامتثال الكامل للمعايير والقوانين
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                  رخص البناء الأساسية
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                  رخص التعديل والإضافات
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                  شهادات الإنجاز والاستكمال
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-emerald-500/20 border border-emerald-500/50 rounded-lg hover:bg-emerald-500/30 transition-all font-semibold text-emerald-400">
                اعرف المزيد
              </button>
            </div>
          </div>

          <!-- Service 2: Project Supervision -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-blue-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/two.svg" alt="الإشراف على المشاريع" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">الإشراف على المشاريع</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                فريقنا المتخصص يوفر إشرافاً كاملاً على تنفيذ المشاريع ضمان الجودة والالتزام بالجداول الزمنية
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                  متابعة يومية للتنفيذ
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                  ضمان الجودة والمعايير
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                  إدارة الموارد والتكاليف
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-blue-500/20 border border-blue-500/50 rounded-lg hover:bg-blue-500/30 transition-all font-semibold text-blue-400">
                اعرف المزيد
              </button>
            </div>
          </div>

          <!-- Service 3: Contracting -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-rose-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-rose-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/three.svg" alt="المقاولات والتنفيذ" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">المقاولات والتنفيذ</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                خدمات مقاولات شاملة من التصميم إلى التسليم النهائي مع ضمان أعلى معايير الجودة
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                  تنفيذ كامل للمشاريع
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                  مواد عالية الجودة
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                  ضمان السلامة والأمان
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-rose-500/20 border border-rose-500/50 rounded-lg hover:bg-rose-500/30 transition-all font-semibold text-rose-400">
                اعرف المزيد
              </button>
            </div>
          </div>

          <!-- Service 4: Consulting -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-amber-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/four.svg" alt="الاستشارات الهندسية" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">الاستشارات الهندسية</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                استشارات متخصصة من فريق هندسي متمرس لضمان نجاح مشروعك من الألف إلى الياء
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                  دراسات الجدوى الاقتصادية
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                  التصاميم الهندسية
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                  الاستشارات القانونية
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-amber-500/20 border border-amber-500/50 rounded-lg hover:bg-amber-500/30 transition-all font-semibold text-amber-400">
                اعرف المزيد
              </button>
            </div>
          </div>

          <!-- Service 5: Quality Assurance -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/five.svg" alt="ضمان الجودة" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">ضمان الجودة</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                برامج مراقبة الجودة الشاملة لضمان التزام المشاريع بأعلى المعايير الدولية
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                  الاختبارات والفحوصات
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                  شهادات المطابقة
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></span>
                  التدقيق والمراجعة
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-cyan-500/20 border border-cyan-500/50 rounded-lg hover:bg-cyan-500/30 transition-all font-semibold text-cyan-400">
                اعرف المزيد
              </button>
            </div>
          </div>

          <!-- Service 6: Safety Management -->
          <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 hover:border-violet-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/20">
            <div class="absolute inset-0 bg-gradient-to-br from-violet-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <img src="/assets/images/icons/sex.svg" alt="إدارة السلامة" class="w-10 h-10 object-contain" />
              </div>
              <h3 class="text-2xl font-bold mb-4">إدارة السلامة</h3>
              <p class="text-slate-300 mb-6 leading-relaxed">
                برامج شاملة لضمان سلامة الموقع والعاملين وتطبيق أفضل الممارسات الدولية
              </p>
              <ul class="space-y-3 mb-6">
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span>
                  تقييمات المخاطر
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span>
                  التدريب والتوعية
                </li>
                <li class="flex items-center gap-2 text-slate-300">
                  <span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span>
                  مراقبة مستمرة للالتزام
                </li>
              </ul>
              <button class="w-full px-6 py-3 bg-violet-500/20 border border-violet-500/50 rounded-lg hover:bg-violet-500/30 transition-all font-semibold text-violet-400">
                اعرف المزيد
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 px-6 bg-slate-800/30 border-t border-slate-700/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-6">لماذا تختار البناء المتقدم؟</h2>
          <p class="text-xl text-slate-300 max-w-3xl mx-auto">
            نحن نتميز برؤية واضحة وخبرة عميقة في قطاع البناء والتراخيص
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="text-center">
            <div class="text-5xl mb-4">15+</div>
            <h3 class="text-xl font-bold mb-2">سنة خبرة</h3>
            <p class="text-slate-400">أكثر من 15 سنة في مجال البناء والتراخيص</p>
          </div>
          <div class="text-center">
            <div class="text-5xl mb-4">500+</div>
            <h3 class="text-xl font-bold mb-2">مشروع مكتمل</h3>
            <p class="text-slate-400">تم إنجاز أكثر من 500 مشروع بنجاح</p>
          </div>
          <div class="text-center">
            <div class="text-5xl mb-4">100%</div>
            <h3 class="text-xl font-bold mb-2">رضا العملاء</h3>
            <p class="text-slate-400">نسبة رضا عالية من العملاء الكرام</p>
          </div>
          <div class="text-center">
            <div class="text-5xl mb-4">24/7</div>
            <h3 class="text-xl font-bold mb-2">دعم مستمر</h3>
            <p class="text-slate-400">فريق دعم متاح طوال الوقت لمساعدتك</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
      <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500/20 via-slate-800/40 to-cyan-500/20 rounded-3xl border border-emerald-500/30 p-12 text-center">
        <h2 class="text-4xl font-bold mb-6">هل أنت مستعد لبدء مشروعك؟</h2>
        <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
          تواصل معنا الآن واحصل على استشارة مجانية من فريقنا المتخصص
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
          <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105">
            ابدأ الآن
          </button>
          <button class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105">
            اتصل بنا
          </button>
        </div>
      </div>
    </section>

   @endsection