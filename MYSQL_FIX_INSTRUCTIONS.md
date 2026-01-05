# إصلاح مشكلة MySQL في XAMPP

## المشكلة
```
ERROR: C:\xampp\mysql\bin\mysqld.exe: unknown option '--initialize-insecure'
ERROR: Aborting
```

## الحل (يجب تنفيذه كمسؤول)

### الخطوة 1: فتح PowerShell كمسؤول
1. اضغط `Win + X`
2. اختر **"Windows PowerShell (Admin)"** أو **"Terminal (Admin)"**
3. أو ابحث عن PowerShell واختر **"Run as administrator"**

### الخطوة 2: تنفيذ الأوامر التالية

```powershell
# الانتقال إلى مجلد MySQL
cd C:\xampp\mysql\bin

# إعادة تهيئة MySQL
.\mysqld.exe --initialize --console
```

**ملاحظة مهمة**: هذا الأمر سيعرض كلمة مرور مؤقتة لـ root. احفظها!

### الخطوة 3: تشغيل MySQL من XAMPP
1. افتح **XAMPP Control Panel**
2. اضغط على **"Start"** بجانب MySQL
3. يجب أن يعمل الآن بنجاح

---

## إذا استمرت المشكلة

### الحل البديل 1: حذف ملفات InnoDB وإعادة التهيئة

```powershell
# إيقاف MySQL
Get-Process | Where-Object {$_.ProcessName -like "*mysql*"} | Stop-Process -Force

# حذف ملفات InnoDB المؤقتة
Remove-Item "C:\xampp\mysql\data\ib_logfile0" -Force -ErrorAction SilentlyContinue
Remove-Item "C:\xampp\mysql\data\ib_logfile1" -Force -ErrorAction SilentlyContinue
Remove-Item "C:\xampp\mysql\data\ibtmp1" -Force -ErrorAction SilentlyContinue

# إعادة التهيئة
cd C:\xampp\mysql\bin
.\mysqld.exe --initialize --console
```

### الحل البديل 2: إعادة تثبيت MySQL في XAMPP

1. أوقف MySQL من XAMPP Control Panel
2. احذف مجلد `C:\xampp\mysql\data` (بعد النسخ الاحتياطي إذا كان لديك بيانات مهمة)
3. أعد تشغيل XAMPP Control Panel
4. اضغط Start على MySQL

---

## بعد الإصلاح

إذا قمت بإعادة التهيئة، قد تحتاج إلى:

1. **إنشاء قاعدة البيانات من جديد**:
   ```sql
   CREATE DATABASE your_database_name;
   ```

2. **استيراد البيانات** (إذا كان لديك نسخة احتياطية):
   ```bash
   mysql -u root -p < backup.sql
   ```

3. **تشغيل migrations في Laravel**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

---

## ملفات المساعدة

- `fix_mysql_complete.ps1` - سكريبت PowerShell للإصلاح التلقائي
- `FIX_MYSQL.md` - دليل شامل لحل المشكلة

---

## ملاحظات أمنية

- بعد إعادة التهيئة، MySQL سينشئ كلمة مرور مؤقتة لـ root
- يمكنك تغييرها باستخدام:
  ```sql
  ALTER USER 'root'@'localhost' IDENTIFIED BY 'your_new_password';
  FLUSH PRIVILEGES;
  ```

