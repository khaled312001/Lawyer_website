# إعادة تعيين كلمات مرور المحامين

## المشكلة
كلمات المرور في الخادم (production) مختلفة عن المتوقعة، مما يمنع تسجيل الدخول.

## الحل

### 1. رفع ملف إعادة التعيين
قم برفع ملف `reset_lawyer_password.php` إلى الخادم.

### 2. إعادة تعيين كلمة المرور لكل محامي

قم بتنفيذ الأوامر التالية في الخادم:

```bash
# محمد علي البلخي
php reset_lawyer_password.php mohammad.ali.albalkhi@amanlaw.ch MAB1997

# محمد خوالدة
php reset_lawyer_password.php mohammad.khawaldeh@amanlaw.ch MKH1967

# محمود المرشد الشالح
php reset_lawyer_password.php mahmoud.mashileh@amanlaw.ch MMS1996

# زياد الزعبي
php reset_lawyer_password.php ziad.alzoubi@amanlaw.ch ZZA1998

# محمد باسم الجلدة
php reset_lawyer_password.php mohammad.basem.aljelda@amanlaw.ch MBG2021

# غزالة الأشقر
php reset_lawyer_password.php ghazala.alashqar@amanlaw.ch GAA2009

# بشار محمد الخوالدة
php reset_lawyer_password.php bashar.mohammad.khawaldeh@amanlaw.ch BMK2023
```

### 3. أو إعادة تعيين جميع المحامين دفعة واحدة

يمكنك استخدام هذا الأمر:

```bash
php reset_lawyer_password.php mohammad.ali.albalkhi@amanlaw.ch MAB1997 && \
php reset_lawyer_password.php mohammad.khawaldeh@amanlaw.ch MKH1967 && \
php reset_lawyer_password.php mahmoud.mashileh@amanlaw.ch MMS1996 && \
php reset_lawyer_password.php ziad.alzoubi@amanlaw.ch ZZA1998 && \
php reset_lawyer_password.php mohammad.basem.aljelda@amanlaw.ch MBG2021 && \
php reset_lawyer_password.php ghazala.alashqar@amanlaw.ch GAA2009 && \
php reset_lawyer_password.php bashar.mohammad.khawaldeh@amanlaw.ch BMK2023
```

## بيانات تسجيل الدخول بعد إعادة التعيين

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

## ملاحظات

- السكربت يحدث كلمة المرور مباشرة في قاعدة البيانات
- كلمة المرور يتم تشفيرها باستخدام Bcrypt
- بعد إعادة التعيين، يجب أن يعمل تسجيل الدخول بشكل صحيح
