# تفعيل تسجيل الدخول بالواتساب

## الطريقة الأولى: من لوحة التحكم (الأسهل)

1. سجل الدخول إلى لوحة التحكم الإدارية
2. اذهب إلى **الإعدادات** > **إعدادات تسجيل الدخول الاجتماعي**
3. في قسم **إعدادات تسجيل الدخول بالواتساب**:
   - أدخل رقم الواتساب (مثال: `41795578786` بدون + أو مسافات)
   - فعّل **حالة تسجيل الدخول بالواتساب** إلى `active`
4. اضغط على **تحديث**

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

إذا لم يظهر زر الواتساب:

1. تحقق من أن `whatsapp_login_status` = `active` في قاعدة البيانات
2. امسح الكاش: `php artisan cache:clear`
3. تحقق من أن ملف `resources/views/client/profile/auth/login.blade.php` يحتوي على الكود الصحيح
4. تحقق من أن الـ routes موجودة في `routes/client.php`

## الملفات المتعلقة

- **Controller**: `app/Http/Controllers/Auth/WhatsAppAuthController.php`
- **Routes**: `routes/client.php` (السطور 32-37)
- **Views**: 
  - `resources/views/client/profile/auth/login.blade.php`
  - `resources/views/client/profile/auth/whatsapp-phone.blade.php`
  - `resources/views/client/profile/auth/whatsapp-verify.blade.php`
- **Settings**: `Modules/GlobalSetting/resources/views/credientials/sections/social-login.blade.php`
