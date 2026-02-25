    <!-- Footer -->
    @php
      use App\Repository\ServiceRepositoryInterface;
      
      $currentLocale = $currentLocale ?? \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() ?? app()->getLocale() ?? 'ar';
      app()->setLocale($currentLocale);
      
      // Get footer data
      $footerData = $footerContent ?? [];
      $websiteName = $footerData['website_name'][$currentLocale] ?? ($footerData['website_name']['ar'] ?? 'البناء المتقدم');
      $footerDescription = $footerData['content'][$currentLocale] ?? ($footerData['content']['ar'] ?? 'شريكك الموثوق في خدمات البناء والتراخيص');
      $footerCopyright = $footerData['copyright'][$currentLocale] ?? ($footerData['copyright']['ar'] ?? '© 2024 جميع الحقوق محفوظة');
      
      // Social media links
      $facebookLink = $footerData['all']['facebook_link'] ?? $footerData['facebook_link'] ?? '#';
      $twitterLink = $footerData['all']['twitter_link'] ?? $footerData['twitter_link'] ?? '#';
      $linkedinLink = $footerData['all']['linkedin_link'] ?? $footerData['linkedin_link'] ?? '#';
      $instagramLink = $footerData['all']['instagram_link'] ?? $footerData['instagram_link'] ?? '#';
      
      // Contact info
      $footerPhone = $footerData['all']['phone'] ?? $footerData['phone'] ?? '+966 XX XXX XXXX';
      $footerEmail = $footerData['all']['email'] ?? $footerData['email'] ?? 'info@example.com';
      $footerLocation = $footerData['all']['location'] ?? $footerData['location'] ?? 'المملكة العربية السعودية';
      $footerLocationEn = $footerData['all']['location_en'] ?? $footerData['location_en'] ?? 'Saudi Arabia';
      $locationText = $currentLocale === 'ar' ? $footerLocation : $footerLocationEn;
      
      // WhatsApp
      $footerWhatsApp = $footerData['all']['whatsapp'] ?? $footerData['whatsapp'] ?? '+966501234567';
      $whatsappNumber = preg_replace('/[^0-9+]/', '', $footerWhatsApp);
      $whatsappUrl = 'https://wa.me/' . $whatsappNumber;
      
      // Get active services for footer
      $footerServices = app(ServiceRepositoryInterface::class)->getActive(['id', 'title_ar', 'title_en'])->take(4);
      
      // WhatsApp button position
      $isRTL = $currentLocale === 'ar';
      $positionClass = $isRTL ? 'right-6' : 'left-6';
      $notificationPosition = $isRTL ? '-left-1' : '-right-1';
    @endphp
    <footer class="relative bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 border-t border-slate-800/50 overflow-hidden">
      <!-- Background Effects -->
      <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
      </div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-12">
          <!-- Company Info -->
          <div class="lg:col-span-1">
            <div class="flex items-center gap-2 mb-6">
              @if(isset($footerData['image']) && $footerData['image'])
                <img src="{{ asset($footerData['image']) }}" alt="{{ $websiteName }}" class="w-12 h-12 object-contain" />
              @else
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                  <span class="text-white font-bold text-xl">🏗</span>
                </div>
              @endif
              <span class="text-2xl font-bold gradient-text">{{ $websiteName }}</span>
            </div>
            <p class="text-slate-400 mb-6 leading-relaxed">
              {!! $footerDescription !!}
            </p>
            <!-- Social Media Links -->
            <div class="flex gap-3">
              <a href="{{ $facebookLink }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-800/80 hover:bg-emerald-500/20 border border-slate-700 hover:border-emerald-500/50 rounded-lg flex items-center justify-center text-slate-400 hover:text-emerald-400 transition-all hover:scale-110" aria-label="Facebook">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="{{ $twitterLink }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-800/80 hover:bg-cyan-500/20 border border-slate-700 hover:border-cyan-500/50 rounded-lg flex items-center justify-center text-slate-400 hover:text-cyan-400 transition-all hover:scale-110" aria-label="Twitter">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>
              <a href="{{ $linkedinLink }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-800/80 hover:bg-blue-500/20 border border-slate-700 hover:border-blue-500/50 rounded-lg flex items-center justify-center text-slate-400 hover:text-blue-400 transition-all hover:scale-110" aria-label="LinkedIn">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
              <a href="{{ $instagramLink }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-800/80 hover:bg-rose-500/20 border border-slate-700 hover:border-rose-500/50 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-400 transition-all hover:scale-110" aria-label="Instagram">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-bold text-white mb-6">{{ trans('website.footerQuickLinks', [], $currentLocale) }}</h3>
            <ul class="space-y-3">
              <li>
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/services') }}" class="text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                  <span>{{ trans('website.navServices', [], $currentLocale) }}</span>
                </a>
              </li>
              <li>
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl('/about-us') }}" class="text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                  <span>{{ trans('website.navAbout', [], $currentLocale) }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('website.contact.index') }}" class="text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                  <span>{{ trans('website.navContact', [], $currentLocale) }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('website.privacy.index') }}" class="text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                  <span>{{ trans('website.footerPrivacy', [], $currentLocale) }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('website.terms.index') }}" class="text-slate-400 hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                  <span>{{ trans('website.footerTerms', [], $currentLocale) }}</span>
                </a>
              </li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h3 class="text-lg font-bold text-white mb-6">{{ trans('website.footerServices', [], $currentLocale) }}</h3>
            <ul class="space-y-3">
              @forelse($footerServices as $service)
                <li>
                  <a href="{{ route('website.service.show', $service->id) }}" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group">
                    <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <span>{{ $service->t('title') }}</span>
                  </a>
                </li>
              @empty
                <li>
                  <a href="{{ route('website.services.index') }}" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group">
                    <span class="w-1.5 h-1.5 bg-cyan-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <span>{{ trans('website.navServices', [], $currentLocale) }}</span>
                  </a>
                </li>
              @endforelse
            </ul>
          </div>

          <!-- Contact Info -->
          <div>
            <h3 class="text-lg font-bold text-white mb-6">{{ trans('website.footerContact', [], $currentLocale) }}</h3>
            <ul class="space-y-4">
              <li class="flex items-start gap-3">
                <div class="w-10 h-10 bg-emerald-500/10 border border-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                  <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-slate-400 text-sm mb-1">{{ trans('website.footerPhoneLabel', [], $currentLocale) }}</p>
                  <p class="text-white font-medium">{{ $footerPhone }}</p>
                  </div>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-10 h-10 bg-cyan-500/10 border border-cyan-500/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                  <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-slate-400 text-sm mb-1">{{ trans('website.footerEmailLabel', [], $currentLocale) }}</p>
                  <p class="text-white font-medium">{{ $footerEmail }}</p>

                </div>
              </li>
              <li class="flex items-start gap-3">
                <div class="w-10 h-10 bg-blue-500/10 border border-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                  <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-slate-400 text-sm mb-1">{{ trans('website.footerLocationLabel', [], $currentLocale) }}</p>
                  <p class="text-white font-medium">{{ $locationText }}</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-slate-800/50">
          <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">{!! $footerCopyright !!}</p>
            <div class="flex items-center gap-2 text-slate-500 text-sm">
              <span>{{ trans('website.footerMadeWith', [], $currentLocale) }}</span>
              <span class="text-red-400 animate-pulse">❤️</span>
              <span>{{ trans('website.footerIn', [], $currentLocale) }}</span>
              <span class="text-emerald-400 font-semibold">{{ trans('website.footerSaudi', [], $currentLocale) }}</span>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a 
      href="{{ $whatsappUrl }}" 
      target="_blank" 
      rel="noopener noreferrer"
      class="whatsapp-float fixed bottom-6 {{ $positionClass }} z-50 w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-full shadow-lg shadow-green-500/50 flex items-center justify-center hover:scale-110 transition-all duration-300 opacity-0 invisible group"
      id="whatsappButton"
      aria-label="{{ trans('website.whatsapp', [], $currentLocale) }}"
    >
      <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
      </svg>
      <span class="absolute -top-1 {{ $notificationPosition }} w-4 h-4 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
    </a>

    <style>
      .whatsapp-float {
        animation: fadeInUp 0.5s ease-out forwards;
      }
      
      .whatsapp-float.visible {
        opacity: 1 !important;
        visibility: visible !important;
      }
      
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      
      .whatsapp-float:hover {
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.5);
      }
      
      @media (max-width: 768px) {
        .whatsapp-float {
          bottom: 20px;
          width: 56px;
          height: 56px;
        }
      }
    </style>

    <script>
      // Show WhatsApp button on scroll
      let whatsappButton = document.getElementById('whatsappButton');
      let scrollThreshold = 300; // Show after scrolling 300px
      
      function toggleWhatsAppButton() {
        if (window.scrollY > scrollThreshold) {
          whatsappButton.classList.add('visible');
          whatsappButton.classList.remove('opacity-0', 'invisible');
        } else {
          whatsappButton.classList.remove('visible');
          whatsappButton.classList.add('opacity-0', 'invisible');
        }
      }
      
      // Check on scroll
      window.addEventListener('scroll', toggleWhatsAppButton);
      
      // Check on page load
      toggleWhatsAppButton();
    </script>

    <script>


// Translations object




function updateSliderDirection() {
  const isRTL = currentLang === 'ar';
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn && nextBtn) {
    // Remove all position classes first
    prevBtn.classList.remove('left-4', 'right-4');
    nextBtn.classList.remove('left-4', 'right-4');
    
    // Add correct positions for RTL/LTR
    if (isRTL) {
      // RTL: prev on right, next on left
      prevBtn.classList.add('right-4');
      nextBtn.classList.add('left-4');
    } else {
      // LTR: prev on left, next on right
      prevBtn.classList.add('left-4');
      nextBtn.classList.add('right-4');
    }
  }
  
  // Update slide transitions for RTL/LTR
  const slides = document.querySelectorAll('.slide');
  slides.forEach(slide => {
    if (slide.classList.contains('active')) {
      // Keep active slide visible
      slide.style.transform = 'translateX(0)';
    } else if (slide.classList.contains('prev')) {
      // Position prev slide correctly based on direction
      slide.style.transform = isRTL ? 'translateX(100%)' : 'translateX(-100%)';
    } else {
      // Position inactive slides correctly based on direction
      slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
    }
  });
}


// Hero Slider Functionality
(function() {
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.slider-dot');
  const totalSlides = slides.length;
  let autoPlayInterval;

  // Preload images for better performance
  function preloadImages() {
    const images = document.querySelectorAll('.slide-image');
    images.forEach((img, index) => {
      if (img.complete) {
        img.classList.add('loaded');
      } else {
        img.addEventListener('load', function() {
          this.classList.add('loaded');
        });
        img.addEventListener('error', function() {
          // Fallback if image fails to load
          this.style.display = 'none';
        });
      }
    });
  }

  // Initialize image preloading
  preloadImages();

  // Initialize slider direction on load - exposed globally
  window.initializeSliderDirection = function() {
    const isRTL = document.documentElement.dir === 'rtl';
    slides.forEach((slide, i) => {
      if (slide.classList.contains('active')) {
        slide.style.transform = 'translateX(0)';
      } else {
        slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
      }
    });
  };

  // Initialize on page load
  window.initializeSliderDirection();

  function showSlide(index) {
    const isRTL = document.documentElement.dir === 'rtl';
    
    // Remove active class from all slides and dots
    slides.forEach(slide => {
      slide.classList.remove('active', 'prev');
    });
    dots.forEach(dot => dot.classList.remove('active'));

    // Add active class to current slide and dot
    slides[index].classList.add('active');
    dots[index].classList.add('active');

    // Add prev class to previous slide for animation
    const prevIndex = index === 0 ? totalSlides - 1 : index - 1;
    slides[prevIndex].classList.add('prev');

    // Update transforms based on direction
    slides.forEach((slide, i) => {
      if (i === index) {
        slide.style.transform = 'translateX(0)';
      } else if (i === prevIndex) {
        slide.style.transform = isRTL ? 'translateX(100%)' : 'translateX(-100%)';
      } else {
        slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
      }
    });

    // Trigger image zoom animation
    const activeSlideImage = slides[index].querySelector('.slide-image');
    if (activeSlideImage) {
      activeSlideImage.style.animation = 'none';
      setTimeout(() => {
        activeSlideImage.style.animation = 'zoomIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards';
      }, 3000);
    }

    currentSlide = index;
  }

  function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    showSlide(next);
  }

  function prevSlide() {
    const prev = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1;
    showSlide(prev);
  }

  // Navigation buttons
  document.getElementById('nextBtn').addEventListener('click', () => {
    const isRTL = document.documentElement.dir === 'rtl';
    if (isRTL) {
      nextSlide();
    } else {
      prevSlide();
    }
    resetAutoPlay();
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    const isRTL = document.documentElement.dir === 'rtl';
    if (isRTL) {
      prevSlide();
    } else {
      nextSlide();
    }
    resetAutoPlay();
  });

  // Dot navigation
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      showSlide(index);
      resetAutoPlay();
    });
  });

  // Auto-play functionality
  function startAutoPlay() {
    autoPlayInterval = setInterval(nextSlide, 5000);
  }

  function resetAutoPlay() {
    clearInterval(autoPlayInterval);
    startAutoPlay();
  }

  // Pause on hover and parallax effect
  const slider = document.querySelector('.hero-slider');
  if (slider) {
    slider.addEventListener('mouseenter', () => {
      clearInterval(autoPlayInterval);
    });

    slider.addEventListener('mouseleave', () => {
      startAutoPlay();
      // Reset parallax effect
      const activeSlide = slider.querySelector('.slide.active');
      if (activeSlide) {
        const image = activeSlide.querySelector('.slide-image');
        if (image) {
          image.style.transform = 'scale(1)';
        }
      }
    });

    // Parallax effect on mouse move (optional enhancement)
    slider.addEventListener('mousemove', (e) => {
      const activeSlide = slider.querySelector('.slide.active');
      if (activeSlide) {
        const image = activeSlide.querySelector('.slide-image');
        if (image && window.innerWidth > 768) {
          const rect = slider.getBoundingClientRect();
          const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
          const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;
          image.style.transform = `scale(1.05) translate(${x}px, ${y}px)`;
        }
      }
    });

    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    });

    slider.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    });

    function handleSwipe() {
      const swipeThreshold = 50;
      const diff = touchStartX - touchEndX;
      const isRTL = document.documentElement.dir === 'rtl';

      if (Math.abs(diff) > swipeThreshold) {
        if ((isRTL && diff > 0) || (!isRTL && diff < 0)) {
          nextSlide();
        } else {
          prevSlide();
        }
        resetAutoPlay();
      }
    }
  }

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
      e.preventDefault();
      const isRTL = document.documentElement.dir === 'rtl';
      if ((isRTL && e.key === 'ArrowRight') || (!isRTL && e.key === 'ArrowLeft')) {
        prevSlide();
      } else {
        nextSlide();
      }
      resetAutoPlay();
    }
  });

  // Initialize auto-play
  startAutoPlay();
})();


// Smooth scroll for anchor links with active state update
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#' || href === '#!') {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      // Update active state after scroll
      setTimeout(() => {
        if (typeof window.updateActiveLink === 'function') {
          window.updateActiveLink();
        }
      }, 500);
      return;
    }
    
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      const navbarHeight = 80;
      const offsetTop = target.offsetTop - navbarHeight;
      
      // Update active state immediately for better UX
      document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
        link.classList.remove('active');
      });
      this.classList.add('active');
      
      window.scrollTo({
        top: offsetTop,
        behavior: 'smooth'
      });
      
      // Update active state after scroll completes
      const updateAfterScroll = () => {
        const scrollY = window.pageYOffset || window.scrollY;
        const targetTop = target.offsetTop - navbarHeight;
        const targetBottom = target.offsetTop + target.offsetHeight - navbarHeight;
        
        if (scrollY >= targetTop - 10 && scrollY <= targetBottom + 10) {
          if (typeof window.updateActiveLink === 'function') {
            window.updateActiveLink();
          }
        } else {
          // Continue checking until we reach the target
          requestAnimationFrame(updateAfterScroll);
        }
      };
      
      // Start checking after a short delay
      setTimeout(() => {
        updateAfterScroll();
      }, 100);
      
      // Final update after scroll should be complete
      setTimeout(() => {
        if (typeof window.updateActiveLink === 'function') {
          window.updateActiveLink();
        }
      }, 800);
    }
  });
});

// Service details toggle buttons
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.service-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.service-card');
      if (!card) return;
      const details = card.querySelector('.service-details');
      const expanded = btn.getAttribute('aria-expanded') === 'true';

      if (details) {
        details.classList.toggle('hidden');
      }

      btn.setAttribute('aria-expanded', String(!expanded));

      // Update button label (simple toggle) — language will be reapplied by setLanguage when switching
      const labelSpan = btn.querySelector('[data-i18n]');
      if (labelSpan) {
        if (!expanded) {
          // now expanded -> show "Hide" text
          labelSpan.textContent = currentLang === 'ar' ? 'إخفاء' : 'Hide';
        } else {
          // collapsed -> show learn more
          labelSpan.textContent = translations[currentLang].serviceLearnMore || (currentLang === 'ar' ? 'اعرف المزيد' : 'Learn More');
        }
      }
    });
  });
});

    </script>
  </body>
</html>
