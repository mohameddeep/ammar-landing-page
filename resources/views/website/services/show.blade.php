@extends('website.layouts.app')
@section('title', $service->t('title'))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      app()->setLocale($currentLocale);
    @endphp

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 px-6 bg-slate-900/50">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 text-slate-400">
          <a href="{{ route('website.landing-page') }}" class="hover:text-emerald-400 transition">{{ trans('website.home', [], $currentLocale) }}</a>
          <span>/</span>
          <a href="{{ route('website.services.index') }}" class="hover:text-emerald-400 transition">{{ trans('website.services', [], $currentLocale) }}</a>
          <span>/</span>
          <span class="text-white">{{ $service->t('title') }}</span>
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
              @if($service->image)
                <img 
                  src="@image($service->image)" 
                  alt="{{ $service->t('title') }}"
                  class="relative w-full rounded-2xl shadow-2xl"
                />
              @else
                <div class="relative w-full aspect-video bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 rounded-2xl shadow-2xl flex items-center justify-center">
                  <img src="/assets/images/icons/one.svg" alt="{{ $service->t('title') }}" class="w-32 h-32 object-contain opacity-50" />
                </div>
              @endif
            </div>
          </div>

          <!-- Content -->
          <div class="order-1 lg:order-2">
            <span class="px-4 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold inline-block mb-6">
              {{ trans('website.serviceBadge', [], $currentLocale) }}
            </span>
            <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
              {{ $service->t('title') }}
            </h1>
            @if($service->t('content'))
              <p class="text-xl text-slate-300 leading-relaxed mb-8">
                {!! nl2br(e($service->t('content'))) !!}
              </p>
            @endif
            
            <div class="flex gap-4 flex-wrap">
              <a href="{{ route('website.contact.index') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105">
                {{ trans('website.bookConsultation', [], $currentLocale) }}
              </a>
              <a href="{{ route('website.contact.index') }}" class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105">
                {{ trans('website.contactUs', [], $currentLocale) }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Related Services -->
    @if(isset($otherServices) && $otherServices->count() > 0)
    <section class="py-20 px-6 bg-slate-800/30 border-t border-slate-700/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold mb-4">{{ trans('website.relatedServices', [], $currentLocale) }}</h2>
          <p class="text-xl text-slate-300 max-w-2xl mx-auto">
            {{ trans('website.relatedServicesDesc', [], $currentLocale) }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach($otherServices as $otherService)
            <div class="group relative bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 hover:border-emerald-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-500/20">
              <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative z-10">
                @if($otherService->image)
                  <img src="@image($otherService->image)" alt="{{ $otherService->t('title') }}" class="w-full h-48 object-cover rounded-xl mb-4" />
                @else
                  <div class="w-full h-48 bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 rounded-xl mb-4 flex items-center justify-center">
                    <img src="/assets/images/icons/one.svg" alt="{{ $otherService->t('title') }}" class="w-16 h-16 object-contain opacity-50" />
                  </div>
                @endif
                <h3 class="text-xl font-bold mb-3 text-white">{{ $otherService->t('title') }}</h3>
                @if($otherService->t('content'))
                  <p class="text-slate-400 mb-4 text-sm leading-relaxed">
                    {{ Str::limit($otherService->t('content'), 100) }}
                  </p>
                @endif
                <a href="{{ route('website.service.show', $otherService->id) }}" class="inline-block px-4 py-2 bg-emerald-500/20 border border-emerald-500/50 rounded-lg hover:bg-emerald-500/30 transition-all font-semibold text-emerald-400 text-sm">
                  {{ trans('website.viewDetails', [], $currentLocale) }}
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 px-6">
      <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500/20 via-slate-800/40 to-cyan-500/20 rounded-3xl border border-emerald-500/30 p-12 text-center">
        <h2 class="text-4xl font-bold mb-6">{{ trans('website.readyToStart', [], $currentLocale) }}</h2>
        <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
          {{ trans('website.readyToStartDesc', [], $currentLocale) }}
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
          <a href="{{ route('website.contact.index') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-full font-semibold shadow-lg shadow-emerald-500/50 transition-all hover:scale-105">
            {{ trans('website.bookFreeConsultation', [], $currentLocale) }}
          </a>
          <a href="{{ route('website.contact.index') }}" class="px-8 py-4 bg-slate-800/80 hover:bg-slate-700/80 text-white rounded-full font-semibold border border-slate-700 transition-all hover:scale-105">
            {{ trans('website.contactUs', [], $currentLocale) }}
          </a>
        </div>
      </div>
    </section>

   @endsection
