@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- Terms & Conditions Section -->
    <section id="terms" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="relative max-w-4xl mx-auto">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">⚖️ الشروط والأحكام</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">الشروط والأحكام</h2>
          <p class="text-xl text-slate-400">الشروط والأحكام التي تحكم استخدام موقعنا وخدماتنا</p>
        </div>

        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 space-y-8">
          
          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">1. قبول الشروط</h3>
            <p class="text-slate-300 leading-relaxed">
              بالدخول إلى هذا الموقع واستخدام خدماتنا، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي من هذه الشروط، يرجى عدم استخدام الموقع والخدمات.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. استخدام الموقع</h3>
            <p class="text-slate-300 leading-relaxed">
              تسمح لك بموجب هذه الشروط باستخدام الموقع لأغراض قانونية فقط. أنت توافق على عدم استخدام الموقع بأي طريقة قد تكون غير قانونية أو مؤذية أو تنتهك حقوق أي شخص.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. الملكية الفكرية</h3>
            <p class="text-slate-300 leading-relaxed">
              جميع المحتويات على الموقع، بما في ذلك النصوص والصور والرسومات والشعار وأكواد البرنامج، مملوكة لنا أو لمزودي المحتوى لدينا ومحمية بقوانين الملكية الفكرية. يُحظر نسخ أو توزيع أو تعديل أي محتوى بدون الحصول على إذن صريح منا.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">4. خدماتنا</h3>
            <p class="text-slate-300 leading-relaxed">
              نقدم خدمات في مجال البناء والتراخيص. نحتفظ بالحق في تعديل أو إيقاف أي جزء من الخدمات في أي وقت. لن نكون مسؤولين عن أي أضرار تنتج عن تعديل أو إيقاف الخدمات.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">5. تحديد المسؤولية</h3>
            <p class="text-slate-300 leading-relaxed">
              في أقصى حد يسمح به القانون، لن نكون مسؤولين عن أي أضرار مباشرة أو غير مباشرة أو عرضية أو خاصة أو تبعية ناشئة عن استخدامك للموقع أو الخدمات، حتى إذا تم إخطارنا بإمكانية حدوث مثل هذه الأضرار.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">6. إخلاء المسؤولية</h3>
            <p class="text-slate-300 leading-relaxed">
              يتم توفير الموقع والخدمات "كما هي" بدون ضمانات من أي نوع، سواء صريحة أو ضمنية. لا نضمن أن الموقع أو الخدمات خالية من الأخطاء أو الفيروسات أو غيرها.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">7. القانون الحاكم</h3>
            <p class="text-slate-300 leading-relaxed">
              تحكم هذه الشروط والأحكام بموجب قوانين المملكة العربية السعودية، وتخضع لاختصاص المحاكم السعودية.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">8. التعديلات</h3>
            <p class="text-slate-300 leading-relaxed">
              نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت. ستكون التعديلات سارية المفعول فور نشرها على الموقع. يعتبر استمرار استخدامك للموقع قبولاً للشروط المعدلة.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">9. الاتصال بنا</h3>
            <p class="text-slate-300 leading-relaxed">
              إذا كانت لديك أي أسئلة حول هذه الشروط والأحكام، يرجى التواصل معنا على:
            </p>
            <div class="mt-4 p-4 bg-slate-700/30 rounded-lg">
              <p class="text-slate-300">البريد الإلكتروني: <span class="text-emerald-400">info@construction.com</span></p>
              <p class="text-slate-300">الهاتف: <span class="text-emerald-400">+966 XX XXX XXXX</span></p>
            </div>
          </div>

          <div class="pt-4 border-t border-slate-700">
            <p class="text-slate-400 text-sm">آخر تحديث: نوفمبر 2024</p>
          </div>
        </div>
      </div>
    </section>

@endsection