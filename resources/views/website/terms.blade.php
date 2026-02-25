@extends('website.layouts.app')
@section('title', trans('website.footerTerms'))
@section('content')

    @php
      $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      app()->setLocale($currentLocale);
      
      // Get terms content - structure stores as ['ar' => ['desc' => '...'], 'en' => ['desc' => '...']]
      $termsData = $termsContent ?? [];
      $termsDesc = $termsData[$currentLocale]['desc'] ?? ($termsData['ar']['desc'] ?? ($termsData['en']['desc'] ?? ''));
      
      // Get footer data for contact info
      $footerStructure = app(\App\Repository\StructureRepositoryInterface::class)->structure('footer');
      $footerData = null;
      if ($footerStructure && $footerStructure->content) {
          $footerData = json_decode($footerStructure->content, true);
      }
      $footerEmail = $footerData['all']['email'] ?? $footerData['email'] ?? 'info@example.com';
      $footerPhone = $footerData['all']['phone'] ?? $footerData['phone'] ?? '+966 XX XXX XXXX';
    @endphp

    <!-- Terms & Conditions Section -->
    <section id="terms" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="relative max-w-4xl mx-auto">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">⚖️ {{ trans('website.footerTerms', [], $currentLocale) }}</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">{{ trans('website.footerTerms', [], $currentLocale) }}</h2>
          <p class="text-xl text-slate-400">{{ trans('website.termsDescription', [], $currentLocale) }}</p>
        </div>

        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 space-y-8">
          @if(!empty($termsDesc))
            <div class="text-slate-300 leading-relaxed prose prose-invert max-w-none">
              {!! $termsDesc !!}
            </div>
          @else
            <!-- Default content if no data -->
            <div>
              <h3 class="text-2xl font-bold mb-4 text-emerald-400">{{ trans('website.termsDefaultTitle', [], $currentLocale) }}</h3>
              <p class="text-slate-300 leading-relaxed">
                {{ trans('website.termsDefaultContent', [], $currentLocale) }}
              </p>
            </div>
          @endif

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">{{ trans('website.termsContactTitle', [], $currentLocale) }}</h3>
            <p class="text-slate-300 leading-relaxed mb-4">
              {{ trans('website.termsContactDescription', [], $currentLocale) }}
            </p>
            <div class="mt-4 p-4 bg-slate-700/30 rounded-lg">
              <p class="text-slate-300">{{ trans('website.footerEmailLabel', [], $currentLocale) }}: <a href="mailto:{{ $footerEmail }}" class="text-emerald-400 hover:text-emerald-300">{{ $footerEmail }}</a></p>
              <p class="text-slate-300">{{ trans('website.footerPhoneLabel', [], $currentLocale) }}: <a href="tel:{{ $footerPhone }}" class="text-emerald-400 hover:text-emerald-300" dir="ltr">{{ $footerPhone }}</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection