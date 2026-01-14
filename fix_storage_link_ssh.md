# إصلاح رابط Storage عبر SSH

## المشكلة
الرابط الرمزي به مشكلة "Too many levels of symbolic links"

## الحل السريع

اتصل بالسيرفر عبر SSH وقم بتنفيذ:

```bash
cd /home/u790947786/domains/amanlaw.ch/public_html

# 1. إزالة الرابط/المجلد الموجود
rm -rf public/storage

# 2. التأكد من وجود المجلد الهدف
mkdir -p storage/app/public/real-estate
chmod -R 755 storage/app/public

# 3. إنشاء رابط رمزي جديد
ln -s ../storage/app/public public/storage

# 4. التحقق من الرابط
ls -la public/storage
```

يجب أن ترى:
```
lrwxrwxrwx ... storage -> ../storage/app/public
```

## التحقق من الصور

```bash
# التحقق من وجود الصور في storage
ls -la storage/app/public/real-estate/

# التحقق من أن الرابط يعمل
ls -la public/storage/real-estate/
```

## إذا استمرت المشكلة

استخدم المسار الكامل المطلق:

```bash
cd /home/u790947786/domains/amanlaw.ch/public_html
rm -rf public/storage
ln -s /home/u790947786/domains/amanlaw.ch/public_html/storage/app/public /home/u790947786/domains/amanlaw.ch/public_html/public/storage
```

## ملاحظة

الصور تم تنزيلها بنجاح في `storage/app/public/real-estate/`. 
بعد إصلاح الرابط الرمزي، ستظهر الصور تلقائياً في الموقع.
