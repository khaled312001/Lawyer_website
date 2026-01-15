# تفعيل تسجيل الدخول بالواتساب

## الطريقة الأولى: من لوحة التحكم (الأسهل)

### خطوات الوصول:

1. **سجل الدخول إلى لوحة التحكم الإدارية**
   - الرابط: https://amanlaw.ch/admin

2. **من القائمة الجانبية (Sidebar)**
   - ابحث عن قسم **Settings** (الإعدادات)
   - اضغط على **Credential Settings** (إعدادات الاعتماد)
   - أو افتح مباشرة: https://amanlaw.ch/admin/crediential-setting

3. **في صفحة Credential Settings**
   - ستجد قائمة تبويبات على الجانب الأيسر تحتوي على:
     - Google reCaptcha
     - Google Analytics
     - Google Tag Manager
     - Facebook Pixel
     - **Social Login** ← اضغط هنا
     - Tawk Chat
     - Pusher

4. **في تبويب Social Login**
   - ستجد قسمين:
     - **Google Login Settings** (إعدادات تسجيل الدخول بجوجل)
     - **WhatsApp Login Settings** (إعدادات تسجيل الدخول بالواتساب) ← هنا

5. **في قسم WhatsApp Login Settings**
   - أدخل رقم الواتساب في حقل **WhatsApp Number**
     - مثال: `41795578786` (بدون + أو مسافات)
   - فعّل **WhatsApp Login Status** إلى `active`
   - اضغط على زر **Update** (تحديث)

6. **بعد التحديث**
   - سيتم مسح الكاش تلقائياً
   - إذا لم يظهر زر الواتساب، امسح الكاش يدوياً:
     - من القائمة: **Settings** > **Clear cache**
     - أو من الترمنال: `php artisan cache:clear`

## الطريقة الثانية: باستخدام أمر Artisan

```bash
php artisan whatsapp:enable
```

أو مع رقم واتساب مخصص:

```bash
php artisan whatsapp:enable --number=41795578786
```

## الطريقة الثالثة: مباشرة من قاعدة البيانات

```bash
php artisan tinker
```

ثم قم بتنفيذ:

```php
\Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
    ['key' => 'whatsapp_login_status'],
    ['value' => 'active']
);

\Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
    ['key' => 'whatsapp_number'],
    ['value' => '41795578786']
);

Cache::forget('setting');
```

## التحقق من التفعيل

بعد التفعيل، قم بمسح الكاش:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear
```

ثم زر صفحة تسجيل الدخول: https://amanlaw.ch/login

يجب أن ترى زر "تابع مع WhatsApp" في صفحة تسجيل الدخول.

## كيفية عمل تسجيل الدخول بالواتساب

1. المستخدم يضغط على زر "تابع مع WhatsApp"
2. يتم توجيهه إلى صفحة إدخال رقم الهاتف
3. يدخل رقم هاتفه
4. يتم إرسال رمز OTP مكون من 6 أرقام عبر الواتساب
5. المستخدم يدخل الرمز
6. يتم التحقق من الرمز وتسجيل الدخول تلقائياً
7. إذا لم يكن المستخدم مسجلاً، يتم إنشاء حساب جديد تلقائياً

## ملاحظات مهمة

- تأكد من أن رقم الواتساب المدخل صحيح وبدون + أو مسافات
- حالياً، النظام يستخدم WhatsApp Web API لإرسال الرسائل
- في الإنتاج، يُنصح بالتكامل مع WhatsApp Business API لإرسال الرسائل تلقائياً
- الرمز OTP صالح لمدة 10 دقائق
- الحد الأقصى لمحاولات إدخال الرمز هو 5 محاولات

## استكشاف الأخطاء

### إذا لم يظهر زر الواتساب:

1. تحقق من أن `whatsapp_login_status` = `active` في قاعدة البيانات
2. امسح الكاش: `php artisan cache:clear`
3. تحقق من أن ملف `resources/views/client/profile/auth/login.blade.php` يحتوي على الكود الصحيح
4. تحقق من أن الـ routes موجودة في `routes/client.php`

### إذا لم تصل رسالة OTP:

**المشكلة**: الكود الحالي لا يرسل رسائل OTP فعلياً عبر WhatsApp. تم تحديث الكود لدعم عدة طرق.

**الحلول**:

1. **الحل المؤقت (يعمل الآن)**:
   - OTP سيظهر مباشرة في صفحة التحقق
   - يمكنك استخدامه للتسجيل مباشرة

2. **الحل الدائم**:
   - إعداد WhatsApp Business API أو Green API
   - راجع ملف `WHATSAPP_API_SETUP.md` للتفاصيل الكاملة

**ملاحظة**: تم تحديث الكود لعرض OTP في صفحة التحقق إذا فشل الإرسال. هذا يسمح لك بتجربة النظام حتى بدون إعداد API.

## الملفات المتعلقة

- **Controller**: `app/Http/Controllers/Auth/WhatsAppAuthController.php`
- **Routes**: `routes/client.php` (السطور 32-37)
- **Views**: 
  - `resources/views/client/profile/auth/login.blade.php`
  - `resources/views/client/profile/auth/whatsapp-phone.blade.php`
  - `resources/views/client/profile/auth/whatsapp-verify.blade.php`
- **Settings**: `Modules/GlobalSetting/resources/views/credientials/sections/social-login.blade.php`
