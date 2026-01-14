# تعليمات تحديث رقم الهاتف الرسمي

## الرقم الجديد
**+41795578786**

## الطرق المتاحة لتحديث الرقم

### الطريقة 1: استخدام سكريبت PHP (موصى به)
```bash
php update_phone_number.php
```

هذا السكريبت سيقوم بـ:
- تحديث `top_bar_phone` في جدول `contact_infos`
- تحديث `phone` في جدول `contact_infos`
- تحديث `prescription_phone` في جدول `settings`
- مسح الكاش تلقائياً

### الطريقة 2: استخدام سكريبت SQL
قم بتشغيل ملف `update_phone_number.sql` مباشرة على قاعدة البيانات:

```bash
mysql -u username -p database_name < update_phone_number.sql
```

أو قم بتشغيل الاستعلامات التالية يدوياً:

```sql
-- تحديث جدول contact_infos
UPDATE `contact_infos` 
SET 
    `top_bar_phone` = '+41795578786',
    `phone` = '+41795578786'
WHERE 1=1;

-- تحديث جدول settings
UPDATE `settings` 
SET `value` = '+41795578786'
WHERE `key` = 'prescription_phone';
```

### الطريقة 3: التحديث من لوحة التحكم
1. اذهب إلى لوحة التحكم → إعدادات الاتصال
2. قم بتحديث:
   - **Top Bar Phone**: +41795578786
   - **Phone**: +41795578786
   - **Prescription Phone**: +41795578786

## الأماكن التي سيظهر فيها الرقم

بعد التحديث، سيظهر الرقم الجديد في:
- ✅ الهيدر (Top Bar)
- ✅ الفوتر (Footer)
- ✅ صفحة اتصل بنا
- ✅ الوصفات الطبية (Prescriptions)
- ✅ زر WhatsApp العائم
- ✅ جميع صفحات الاتصال

## ملاحظات مهمة

1. **الكاش**: بعد التحديث، تأكد من مسح الكاش:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

2. **التحقق**: بعد التحديث، قم بزيارة الموقع وتحقق من ظهور الرقم الجديد في جميع الأماكن.

3. **WhatsApp**: الرقم سيستخدم تلقائياً في زر WhatsApp العائم.

## الملفات المتأثرة

- `contact_infos` table: `top_bar_phone`, `phone`
- `settings` table: `prescription_phone`
- Views تستخدم: `$contactInfo->top_bar_phone`, `$contactInfo->phone`, `$setting->prescription_phone`
