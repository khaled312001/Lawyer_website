# الحل النهائي لمشكلة MySQL في XAMPP

## المشكلة
XAMPP Control Panel يحاول استخدام `--initialize-insecure` عند بدء MySQL، وهذا الخيار غير مدعوم في MariaDB 10.4.32.

## الحل الموصى به: تثبيت MySQL كخدمة Windows

### الخطوة 1: تثبيت MySQL كخدمة

1. **افتح PowerShell كمسؤول** (Run as Administrator)
2. **نفذ الأمر التالي:**
   ```powershell
   cd C:\xampp\mysql\bin
   .\mysqld.exe --install MySQL --defaults-file=my.ini
   ```

   أو ببساطة انقر نقراً مزدوجاً على:
   ```
   C:\xampp\install_mysql_service.bat
   ```

### الخطوة 2: بدء خدمة MySQL

```powershell
net start MySQL
```

أو من Services:
- اضغط `Win + R`
- اكتب `services.msc`
- ابحث عن "MySQL"
- اضغط "Start"

### الخطوة 3: التحقق من العمل

```powershell
netstat -ano | findstr :3306
```

إذا رأيت المنفذ 3306 يعمل، فMySQL يعمل بنجاح!

---

## الحل البديل: استخدام ملف Batch

إذا لم ترد تثبيت MySQL كخدمة، استخدم:

### ملف: `C:\xampp\start_mysql_fixed.bat`

1. انقر نقراً مزدوجاً على الملف
2. **لا تغلق النافذة السوداء** - هذه نافذة MySQL
3. لإيقاف MySQL، أغلق النافذة أو اضغط `Ctrl+C`

---

## إدارة خدمة MySQL

### بدء MySQL:
```powershell
net start MySQL
```

### إيقاف MySQL:
```powershell
net stop MySQL
```

### إلغاء تثبيت الخدمة:
```powershell
cd C:\xampp\mysql\bin
.\mysqld.exe --remove MySQL
```

أو انقر نقراً مزدوجاً على:
```
C:\xampp\uninstall_mysql_service.bat
```

---

## ملاحظات مهمة

1. **لا تستخدم XAMPP Control Panel لبدء MySQL** - استخدم Windows Services أو ملف Batch
2. **يمكنك استخدام XAMPP Control Panel لمراقبة الحالة** فقط
3. **Apache يمكن استخدامه من XAMPP Control Panel** بدون مشاكل

---

## اختبار MySQL

بعد بدء MySQL، اختبر الاتصال:

```powershell
cd C:\xampp\mysql\bin
.\mysql.exe -u root
```

إذا طلب كلمة مرور، جرب:
- كلمة مرور فارغة (اضغط Enter)
- أو `root`
- أو `1234`

---

## استكشاف الأخطاء

### إذا فشل تثبيت الخدمة:
- تأكد من تشغيل PowerShell كمسؤول
- تحقق من أن MySQL غير قيد التشغيل
- تحقق من صلاحيات المجلد `C:\xampp\mysql`

### إذا فشل بدء الخدمة:
- تحقق من سجلات الأخطاء: `C:\xampp\mysql\data\*.err`
- تحقق من أن المنفذ 3306 غير مستخدم
- جرب إعادة تشغيل الكمبيوتر

---

## الملفات المتوفرة

- `C:\xampp\install_mysql_service.bat` - تثبيت MySQL كخدمة
- `C:\xampp\uninstall_mysql_service.bat` - إلغاء تثبيت الخدمة
- `C:\xampp\start_mysql_fixed.bat` - بدء MySQL بدون خدمة



