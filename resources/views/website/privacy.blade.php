@extends('website.layouts.app')
@section('title', __('website.services'))
@section('content')

    <!-- Privacy Policy Section -->
    <section id="privacy" class="py-20 px-6 bg-slate-900/50 relative overflow-hidden min-h-[80vh]">
      <div class="relative max-w-4xl mx-auto">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="px-6 py-2 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-400 text-sm font-semibold backdrop-blur-sm">🔒 سياسة الخصوصية</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-bold mb-6">سياسة الخصوصية</h2>
          <p class="text-xl text-slate-400">نحن نحترم خصوصيتك ونلتزم بحماية بيانات جميع زوارنا</p>
        </div>

        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 space-y-8">
          
          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">1. جمع المعلومات</h3>
            <p class="text-slate-300 leading-relaxed">
              نقوم بجمع معلومات شخصية من خلال نموذج الاتصال بهدف توفير الخدمات بشكل أفضل وللتواصل معك بشأن طلبات الخدمة. المعلومات التي نجمعها تشمل الاسم والبريد الإلكتروني ورقم الهاتف والرسالة.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">2. استخدام المعلومات</h3>
            <p class="text-slate-300 leading-relaxed">
              نستخدم المعلومات التي نجمعها للأغراض التالية:
            </p>
            <ul class="list-disc list-inside text-slate-300 mt-3 space-y-2">
              <li>الرد على استفسارات العملاء</li>
              <li>تقديم الخدمات المطلوبة</li>
              <li>تحسين تجربة المستخدم</li>
              <li>إرسال تحديثات وإعلانات ذات صلة (بعد الحصول على الموافقة)</li>
              <li>الامتثال للمتطلبات القانونية</li>
            </ul>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">3. حماية البيانات</h3>
            <p class="text-slate-300 leading-relaxed">
              نحن نتخذ جميع التدابير المعقولة لحماية بيانات العملاء من الوصول غير المصرح به والتعديل والحذف والإفصاح. نستخدم تقنيات التشفير وطرق أمان أخرى لضمان سلامة بيانات العملاء.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">4. مشاركة البيانات</h3>
            <p class="text-slate-300 leading-relaxed">
              لن نشارك معلوماتك الشخصية مع أطراف ثالثة بدون موافقتك، ما عدا الحالات التي يتطلبها القانون أو اللوائح. قد نشارك المعلومات مع موردينا وشركائنا الذين يلتزمون بمعايير الخصوصية نفسها.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">5. حقوقك</h3>
            <p class="text-slate-300 leading-relaxed">
              لديك الحق في الوصول إلى بياناتك الشخصية وتصحيحها وحذفها. إذا كنت ترغب في ممارسة أي من هذه الحقوق، يرجى التواصل معنا على البريد الإلكتروني المذكور أدناه.
            </p>
          </div>

          <div>
            <h3 class="text-2xl font-bold mb-4 text-emerald-400">6. الاتصال بنا</h3>
            <p class="text-slate-300 leading-relaxed">
              إذا كانت لديك أي أسئلة أو استفسارات بشأن سياسة الخصوصية هذه، يرجى التواصل معنا عبر:
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