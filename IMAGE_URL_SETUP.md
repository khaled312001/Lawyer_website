# إعداد مسار الصور من الخادم البعيد

## المشكلة
الصور موجودة على خادم بعيد ولا تظهر في الموقع.

## الحل
تم إضافة دالة `image_url()` التي تتحقق من وجود متغير `UPLOADS_URL` في ملف `.env` وتستخدمه لعرض الصور من الخادم البعيد.

## خطوات الإعداد

### 1. إضافة المتغير في ملف `.env`

افتح ملف `.env` في جذر المشروع وأضف السطر التالي:

```env
UPLOADS_URL=https://srv2000-files.hstgr.io/48157531f28e0d82/files/public_html/public/uploads
```

**ملاحظة مهمة:** تأكد من عدم إضافة `/` في نهاية الرابط.

### 2. مسح الكاش (Cache)

بعد إضافة المتغير، قم بمسح الكاش:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 3. كيفية استخدام الدالة

تم تحديث معظم الأماكن في المشروع لاستخدام `image_url()` بدلاً من `asset()` أو `url()`.

إذا كنت تريد استخدامها في مكان جديد، استخدم:

```php
// بدلاً من
{{ asset('uploads/lawyers/image.jpg') }}

// استخدم
{{ image_url('uploads/lawyers/image.jpg') }}
```

أو

```php
// بدلاً من
{{ url($lawyer->image) }}

// استخدم
{{ image_url($lawyer->image) }}
```

### 4. الملفات التي تم تحديثها

- `resources/views/client/index.blade.php`
- `resources/views/client/lawyer/show.blade.php`
- `resources/views/client/lawyer/index.blade.php`
- `resources/views/client/department/show.blade.php`
- `resources/views/client/book-appointment.blade.php`
- `app/Helpers/helper.php` (تم إضافة الدالة)

### 5. إذا لم تظهر الصور

1. تأكد من أن الرابط في `.env` صحيح ويمكن الوصول إليه
2. تأكد من مسح الكاش
3. تحقق من أن الصور موجودة فعلاً في المسار المحدد
4. تأكد من أن الصور لديها صلاحيات القراءة الصحيحة

## ملاحظات

- إذا لم يتم تحديد `UPLOADS_URL` في `.env`، ستعمل الدالة كـ `asset()` العادي
- إذا كان المسار يبدأ بـ `http://` أو `https://`، سيعود كما هو بدون تغيير
- الدالة تدعم الصور الافتراضية أيضاً
