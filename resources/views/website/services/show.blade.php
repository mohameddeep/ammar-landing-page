@extends('website.layouts.app')
@section('title', $service->t('title'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags((string) ($service->t('content') ?: $service->t('title'))), 160))
@section('og_type', 'article')
@section('og_image', \App\Support\WebsiteImage::url($service->image, 'service', $service->title_en ?: $service->title_ar))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      app()->setLocale($currentLocale);

      // WhatsApp chat prefilled with this service's name (wa.me expects digits only).
      $serviceWhatsApp = preg_replace('/\D/', '', (string) ($footerContent['all']['whatsapp'] ?? $footerContent['whatsapp'] ?? ''));
      $serviceWhatsAppUrl = $serviceWhatsApp !== ''
        ? 'https://wa.me/'.$serviceWhatsApp.'?text='.rawurlencode(trans('website.whatsappServiceMessage', ['service' => $service->t('title')], $currentLocale))
        : route('website.contact.index');
      $whatsappIcon = '<svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>';
    @endphp

    <!-- Breadcrumb -->
    <section class="pt-10 pb-6 px-6 bg-slate-900/50">
      <div class="max-w-7xl mx-auto">
        <nav aria-label="{{ trans('website.breadcrumb', [], $currentLocale) }}" class="flex flex-wrap items-center gap-2 text-slate-400">
          <a href="{{ route('website.landing-page') }}" class="hover:text-emerald-400 transition">{{ trans('website.home', [], $currentLocale) }}</a>
          <span aria-hidden="true">/</span>
          <a href="{{ route('website.services.index') }}" class="hover:text-emerald-400 transition">{{ trans('website.services', [], $currentLocale) }}</a>
          <span aria-hidden="true">/</span>
          @if($service->parent)
            <a href="{{ route('website.service.show', $service->parent->id) }}" class="hover:text-emerald-400 transition">{{ $service->parent->t('title') }}</a>
            <span aria-hidden="true">/</span>
          @endif
          <span class="text-white" aria-current="page">{{ $service->t('title') }}</span>
        </nav>
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
              <x-website.image
                :src="$service->image"
                type="service"
                :seed="$service->title_en ?: $service->title_ar"
                :alt="$service->t('title')"
                class="relative w-full aspect-[4/3] object-cover rounded-2xl shadow-2xl"
                loading="eager"
                decoding="async"
                fetchpriority="high"
              />
            </div>
          </div>

          <!-- Content -->
          <div class="order-1 lg:order-2">
            <span class="px-4 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold inline-block mb-6">
              {{ $service->activeChildren->isNotEmpty() ? trans('website.serviceCategoryBadge', [], $currentLocale) : trans('website.serviceBadge', [], $currentLocale) }}
            </span>
            <h1 class="section-title font-bold mb-6">
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
              <a href="{{ $serviceWhatsAppUrl }}" target="_blank" rel="noopener noreferrer" data-turbo="false" class="inline-flex items-center gap-2 px-8 py-4 bg-[#25d366]/10 hover:bg-[#25d366] text-[#25d366] hover:text-white rounded-full font-semibold border border-[#25d366]/60 transition-all hover:scale-105">
                {!! $whatsappIcon !!}
                {{ trans('website.whatsappCta', [], $currentLocale) }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sub-services (parent service page) -->
    @if($service->activeChildren->isNotEmpty())
    <section id="sub-services" class="py-20 px-6 border-t border-slate-700/50">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
          <span class="px-4 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold inline-block mb-4">
            {{ trans('website.subServicesCount', ['count' => $service->activeChildren->count()], $currentLocale) }}
          </span>
          <h2 class="section-title font-bold mb-4">{{ trans('website.serviceChildrenTitle', ['name' => $service->t('title')], $currentLocale) }}</h2>
          <p class="text-xl text-slate-300 max-w-2xl mx-auto">
            {{ trans('website.serviceChildrenDesc', ['name' => $service->t('title')], $currentLocale) }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($service->activeChildren as $child)
            <a href="{{ route('website.service.show', $child->id) }}" class="group relative block bg-slate-800/40 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 hover:border-emerald-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-500/20 hover:-translate-y-1">
              <x-website.image :src="$child->image" type="service" :seed="$child->title_en ?: $child->title_ar" :alt="$child->t('title')" class="w-full h-48 object-cover rounded-xl mb-5" loading="lazy" decoding="async" />
              <h3 class="text-xl font-bold mb-3 text-white group-hover:text-emerald-400 transition-colors">{{ $child->t('title') }}</h3>
              @if($child->t('content'))
                <p class="text-slate-400 mb-5 text-sm leading-relaxed">{{ Str::limit(strip_tags($child->t('content')), 120) }}</p>
              @endif
              <span class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-400">
                {{ trans('website.viewDetails', [], $currentLocale) }}
                <svg class="w-4 h-4 transition-transform rtl:-scale-x-100 group-hover:translate-x-1 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </span>
            </a>
          @endforeach
        </div>
      </div>
    </section>
    @endif

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
                <x-website.image :src="$otherService->image" type="service" :seed="$otherService->title_en ?: $otherService->title_ar" :alt="$otherService->t('title')" class="w-full h-48 object-cover rounded-xl mb-4" loading="lazy" decoding="async" />
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
          <a href="{{ $serviceWhatsAppUrl }}" target="_blank" rel="noopener noreferrer" data-turbo="false" class="inline-flex items-center gap-2 px-8 py-4 bg-[#25d366]/10 hover:bg-[#25d366] text-[#25d366] hover:text-white rounded-full font-semibold border border-[#25d366]/60 transition-all hover:scale-105">
            {!! $whatsappIcon !!}
            {{ trans('website.whatsappCta', [], $currentLocale) }}
          </a>
        </div>
      </div>
    </section>

   @endsection
