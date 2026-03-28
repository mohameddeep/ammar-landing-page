@extends('website.layouts.app')
@section('title', trans('website.contactTitle'))
@section('meta_description', trans('website.seoContactDescription'))
@section('content')

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="max-w-7xl mx-auto">
        @php
          $currentLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
          app()->setLocale($currentLocale);
          
          // Get footer data
          $footerWhatsApp = $footerContent['all']['whatsapp'] ?? $footerContent['whatsapp'] ?? '+966 XX XXX XXXX';
          $footerEmail = $footerContent['all']['email'] ?? $footerContent['email'] ?? 'info@example.com';
          $footerLocation = $footerContent['all']['location'] ?? $footerContent['location'] ?? 'المملكة العربية السعودية';
          $footerLocationEn = $footerContent['all']['location_en'] ?? $footerContent['location_en'] ?? 'Saudi Arabia';
          $mapLink = $footerContent['all']['google_map_link'] ?? $footerContent['google_map_link'] ?? 'https://www.google.com/maps/search/?api=1&query=Riyadh+Saudi+Arabia';
          $locationText = $currentLocale === 'ar' ? $footerLocation : $footerLocationEn;
          
          // Clean WhatsApp number for URL
          $whatsappNumber = preg_replace('/[^0-9+]/', '', $footerWhatsApp);
          $whatsappUrl = 'https://wa.me/' . $whatsappNumber;
        @endphp
        
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">{{ trans('website.contactTitle', [], $currentLocale) }}</h2>
          <p class="text-xl text-slate-400">{{ trans('website.contactSubtitle', [], $currentLocale) }}</p>
        </div>

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
                  rows="6" 
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
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.2385099999997!2d46.67527731500001!3d24.713554984123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%2C%20Saudi+Arabia!5e0!3m2!1sen!2sus!4v1699123456789!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="w-full"></iframe>
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