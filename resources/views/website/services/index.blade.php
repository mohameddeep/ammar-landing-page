@extends('website.layouts.app')
@section('title', trans('website.services'))
@section('meta_description', trans('website.seoServicesDescription'))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      app()->setLocale($currentLocale);
      $serviceData = $serviceContent[$currentLocale] ?? ($serviceContent['ar'] ?? []);
      $serviceBadge = $serviceData['badge'] ?? trans('website.servicesBadge', [], $currentLocale);
      $serviceTitle = $serviceData['title'] ?? trans('website.servicesTitle', [], $currentLocale);
      $serviceDesc = $serviceData['content'] ?? trans('website.servicesSubtitle', [], $currentLocale);
    @endphp

    <!-- Page Header -->
    <section class="pt-24 pb-8 px-6 relative overflow-hidden">
      <!-- Background Effects -->
      <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900"></div>
      <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-10 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>

      <div class="max-w-7xl mx-auto relative w-full">
        <div class="text-center mb-8">
          <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm inline-block mb-4">
            {{ $serviceBadge }}
          </span>
          <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">
            <span class="block">{{ $serviceTitle }}</span>
          </h1>
          <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            {!! $serviceDesc !!}
          </p>
        </div>
      </div>
    </section>

    <!-- Services Grid -->
    <section id="services" class="pt-8 pb-20 px-6">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
            @endphp
            <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8 {{ $colorClass['border'] }} transition-all duration-300 hover:shadow-xl {{ $colorClass['shadow'] }} overflow-hidden">
              <div class="absolute inset-0 bg-gradient-to-br {{ $colorClass['bg'] }} to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br {{ $colorClass['gradient'] }} rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  @if($service->image)
                    <img src="@image($service->image)" alt="{{ $service->t('title') }}" class="w-12 h-12 object-cover rounded-lg" loading="lazy" decoding="async" />
                  @else
                    <img src="/assets/images/icons/{{ $icon }}.svg" alt="{{ $service->t('title') }}" class="w-10 h-10 object-contain" loading="lazy" decoding="async" />
                  @endif
                </div>
                <h3 class="text-2xl font-bold mb-4 text-white">{{ $service->t('title') }}</h3>
                @if($service->t('content'))
                  <p class="text-slate-300 mb-6 leading-relaxed">
                    {{ Str::limit($service->t('content'), 120) }}
                  </p>
                @endif
                <a href="{{ route('website.service.show', $service->id) }}" class="block w-full px-6 py-3 {{ $colorClass['button'] }} border border-slate-700/50 rounded-lg hover:border-{{ explode('-', $colorClass['gradient'])[0] }}-500/50 transition-all font-semibold text-center {{ $colorClass['text'] }}">
                  {{ trans('website.viewDetails', [], $currentLocale) }}
                </a>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center py-12">
              <p class="text-slate-400 text-lg">{{ trans('website.noServices', [], $currentLocale) }}</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

   @endsection
