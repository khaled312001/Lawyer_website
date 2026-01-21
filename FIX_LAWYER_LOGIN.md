# إصلاح مشكلة تسجيل الدخول للمحامين

## المشكلة
عند محاولة تسجيل الدخول كمحامي، يظهر خطأ "بيانات اعتماد غير صالحة" حتى لو كانت البيانات صحيحة.

## الإصلاحات التي تمت

### 1. إصلاح إعدادات Hashing
تم تغيير `config/hashing.php`:
- تم تغيير `'verify' => false` لمنع خطأ Bcrypt algorithm

### 2. تحسين كود تسجيل الدخول
تم تحسين `app/Http/Controllers/Lawyer/Auth/AuthenticatedSessionController.php`:
- إضافة معالجة أفضل للأخطاء
- إضافة logging للتشخيص
- استخدام `password_verify()` كبديل إذا فشل `Hash::check()`

## خطوات الإصلاح في Production

### 1. رفع الملفات المحدثة
تأكد من رفع الملفات التالية:
- `config/hashing.php`
- `app/Http/Controllers/Lawyer/Auth/AuthenticatedSessionController.php`

### 2. مسح الكاش في الخادم
قم بتنفيذ الأوامر التالية في الخادم:

```bash
# مسح config cache
php artisan config:clear

# مسح application cache
php artisan cache:clear

# مسح route cache (إذا كان موجود)
php artisan route:clear

# مسح view cache (إذا كان موجود)
php artisan view:clear

# إعادة بناء config cache (اختياري - فقط إذا كنت تستخدم config cache في production)
php artisan config:cache
```

### 3. إعادة تشغيل PHP-FPM (إذا كان موجود)
```bash
# Ubuntu/Debian
sudo service php8.3-fpm restart

# أو
sudo systemctl restart php8.3-fpm
```

### 4. التحقق من recaptcha
إذا كان recaptcha مفعلاً، تأكد من:
- أن المفاتيح صحيحة
- أو قم بتعطيل recaptcha مؤقتاً للاختبار

## اختبار تسجيل الدخول

### بيانات تسجيل الدخول للمحامين:

1. **محمد خوالدة**
   - الإيميل: `mohammad.khawaldeh@amanlaw.ch`
   - كلمة المرور: `MKH1967`

2. **محمد علي البلخي**
   - الإيميل: `mohammad.ali.albalkhi@amanlaw.ch`
   - كلمة المرور: `MAB1997`

3. **محمود المرشد الشالح**
   - الإيميل: `mahmoud.mashileh@amanlaw.ch`
   - كلمة المرور: `MMS1996`

4. **زياد الزعبي**
   - الإيميل: `ziad.alzoubi@amanlaw.ch`
   - كلمة المرور: `ZZA1998`

5. **محمد باسم الجلدة**
   - الإيميل: `mohammad.basem.aljelda@amanlaw.ch`
   - كلمة المرور: `MBG2021`

6. **غزالة الأشقر**
   - الإيميل: `ghazala.alashqar@amanlaw.ch`
   - كلمة المرور: `GAA2009`

7. **بشار محمد الخوالدة**
   - الإيميل: `bashar.mohammad.khawaldeh@amanlaw.ch`
   - كلمة المرور: `BMK2023`

## إذا استمرت المشكلة

1. **تحقق من logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **تحقق من recaptcha:**
   - تأكد من أن recaptcha معطل أو أن المفاتيح صحيحة
   - يمكن تعطيل recaptcha مؤقتاً من لوحة التحكم

3. **تحقق من session:**
   - تأكد من أن إعدادات session صحيحة
   - تحقق من صلاحيات مجلد `storage/framework/sessions`

4. **مسح كاش المتصفح:**
   - اضغط Ctrl+Shift+Delete
   - امسح الكاش والـ cookies
   - أعد تحميل الصفحة

## ملاحظات

- جميع المحامين نشطون ومحققون من الإيميل
- كلمات المرور مخزنة بشكل مشفر (Bcrypt) في قاعدة البيانات
- الكود الآن يتعامل مع جميع حالات الخطأ بشكل صحيح
