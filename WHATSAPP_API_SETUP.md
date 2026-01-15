# إعداد WhatsApp API لإرسال رسائل OTP

## المشكلة الحالية

الكود الحالي لا يرسل رسائل OTP فعلياً عبر WhatsApp. تم تحديث الكود لدعم عدة طرق لإرسال الرسائل.

## الحلول المتاحة

### الحل 1: WhatsApp Business API (الأفضل للإنتاج)

WhatsApp Business API هو الحل الرسمي من Meta لإرسال الرسائل برمجياً.

#### المتطلبات:
1. حساب WhatsApp Business
2. رقم هاتف WhatsApp Business
3. API credentials من Meta

#### خطوات الإعداد:

1. **سجل في Meta Business**
   - اذهب إلى: https://business.facebook.com
   - أنشئ حساب Business

2. **أنشئ تطبيق WhatsApp Business**
   - اذهب إلى: https://developers.facebook.com/apps/
   - أنشئ تطبيق جديد
   - أضف منتج "WhatsApp"

3. **احصل على API Credentials**
   - من لوحة التحكم في Meta Developers
   - احصل على:
     - API Key
     - API Secret
     - API URL (Endpoint)

4. **أضف الإعدادات في لوحة التحكم**
   - اذهب إلى: **Settings** > **Credential Settings** > **Social Login**
   - أضف حقول جديدة:
     - `whatsapp_api_key`
     - `whatsapp_api_secret`
     - `whatsapp_api_url`

### الحل 2: Green API (مجاني للاختبار)

Green API هي خدمة مجانية تسمح بإرسال رسائل WhatsApp.

#### خطوات الإعداد:

1. **سجل في Green API**
   - اذهب إلى: https://green-api.com
   - أنشئ حساب مجاني

2. **احصل على Credentials**
   - من لوحة التحكم
   - احصل على:
     - `idInstance` (Instance ID)
     - `apiTokenInstance` (API Token)

3. **أضف الإعدادات في قاعدة البيانات**
   ```php
   \Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
       ['key' => 'whatsapp_green_api_id'],
       ['value' => 'YOUR_INSTANCE_ID']
   );
   
   \Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
       ['key' => 'whatsapp_green_api_token'],
       ['value' => 'YOUR_API_TOKEN']
   );
   ```

### الحل 3: إظهار OTP في الصفحة (مؤقت للتطوير)

إذا لم تكن تريد إعداد API الآن، الكود الحالي يعرض OTP مباشرة في صفحة التحقق.

## إضافة حقول الإعدادات في لوحة التحكم

لإضافة حقول API في لوحة التحكم:

1. افتح: `Modules/GlobalSetting/resources/views/credientials/sections/social-login.blade.php`

2. أضف بعد قسم WhatsApp Login Settings:

```blade
<!-- WhatsApp API Settings -->
<h6 class="mb-3 mt-4">{{ __('WhatsApp API Settings (Optional)') }}</h6>
<div class="form-group">
    <x-admin.form-input id="whatsapp_api_key" name="whatsapp_api_key" 
        label="{{ __('WhatsApp API Key') }}" 
        value="{{ $setting->whatsapp_api_key ?? '' }}"
        placeholder="For WhatsApp Business API"/>
    <small class="form-text text-muted">{{ __('Required for WhatsApp Business API') }}</small>
</div>
<div class="form-group">
    <x-admin.form-input id="whatsapp_api_secret" name="whatsapp_api_secret" 
        label="{{ __('WhatsApp API Secret') }}" 
        value="{{ $setting->whatsapp_api_secret ?? '' }}"
        placeholder="For WhatsApp Business API"/>
</div>
<div class="form-group">
    <x-admin.form-input id="whatsapp_api_url" name="whatsapp_api_url" 
        label="{{ __('WhatsApp API URL') }}" 
        value="{{ $setting->whatsapp_api_url ?? '' }}"
        placeholder="https://graph.facebook.com/v18.0/YOUR_PHONE_ID/messages"/>
</div>

<hr class="my-4">

<!-- Green API Settings (Alternative) -->
<h6 class="mb-3">{{ __('Green API Settings (Alternative)') }}</h6>
<div class="form-group">
    <x-admin.form-input id="whatsapp_green_api_id" name="whatsapp_green_api_id" 
        label="{{ __('Green API Instance ID') }}" 
        value="{{ $setting->whatsapp_green_api_id ?? '' }}"
        placeholder="For Green API"/>
</div>
<div class="form-group">
    <x-admin.form-input id="whatsapp_green_api_token" name="whatsapp_green_api_token" 
        label="{{ __('Green API Token') }}" 
        value="{{ $setting->whatsapp_green_api_token ?? '' }}"
        placeholder="For Green API"/>
</div>
```

3. حدث Controller لحفظ هذه الإعدادات:

في `Modules/GlobalSetting/app/Http/Controllers/GlobalSettingController.php`:

```php
// في دالة update_social_login، أضف:
if ($request->has('whatsapp_api_key')) {
    Setting::updateOrCreate(
        ['key' => 'whatsapp_api_key'],
        ['value' => $request->whatsapp_api_key]
    );
}
if ($request->has('whatsapp_api_secret')) {
    Setting::updateOrCreate(
        ['key' => 'whatsapp_api_secret'],
        ['value' => $request->whatsapp_api_secret]
    );
}
if ($request->has('whatsapp_api_url')) {
    Setting::updateOrCreate(
        ['key' => 'whatsapp_api_url'],
        ['value' => $request->whatsapp_api_url]
    );
}
if ($request->has('whatsapp_green_api_id')) {
    Setting::updateOrCreate(
        ['key' => 'whatsapp_green_api_id'],
        ['value' => $request->whatsapp_green_api_id]
    );
}
if ($request->has('whatsapp_green_api_token')) {
    Setting::updateOrCreate(
        ['key' => 'whatsapp_green_api_token'],
        ['value' => $request->whatsapp_green_api_token]
    );
}
```

## الحل المؤقت الحالي

حالياً، الكود يعرض OTP مباشرة في صفحة التحقق إذا فشل الإرسال. هذا مفيد للتطوير والاختبار.

## ملاحظات مهمة

1. **WhatsApp Business API** يتطلب موافقة من Meta وقد يستغرق وقتاً
2. **Green API** مجاني للاختبار لكن محدود
3. **الحل المؤقت** يعرض OTP في الصفحة - مناسب للتطوير فقط
4. تأكد من تنسيق رقم الهاتف بشكل صحيح (مع رمز الدولة)

## اختبار الإرسال

بعد إعداد API:

1. اذهب إلى صفحة تسجيل الدخول
2. اضغط على "تابع مع WhatsApp"
3. أدخل رقم هاتفك
4. تحقق من استلام الرسالة في WhatsApp
5. إذا لم تصل الرسالة، تحقق من الـ logs في `storage/logs/laravel.log`

## استكشاف الأخطاء

- تحقق من الـ logs: `storage/logs/laravel.log`
- تأكد من صحة API credentials
- تأكد من تنسيق رقم الهاتف (مع رمز الدولة)
- تحقق من أن رقم WhatsApp Business مفعّل
