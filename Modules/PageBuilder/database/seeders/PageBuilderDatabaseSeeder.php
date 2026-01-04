<?php

namespace Modules\PageBuilder\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\PageBuilder\app\Models\CustomizeablePage;
use Modules\PageBuilder\app\Models\CustomizablePageTranslation;

class PageBuilderDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        $page = new CustomizeablePage();
        $page->slug = 'terms-contidions';
        if ($page->save()) {
            // English
            CustomizablePageTranslation::create([
                'customizeable_page_id' => $page->id,
                'lang_code' => 'en',
                'title' => 'Terms & Conditions - Syrian Law Firm',
                'description' => '<h3 class="title">About Our Law Firm</h3>
                <p>Welcome to Syrian Law Firm. Our website provides legal services and information according to Syrian law. By using our website and services, you agree to these terms and conditions.</p>
                <h3 class="title">Legal Services</h3>
                <p>We provide professional legal consultation and representation services in Syria across various areas including civil law, commercial law, family law, criminal law, real estate law, labor law, and administrative law. All services are provided in accordance with Syrian legislation and regulations.</p>
                <h3 class="title">Consultation Appointments</h3>
                <p>When you book a consultation appointment through our website, you agree to provide accurate information. Appointments can be rescheduled or cancelled by contacting our office at least 24 hours in advance. Our lawyers are available from Saturday to Thursday, 9:00 AM to 5:00 PM Damascus time.</p>
                <h3 class="title">Confidentiality</h3>
                <p>All information shared with our lawyers is protected by attorney-client privilege under Syrian law. We maintain strict confidentiality of all client information and legal matters.</p>
                <h3 class="title">Legal Fees</h3>
                <p>Legal fees vary depending on the complexity of the case and type of service required. Fee structures will be clearly explained during the initial consultation. Payment terms and methods will be agreed upon before starting work on your case.</p>
                <h3 class="title">Limitation of Liability</h3>
                <p>While we strive to provide accurate legal information and professional services, legal outcomes cannot be guaranteed. Our liability is limited to the scope of services provided as agreed upon in the engagement agreement.</p>
                <h3 class="title">Contact Information</h3>
                <p>For any questions regarding these terms, please contact us at our Damascus office or through our website contact form.</p>',
            ]);
            
            // Arabic
            CustomizablePageTranslation::create([
                'customizeable_page_id' => $page->id,
                'lang_code' => 'ar',
                'title' => 'الشروط والأحكام - مكتب المحاماة السوري',
                'description' => '<h3 class="title">عن مكتبنا القانوني</h3>
                <p>مرحباً بكم في مكتب المحاماة السوري. يقدم موقعنا خدمات ومعلومات قانونية وفقاً للقانون السوري. باستخدامك لموقعنا وخدماتنا، فإنك توافق على هذه الشروط والأحكام.</p>
                <h3 class="title">الخدمات القانونية</h3>
                <p>نقدم خدمات استشارات قانونية وتمثيل قانوني احترافي في سوريا عبر مختلف المجالات بما في ذلك القانون المدني والتجاري وقانون الأسرة والقانون الجنائي وقانون العقارات وقانون العمل والقانون الإداري. جميع الخدمات تُقدم وفقاً للتشريعات والأنظمة السورية.</p>
                <h3 class="title">مواعيد الاستشارات</h3>
                <p>عند حجز موعد استشارة عبر موقعنا، فإنك توافق على تقديم معلومات دقيقة. يمكن إعادة جدولة المواعيد أو إلغاؤها عن طريق الاتصال بمكتبنا قبل 24 ساعة على الأقل. محامونا متاحون من السبت إلى الخميس، من الساعة 9:00 صباحاً حتى 5:00 مساءً بتوقيت دمشق.</p>
                <h3 class="title">السرية</h3>
                <p>جميع المعلومات المشتركة مع محامينا محمية بموجب سرية العلاقة بين المحامي والموكل وفقاً للقانون السوري. نحافظ على سرية صارمة لجميع معلومات العملاء والمسائل القانونية.</p>
                <h3 class="title">أتعاب المحاماة</h3>
                <p>تختلف أتعاب المحاماة حسب تعقيد القضية ونوع الخدمة المطلوبة. سيتم شرح هيكل الأتعاب بوضوح خلال الاستشارة الأولية. سيتم الاتفاق على شروط وطرق الدفع قبل البدء بالعمل على قضيتك.</p>
                <h3 class="title">حدود المسؤولية</h3>
                <p>بينما نسعى لتقديم معلومات قانونية دقيقة وخدمات احترافية، لا يمكن ضمان النتائج القانونية. تقتصر مسؤوليتنا على نطاق الخدمات المقدمة كما هو متفق عليه في اتفاقية التكليف.</p>
                <h3 class="title">معلومات الاتصال</h3>
                <p>لأي استفسارات حول هذه الشروط، يرجى الاتصال بنا في مكتبنا في دمشق أو من خلال نموذج الاتصال على موقعنا.</p>',
            ]);
        }

        $page = new CustomizeablePage();
        $page->slug = 'privacy-policy';
        if ($page->save()) {
            // English
            CustomizablePageTranslation::create([
                'customizeable_page_id' => $page->id,
                'lang_code' => 'en',
                'title' => 'Privacy Policy - Syrian Law Firm',
                'description' => '<h3 class="title">Our Commitment to Privacy</h3>
                <p>Syrian Law Firm (www.syrianlaw.com) is committed to protecting the privacy and confidentiality of our clients and website visitors. This privacy policy explains how we collect, use, and protect your personal information in accordance with Syrian data protection regulations.</p>
                <h3 class="title">Information We Collect</h3>
                <p>We collect information that you provide when booking consultations, contacting us, or registering on our website. This may include your name, email address, phone number, and details about your legal matter. All case-related information is subject to attorney-client privilege under Syrian law.</p>
                <h3 class="title">How We Use Your Information</h3>
                <p>We use your information to provide legal services, schedule consultations, communicate with you about your case, and improve our services. We will never share your personal or case information with third parties without your explicit consent, except as required by Syrian law.</p>
                <h3 class="title">Data Security</h3>
                <p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, loss, or alteration. All client information is stored securely and access is limited to authorized personnel only.</p>
                <h3 class="title">Attorney-Client Confidentiality</h3>
                <p>All communications and information shared with our lawyers are protected by attorney-client privilege as established in Syrian legal practice. This means your information is kept strictly confidential and cannot be disclosed without your permission.</p>
                <h3 class="title">Your Rights</h3>
                <p>You have the right to access, correct, or delete your personal information at any time. You may also request a copy of the data we hold about you. To exercise these rights, please contact our office.</p>
                <h3 class="title">Cookies</h3>
                <p>Our website uses cookies to improve your browsing experience. You can control cookie settings through your browser preferences.</p>
                <h3 class="title">Contact Us</h3>
                <p>If you have any questions about this privacy policy or how we handle your data, please contact us at contact@syrianlaw.com or visit our Damascus office.</p>',
            ]);
            
            // Arabic
            CustomizablePageTranslation::create([
                'customizeable_page_id' => $page->id,
                'lang_code' => 'ar',
                'title' => 'سياسة الخصوصية - مكتب المحاماة السوري',
                'description' => '<h3 class="title">التزامنا بالخصوصية</h3>
                <p>يلتزم مكتب المحاماة السوري (www.syrianlaw.com) بحماية خصوصية وسرية عملائنا وزوار موقعنا. توضح سياسة الخصوصية هذه كيفية جمعنا واستخدامنا وحماية معلوماتك الشخصية وفقاً لأنظمة حماية البيانات السورية.</p>
                <h3 class="title">المعلومات التي نجمعها</h3>
                <p>نجمع المعلومات التي تقدمها عند حجز الاستشارات أو الاتصال بنا أو التسجيل على موقعنا. قد تشمل هذه المعلومات اسمك وعنوان بريدك الإلكتروني ورقم هاتفك وتفاصيل حول مسألتك القانونية. جميع المعلومات المتعلقة بالقضية تخضع لسرية العلاقة بين المحامي والموكل بموجب القانون السوري.</p>
                <h3 class="title">كيف نستخدم معلوماتك</h3>
                <p>نستخدم معلوماتك لتقديم الخدمات القانونية وجدولة الاستشارات والتواصل معك بشأن قضيتك وتحسين خدماتنا. لن نشارك معلوماتك الشخصية أو معلومات قضيتك مع أطراف ثالثة دون موافقتك الصريحة، إلا كما يقتضي القانون السوري.</p>
                <h3 class="title">أمن البيانات</h3>
                <p>نطبق التدابير التقنية والتنظيمية المناسبة لحماية بياناتك الشخصية من الوصول غير المصرح به أو الفقدان أو التعديل. يتم تخزين جميع معلومات العملاء بشكل آمن ويقتصر الوصول إليها على الموظفين المصرح لهم فقط.</p>
                <h3 class="title">سرية العلاقة بين المحامي والموكل</h3>
                <p>جميع الاتصالات والمعلومات المشتركة مع محامينا محمية بموجب سرية العلاقة بين المحامي والموكل كما هو مُحدد في الممارسة القانونية السورية. هذا يعني أن معلوماتك تُحفظ بسرية تامة ولا يمكن الكشف عنها دون إذنك.</p>
                <h3 class="title">حقوقك</h3>
                <p>لديك الحق في الوصول إلى معلوماتك الشخصية أو تصحيحها أو حذفها في أي وقت. يمكنك أيضاً طلب نسخة من البيانات التي نحتفظ بها عنك. لممارسة هذه الحقوق، يرجى الاتصال بمكتبنا.</p>
                <h3 class="title">ملفات تعريف الارتباط (Cookies)</h3>
                <p>يستخدم موقعنا ملفات تعريف الارتباط لتحسين تجربة التصفح الخاصة بك. يمكنك التحكم في إعدادات ملفات تعريف الارتباط من خلال تفضيلات المتصفح الخاص بك.</p>
                <h3 class="title">اتصل بنا</h3>
                <p>إذا كانت لديك أي أسئلة حول سياسة الخصوصية هذه أو كيفية تعاملنا مع بياناتك، يرجى الاتصال بنا على contact@syrianlaw.com أو زيارة مكتبنا في دمشق.</p>',
            ]);
        }

        $page = new CustomizeablePage();
        $page->slug = 'example';
        if ($page->save()) {
            foreach (allLanguages() as $language) {
                CustomizablePageTranslation::create([
                    'customizeable_page_id' => $page->id,
                    'lang_code' => $language->code,
                    'title' => 'Example Page',
                    'description' => '<h3 class="title">Who we are</h3>
                    <p><b>Suggested text:</b> Our website address is: https://yourwebsite.com</p>
                    <h3 class="title">Comments</h3>
                    <p><b>Suggested text:</b> When visitors leave comments on the site we collect the data shown
                        in the comments form, and also the visitor’s IP address and browser user agent string to
                        help spam detection.</p>
                    <p>An anonymized string created from your email address (also called a hash) may be provided
                        to the Gravatar service to see if you are using it. The Gravatar service privacy policy
                        is available here: https://automattic.com/privacy/. After approval of your comment, your
                        profile picture is visible to the public in the context of your comment.</p>
                    <h3 class="title">Media</h3>
                    <p><b>Suggested text:</b> If you upload images to the website, you should avoid uploading
                        images with embedded location data (EXIF GPS) included. Visitors to the website can
                        download and extract any location data from images on the website.</p>
                    <h3 class="title">Cookies</h3>
                    <p><b>Suggested text:</b> If you leave a comment on our site you may opt-in to saving your
                        name, email address and website in
                        cookies. These are for your convenience so that you do not have to fill in your details
                        again when you leave another
                        comment. These cookies will last for one year.</p>
                    <p>If you visit our login page, we will set a temporary cookie to determine if your browser
                        accepts cookies. This cookie
                        contains no personal data and is discarded when you close your browser.</p>
                    <p>When you log in, we will also set up several cookies to save your login information and
                        your screen display choices.
                        Login cookies last for two days, and screen options cookies last for a year. If you
                        select "Remember Me", your login
                        will persist for two weeks. If you log out of your account, the login cookies will be
                        removed.</p>
                    <p>If you edit or publish an article, an additional cookie will be saved in your browser.
                        This cookie includes no personal
                        data and simply indicates the post ID of the article you just edited. It expires after 1
                        day.</p>
                    <h3 class="title">Embedded content from other websites</h3>
                    <p><b>Suggested text:</b> Articles on this site may include embedded content (e.g. videos,
                        images, articles, etc.). Embedded
                        content from other websites behaves in the exact same way as if the visitor has visited
                        the other website.</p>
                    <p>These websites may collect data about you, use cookies, embed additional third-party
                        tracking, and monitor your
                        interaction with that embedded content, including tracking your interaction with the
                        embedded content if you have an
                        account and are logged in to that website.</p>
                    <p>For users that register on our website (if any), we also store the personal information
                        they provide in their user
                        profile. All users can see, edit, or delete their personal information at any time
                        (except they cannot change their
                        username). Website administrators can also see and edit that information. browser user
                        agent string to help spam detection.</p>',
                ]);
            }
        }
    }
}
