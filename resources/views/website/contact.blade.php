@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold mb-4">تواصل معنا</h2>
          <p class="text-xl text-slate-400">نحن هنا للإجابة على جميع استفساراتك</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6">أرسل لنا رسالة</h3>
            <form id="contactForm" class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-slate-300">الاسم الكامل</label>
                <input type="text" id="name" name="name" required minlength="2" maxlength="100" class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400" placeholder="أدخل اسمك الكامل" />
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>
              <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-slate-300">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400" placeholder="example@email.com" />
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>
              <div>
                <label for="message" class="block text-sm font-semibold mb-2 text-slate-300">الرسالة</label>
                <textarea id="message" name="message" rows="6" required class="form-input w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 resize-none" placeholder="اكتب رسالتك هنا..."></textarea>
                <span class="error-message hidden text-red-400 text-sm mt-1 block"></span>
              </div>
              <button type="submit" class="w-full px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold">إرسال الرسالة</button>
              <div id="formMessage" class="hidden mt-4 p-4 rounded-xl text-center font-semibold"></div>
            </form>
          </div>

          <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-3xl border border-slate-700">
            <h3 class="text-3xl font-bold mb-6">موقعنا</h3>
            <div class="rounded-2xl overflow-hidden border border-slate-600 shadow-2xl">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.2385099999997!2d46.67527731500001!3d24.713554984123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%2C%20Saudi+Arabia!5e0!3m2!1sen!2sus!4v1699123456789!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="w-full"></iframe>
            </div>
            <div class="mt-6 p-4 bg-slate-700/30 rounded-xl">
              <p class="text-slate-300 text-center"><span class="font-semibold">العنوان:</span> المملكة العربية السعودية، الرياض</p>
            </div>
          </div>
        </div>
      </div>
    </section>

   @endsection