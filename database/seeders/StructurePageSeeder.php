<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StructurePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('structure_pages')->insert([
            'title_ar' => 'الشروط والأحكام',
            'title_en' => 'Terms and Conditions',
            'content_ar' => '
                <p><strong>1. المقدمة</strong></p>
                <p>مرحبًا بك في [اسم التطبيق]، وهو تطبيق يهدف إلى [وصف مختصر للتطبيق، مثل بيع وشراء السيارات، تأجير السيارات، خدمات صيانة، إلخ]. من خلال استخدام التطبيق، فإنك توافق على الامتثال لهذه الشروط والأحكام. يُرجى قراءتها بعناية قبل استخدام خدماتنا.</p>
                <p><strong>2. التعريفات</strong></p>
                <ul>
                    <li>"التطبيق": يشير إلى [اسم التطبيق] والخدمات المتاحة من خلاله.</li>
                    <li>"المستخدم": أي شخص يقوم باستخدام التطبيق، سواء كان بائعًا أو مشتريًا أو مستأجرًا أو أي طرف آخر.</li>
                    <li>"البائع": أي شخص يعرض سيارة للبيع عبر التطبيق.</li>
                    <li>"المشتري": أي شخص يقوم بشراء أو البحث عن سيارة من خلال التطبيق.</li>
                    <li>"مقدم الخدمة": أي شركة أو فرد يقدم خدمات متعلقة بالسيارات (مثل الصيانة، التأمين، إلخ).</li>
                </ul>
                <p><strong>3. شروط استخدام التطبيق</strong></p>
                <ul>
                    <li>يجب أن يكون المستخدم بعمر 18 عامًا أو أكثر لاستخدام التطبيق.</li>
                    <li>يلتزم المستخدم بتقديم معلومات صحيحة عند التسجيل واستخدام التطبيق.</li>
                    <li>لا يُسمح باستخدام التطبيق لأي أنشطة غير قانونية أو تنتهك حقوق الآخرين.</li>
                    <li>نحتفظ بالحق في تعليق أو إيقاف أي حساب يستخدم التطبيق بشكل غير قانوني أو يخل بهذه الشروط. </li>
                </ul>
                <p><strong>4. شروط عرض وبيع السيارات</strong></p>
                <ul>
                    <li>يلتزم البائع بتقديم معلومات صحيحة ودقيقة عن السيارة، بما في ذلك الحالة الفنية والسعر والصور.</li>
                    <li>يتحمل البائع المسؤولية القانونية الكاملة عن صحة المعلومات المقدمة.</li>
                    <li>لا يُسمح بنشر إعلانات مضللة، أو تحتوي على صور غير حقيقية، أو معلومات خاطئة. </li>
                </ul>
                <p><strong>5. شروط الشراء والدفع</strong></p>
                <ul>
                    <li>يحق للمشتري التواصل مع البائع والاستفسار عن السيارة قبل إتمام الصفقة.</li>
                    <li>التطبيق لا يتحمل أي مسؤولية عن عمليات الدفع، حيث تتم الاتفاقيات مباشرةً بين الأطراف المعنية.</li>
                    <li>يُنصح المشتري بفحص السيارة والتأكد من حالتها قبل إتمام عملية الشراء.</li>
                </ul>
             ',
            'content_en' => '
              <p class="ql-align-right"><strong>1. Introduction</strong></p>
              <p class="ql-align-right">Welcome to [App Name], an app for [brief description of the app, such as buying and selling cars, renting cars, maintenance services, etc.]. By using the app, you agree to comply with these terms and conditions. Please read them carefully before using our services.</p>
              <p class="ql-align-right"><strong>2. Definitions</strong></p>
              <ul>
                  <li class="ql-align-right">"App": refers to [App Name] and the services available through it.</li>
                  <li class="ql-align-right">"User": anyone who uses the app, whether a seller, buyer, lessee, or any other party.</li>
                  <li class="ql-align-right">"Seller": anyone who offers a car for sale through the app.</li>
                  <li class="ql-align-right">"Buyer": anyone who purchases or searches for a car through the app.</li>
                  <li class="ql-align-right">"Service Provider": any company or individual who provides car-related services (such as maintenance, insurance, etc.).</li>
              </ul>
              <p class="ql-align-right"><strong>3. App Terms of Use</strong></p>
              <ul>
                  <li class="ql-align-right">The user must be 18 years or older to use the app.</li>
                  <li class="ql-align-right">The user is obligated to provide accurate information when registering and using the app.</li>
                  <li class="ql-align-right">The app may not be used for any illegal activities or that violates the rights of others.</li>
                  <li class="ql-align-right">We reserve the right to suspend or terminate any account that uses the app illegally or violates these terms.</li>
              </ul>
              <p class="ql-align-right"><strong>4. Terms of Car Offering and Sale</strong></p>
              <ul>
                  <li class="ql-align-right">The seller is obligated to provide true and accurate information about the vehicle, including technical condition, price, and images.</li>
                  <li class="ql-align-right">The seller bears full legal responsibility for the accuracy of the information provided.</li>
                  <li class="ql-align-right">Misleading advertisements, or advertisements containing false images or false information, are not permitted.</li>
              </ul>
              <p class="ql-align-right"><strong>5. Terms of Purchase and Payment</strong></p>
              <ul>
                  <li class="ql-align-right">The buyer has the right to contact the seller and inquire about the vehicle before completing the transaction.</li>
                  <li class="ql-align-right">The application is not responsible for payment transactions, as agreements are made directly between the parties involved.</li>
                  <li class="ql-align-right">The buyer is advised to inspect the vehicle and verify its condition before completing the purchase.</li>
              </ul>
            ',
            'type' => 'terms',
        ]);

        DB::table('structure_pages')->insert([
            'title_ar' => 'سياسة الخصوصية',
            'title_en' => 'Privacy Policy',
            'content_ar' => '
               <p><strong>1.المقدمة</strong></p>
               <p>مرحبًا بك في [اسم التطبيق]! نحن نلتزم بحماية خصوصيتك وبياناتك الشخصية. توضح هذه السياسة كيفية جمع بياناتك واستخدامها ومشاركتها عند استخدامك لتطبيقنا. يرجى قراءة هذه السياسة بعناية.</p>
               <p>2. المعلومات التي نقوم بجمعها</p>
               <p>عند استخدامك للتطبيق، قد نقوم بجمع المعلومات التالية:</p>
               <p><strong>2.1. المعلومات التي تقدمها لنا مباشرة</strong></p>
               <ul>
                  <li>الاسم الكامل.</li>
                  <li>رقم الهاتف.</li>
                  <li>عنوان البريد الإلكتروني.</li>
                  <li>بيانات تسجيل الدخول (اسم المستخدم وكلمة المرور).</li>
                  <li>معلومات السيارة (للإعلانات).</li>
                  <li>أي معلومات أخرى تقدمها أثناء استخدام التطبيق. </li>
               </ul>
               <p><strong>2.2. المعلومات التي يتم جمعها تلقائيًا</strong></p>
               <ul>
                  <li>بيانات الجهاز: نوع الجهاز، نظام التشغيل، نوع المتصفح.</li>
                  <li>بيانات الاستخدام: عدد مرات استخدام التطبيق، الصفحات التي تزورها، مدة الاستخدام.</li>
                  <li>الموقع الجغرافي (إذا وافقت على مشاركته).</li>
                  <li>ملفات تعريف الارتباط (Cookies) وتقنيات التتبع الأخرى. </li>
                </ul>
                <p><strong>3. كيفية استخدامنا لمعلوماتك</strong></p>
                <p>نستخدم المعلومات التي نجمعها للأغراض التالية:</p>
                <ul>
                   <li>تحسين تجربة المستخدم في التطبيق.</li>
                   <li>تسهيل عمليات البيع والشراء والتأجير داخل التطبيق.</li>
                   <li>إرسال إشعارات وتنبيهات متعلقة بحسابك أو بعروض جديدة.</li>
                   <li>تحسين أمان التطبيق وحمايتك من الأنشطة الاحتيالية.</li>
                   <li>الامتثال للمتطلبات القانونية والتنظيمية. </li>
                 </ul>
                 <p><strong>4. مشاركة المعلومات مع أطراف ثالثة</strong></p>
                 <p>نحن لا نبيع أو نشارك بياناتك مع أطراف خارجية لأغراض تسويقية، ولكن قد نشاركها مع:</p>
                 <ul>
                    <li>مزودي الخدمات (مثل خدمات الدفع، الاستضافة، التحليلات).</li>
                    <li>الجهات القانونية إذا طُلب منا ذلك بموجب القانون.</li>
                    <li>أطراف أخرى عند موافقتك على ذلك.</li>
                 </ul>
            ',
            'content_en' => '
              <p class="ql-align-right"><strong class="ql-size-large">Introduction .1</strong></p>
              <p class="ql-align-right">Welcome to [App Name]! We are committed to protecting your privacy and personal data. This policy explains how we collect, use, and share your data when you use our App. Please read this policy carefully.</p>
              <p class="ql-align-right">2. Information We Collect</p>
              <p class="ql-align-right">When you use the App, we may collect the following information:</p>
              <p class="ql-align-right"><strong>2.1. Information You Provide Directly</strong></p>
              <ul>
                  <li class="ql-align-right">Full Name</li>
                  <li class="ql-align-right">Phone Number</li>
                  <li class="ql-align-right">Email Address</li>
                  <li class="ql-align-right">Login Information (Username and Password)</li>
                  <li class="ql-align-right">Car Information (for advertising)</li>
                  <li class="ql-align-right">Any other information you provide while using the App.</li>
              </ul>
              <p class="ql-align-right"><strong>2.2. Information Collected Automatically</strong></p>
              <ul>
                  <li class="ql-align-right">Device Data: Device Type, Operating System, Browser Type</li>
                  <li class="ql-align-right">Usage Data: Number of times you use the App, pages you visit, duration of use</li>
                  <li class="ql-align-right">Geolocation (if you have agreed to share it)</li>
                  <li class="ql-align-right">Cookies and Other Tracking Technologies</li>
              </ul>
              <p class="ql-align-right"><strong>3. How We Use Your Information</strong></p>
              <p class="ql-align-right">We use the information we collect for the following purposes:</p>
              <ul>
                  <li class="ql-align-right">Improving your user experience on the App.</li>
                  <li class="ql-align-right">Facilitating in-app buying, selling, and renting.</li>
                  <li class="ql-align-right">Sending notifications and alerts related to your account or new offers.</li>
                  <li class="ql-align-right">Improve app security and protect you from fraudulent activity.</li>
                  <li class="ql-align-right">Complying with legal and regulatory requirements.</li>
              </ul>
              <p class="ql-align-right"><strong>4. Sharing Information with Third Parties</strong></p>
              <p class="ql-align-right">We do not sell or share your data with third parties for marketing purposes, but we may share it with:</p>
              <ul>
                  <li class="ql-align-right">Service providers (such as payment, hosting, and analytics services).</li>
                  <li class="ql-align-right">Legal entities if required to do so by law.</li>
                  <li class="ql-align-right">Other parties with your consent.</li>
              </ul>
            ',
            'type' => 'privacy',
        ]);
    }
}
