# أوامر السيرفر لإصلاح مشكلة أزرار Google و WhatsApp

قم بتشغيل هذه الأوامر على السيرفر في ترمنال السيرفر:

## الأوامر الأساسية:

```bash
# 1. امسح الكاش
php artisan cache:clear

# 2. امسح كاش الإعدادات
php artisan config:clear

# 3. امسح كاش الـ Views
php artisan view:clear

# 4. امسح كاش الـ Routes
php artisan route:clear

# 5. امسح كل الكاش
php artisan optimize:clear

# 6. امسح كاش الإعدادات مباشرة
php artisan tinker --execute="Cache::forget('setting');"
```

## للتحقق من الإعدادات في قاعدة البيانات:

```bash
php artisan tinker --execute="
\$google = \Modules\GlobalSetting\app\Models\Setting::where('key', 'google_login_status')->first();
\$whatsapp = \Modules\GlobalSetting\app\Models\Setting::where('key', 'whatsapp_login_status')->first();
echo 'Google: ' . (\$google ? \$google->value : 'NOT FOUND') . PHP_EOL;
echo 'WhatsApp: ' . (\$whatsapp ? \$whatsapp->value : 'NOT FOUND') . PHP_EOL;
"
```

## إذا كانت القيم غير 'active'، قم بتحديثها:

```bash
php artisan tinker --execute="
\Modules\GlobalSetting\app\Models\Setting::where('key', 'google_login_status')->update(['value' => 'active']);
\Modules\GlobalSetting\app\Models\Setting::where('key', 'whatsapp_login_status')->update(['value' => 'active']);
Cache::forget('setting');
echo 'Settings updated and cache cleared!' . PHP_EOL;
"
```

## إذا كان whatsapp_login_status غير موجود (NOT FOUND)، قم بإنشائه:

```bash
php artisan tinker --execute="
\Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
    ['key' => 'whatsapp_login_status'],
    ['value' => 'active']
);
\Modules\GlobalSetting\app\Models\Setting::updateOrCreate(
    ['key' => 'whatsapp_number'],
    ['value' => '963912345678']
);
Cache::forget('setting');
echo 'WhatsApp settings created and cache cleared!' . PHP_EOL;
"
```

## ملاحظة:
بعد تنفيذ الأوامر، قم بتحديث الصفحة في المتصفح (Ctrl+F5) للتحقق من ظهور الأزرار.

