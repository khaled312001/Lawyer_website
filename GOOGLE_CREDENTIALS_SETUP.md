# Google Login Credentials Setup

## طريقة إضافة بيانات Google Login

### الطريقة 1: من لوحة الإدارة (الأسهل)

1. سجّل الدخول إلى لوحة الإدارة
2. اذهب إلى: **Settings > Credentials > Social Login**
3. أدخل البيانات التالية:
   - **Google Client ID**: `YOUR_CLIENT_ID_HERE`
   - **Google Secret ID**: `YOUR_CLIENT_SECRET_HERE`
   - **Google Login Status**: قم بتفعيله (Active)
4. اضغط **Update**

### الطريقة 2: استخدام Artisan Command

```bash
php artisan google:update-credentials --client_id="YOUR_CLIENT_ID" --client_secret="YOUR_CLIENT_SECRET" --status=active
```

أو بدون options (سيطلب منك إدخالها):

```bash
php artisan google:update-credentials
```

### الطريقة 3: استخدام SQL مباشرة

قم بتشغيل هذا SQL في قاعدة البيانات:

```sql
UPDATE `settings` SET `value` = 'YOUR_CLIENT_ID_HERE' WHERE `key` = 'gmail_client_id';
UPDATE `settings` SET `value` = 'YOUR_CLIENT_SECRET_HERE' WHERE `key` = 'gmail_secret_id';
UPDATE `settings` SET `value` = 'active' WHERE `key` = 'google_login_status';
```

## مهم: إضافة Redirect URI في Google Cloud Console

1. اذهب إلى: https://console.cloud.google.com/apis/credentials
2. افتح OAuth 2.0 Client ID الخاص بك
3. في **Authorised redirect URIs** أضف:
   ```
   https://amanlaw.ch/auth/google/callback
   ```
4. احفظ التغييرات

## ملاحظات أمنية

⚠️ **لا تضع الأسرار (Client ID و Secret) في الكود المصدري!**
- استخدم لوحة الإدارة أو SQL مباشرة
- لا ترفع ملفات تحتوي على أسرار إلى Git
