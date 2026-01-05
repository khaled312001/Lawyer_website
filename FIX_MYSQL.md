# إصلاح مشكلة MySQL في XAMPP

## المشكلة
```
ERROR: C:\xampp\mysql\bin\mysqld.exe: unknown option '--initialize-insecure'
ERROR: Aborting
```

## الحلول

### الحل 1: إعادة تهيئة MySQL (الأفضل)

1. **أوقف MySQL من XAMPP Control Panel**

2. **انسخ مجلد البيانات احتياطياً** (اختياري):
   ```
   C:\xampp\mysql\data
   ```
   انسخه إلى مكان آمن إذا كنت تريد حفظ البيانات

3. **احذف ملفات InnoDB المؤقتة**:
   - احذف الملفات التالية من `C:\xampp\mysql\data`:
     - `ib_logfile0`
     - `ib_logfile1`
     - `ibdata1`
     - `ibtmp1`
     - `*.err` (ملفات الأخطاء)

4. **أعد تشغيل MySQL من XAMPP Control Panel**

### الحل 2: إصلاح قاعدة البيانات يدوياً

افتح PowerShell كمسؤول (Run as Administrator) وقم بتنفيذ:

```powershell
# انتقل إلى مجلد MySQL
cd C:\xampp\mysql\bin

# أعد تهيئة MySQL
.\mysqld.exe --initialize --console

# أو إذا فشل، جرب:
.\mysqld.exe --initialize-insecure --console
```

### الحل 3: التحقق من المنفذ 3306

```powershell
# تحقق من المنفذ
netstat -ano | findstr :3306

# إذا كان مستخدماً، أوقف العملية
taskkill /PID <PROCESS_ID> /F
```

### الحل 4: إعادة تثبيت MySQL في XAMPP

1. أوقف جميع الخدمات في XAMPP
2. احذف مجلد `C:\xampp\mysql\data` (بعد النسخ الاحتياطي)
3. أعد تشغيل XAMPP

### الحل 5: استخدام MySQL كخدمة Windows

```powershell
# تثبيت MySQL كخدمة
C:\xampp\mysql\bin\mysqld.exe --install MySQL

# بدء الخدمة
net start MySQL
```

## ملاحظات مهمة

- **احتفظ بنسخة احتياطية** من مجلد `data` قبل أي عملية
- إذا كان لديك بيانات مهمة، استخدم `mysqldump` لتصديرها أولاً
- تأكد من إيقاف جميع عمليات MySQL قبل المحاولة

## بعد الإصلاح

1. تأكد من تشغيل MySQL بنجاح
2. تحقق من الاتصال:
   ```powershell
   C:\xampp\mysql\bin\mysql.exe -u root
   ```
3. إذا لزم الأمر، قم بتشغيل:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

