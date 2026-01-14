# حل مشكلة Storage Link

## المشكلة
دالة `symlink()` معطلة على السيرفر، مما يمنع إنشاء رابط رمزي تلقائياً.

## الحلول المتاحة

### الحل 1: استخدام الأمر المخصص (موصى به)

```bash
php artisan storage:link-custom
```

هذا الأمر سيحاول:
1. استخدام PHP symlink() إذا كان متاحاً
2. استخدام أمر shell `ln -s` إذا فشل الأول
3. إعطاء تعليمات يدوية إذا فشل كلاهما

### الحل 2: استخدام السكريبت اليدوي

```bash
php create_storage_link_manual.php
```

هذا السكريبت سيحاول جميع الطرق المتاحة.

### الحل 3: إنشاء الرابط يدوياً عبر SSH

اتصل بالسيرفر عبر SSH وقم بتنفيذ:

```bash
cd /home/u790947786/domains/amanlaw.ch/public_html
ln -s storage/app/public public/storage
```

أو باستخدام المسار الكامل:

```bash
ln -s /home/u790947786/domains/amanlaw.ch/public_html/storage/app/public /home/u790947786/domains/amanlaw.ch/public_html/public/storage
```

### الحل 4: إنشاء مجلد مباشرة (بديل)

إذا لم تستطع إنشاء رابط رمزي، يمكنك:

1. إنشاء مجلد مباشرة:
```bash
mkdir -p public/storage
chmod 755 public/storage
```

2. نسخ الملفات من storage إلى public/storage:
```bash
cp -r storage/app/public/* public/storage/
```

3. تحديث مسارات الصور في الكود لاستخدام `public/storage` مباشرة.

## التحقق من النجاح

بعد إنشاء الرابط، تحقق من:

```bash
ls -la public/storage
```

يجب أن ترى:
```
lrwxrwxrwx ... storage -> /path/to/storage/app/public
```

## ملاحظات مهمة

1. **الأذونات**: تأكد من أن المجلدات لها أذونات صحيحة:
   ```bash
   chmod -R 755 storage/app/public
   chmod -R 755 public/storage
   ```

2. **الملكية**: تأكد من أن الملفات مملوكة للمستخدم الصحيح:
   ```bash
   chown -R u790947786:u790947786 storage/app/public
   ```

3. **التحقق**: بعد إنشاء الرابط، تحقق من أن الصور تظهر:
   ```bash
   ls -la public/storage/real-estate/
   ```

## إذا استمرت المشكلة

اتصل بمزود الاستضافة واطلب منهم:
1. تفعيل دالة `symlink()` في PHP
2. أو السماح بتنفيذ أوامر shell من PHP
3. أو إنشاء الرابط الرمزي يدوياً من جانبهم
