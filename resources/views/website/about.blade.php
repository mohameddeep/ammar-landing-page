@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- About Section -->
    <section id="about" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="relative max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">🏗️ عن الشركة</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">من نحن</h2>
          <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
            شركة متخصصة في خدمات البناء والتراخيص مع خبرة تمتد لأكثر من 15 عاماً في السوق السعودي
          </p>
        </div>

        <div class="mt-16">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
              <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                <div class="aspect-[4/3] bg-gradient-to-br from-emerald-500/20 via-cyan-500/20 to-blue-500/20 flex items-center justify-center">
                  <div class="text-center p-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-emerald-500/50">
                      <span class="text-6xl">🏗️</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 gradient-text">البناء المتقدم</h3>
                    <p class="text-slate-300 text-lg">15+ سنة من الخبرة</p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <h3 class="text-3xl font-bold mb-6 text-white">شركة رائدة في مجال البناء</h3>
              <p class="text-slate-400 text-lg leading-relaxed mb-6">
                نحن شركة متخصصة في تقديم خدمات البناء والتراخيص في المملكة العربية السعودية. مع أكثر من 15 عاماً من الخبرة المتراكمة، نقدم حلولاً شاملة ومبتكرة لعملائنا.
              </p>
              <div class="space-y-4">
                <div class="flex items-center gap-3">
                  <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                  <span class="text-slate-300">فريق محترف ومتخصص</span>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-2 h-2 bg-cyan-500 rounded-full"></div>
                  <span class="text-slate-300">خدمات متكاملة وشاملة</span>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                  <span class="text-slate-300">التزام بأعلى معايير الجودة</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

   @endsection