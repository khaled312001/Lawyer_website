# Fix Google OAuth "invalid_client" Error - Quick Guide

## Problem
You're getting `Error 401: invalid_client` because the application is using placeholder values (`google_client_id`) instead of your actual Google OAuth credentials.

## ⚠️ Security Note
**Never commit your actual Google OAuth credentials to Git!** This file uses placeholders. Keep your real credentials secure and only use them locally or in your production environment.

## Your Credentials
⚠️ **IMPORTANT**: Replace the placeholders below with your actual Google OAuth credentials from Google Cloud Console.

- **Client ID**: `YOUR_GOOGLE_CLIENT_ID_HERE`
- **Client Secret**: `YOUR_GOOGLE_CLIENT_SECRET_HERE`

## Solution Options

### Option 1: Update via Admin Panel (Easiest - Recommended)

1. **Login to Admin Panel**
   - Go to: `http://127.0.0.1:8000/admin/login`
   - Email: `admin@gmail.com`
   - Password: `1234`

2. **Navigate to Settings**
   - Go to: **Settings** → **Credentials** → **Social Login** tab

3. **Update Google Credentials**
   - **Google Client ID**: `YOUR_GOOGLE_CLIENT_ID_HERE` (replace with your actual Client ID)
   - **Google Secret ID**: `YOUR_GOOGLE_CLIENT_SECRET_HERE` (replace with your actual Client Secret)
   - **Google Login Status**: Set to **Active** (toggle ON)

4. **Click "Update"**

5. **Clear Cache** (run in terminal):
   ```powershell
   cd f:\Law
   php artisan cache:clear
   php artisan config:clear
   ```

### Option 2: Update via SQL (If Admin Panel Not Accessible)

1. **Open phpMyAdmin or MySQL Command Line**

2. **Select your database** (usually `law`)

3. **Run the SQL script** (`update_google_oauth.sql`) or execute these commands:

```sql
-- Update Google Client ID (replace YOUR_GOOGLE_CLIENT_ID_HERE with your actual Client ID)
UPDATE `settings` SET `value` = 'YOUR_GOOGLE_CLIENT_ID_HERE' WHERE `key` = 'gmail_client_id';

-- Update Google Client Secret (replace YOUR_GOOGLE_CLIENT_SECRET_HERE with your actual Client Secret)
UPDATE `settings` SET `value` = 'YOUR_GOOGLE_CLIENT_SECRET_HERE' WHERE `key` = 'gmail_secret_id';

-- Activate Google Login
UPDATE `settings` SET `value` = 'active' WHERE `key` = 'google_login_status';

-- If records don't exist, insert them (replace placeholders with your actual credentials)
INSERT INTO `settings` (`key`, `value`) VALUES ('gmail_client_id', 'YOUR_GOOGLE_CLIENT_ID_HERE')
ON DUPLICATE KEY UPDATE `value` = 'YOUR_GOOGLE_CLIENT_ID_HERE';

INSERT INTO `settings` (`key`, `value`) VALUES ('gmail_secret_id', 'YOUR_GOOGLE_CLIENT_SECRET_HERE')
ON DUPLICATE KEY UPDATE `value` = 'YOUR_GOOGLE_CLIENT_SECRET_HERE';

INSERT INTO `settings` (`key`, `value`) VALUES ('google_login_status', 'active')
ON DUPLICATE KEY UPDATE `value` = 'active';
```

4. **Clear Cache** (run in terminal):
   ```powershell
   cd f:\Law
   php artisan cache:clear
   php artisan config:clear
   ```

### Option 3: Update via Artisan Command (If Database Connection Works)

```powershell
cd f:\Law
php artisan google:update-credentials --client_id="YOUR_GOOGLE_CLIENT_ID_HERE" --client_secret="YOUR_GOOGLE_CLIENT_SECRET_HERE" --status=active
```

**⚠️ IMPORTANT**: Replace `YOUR_GOOGLE_CLIENT_ID_HERE` and `YOUR_GOOGLE_CLIENT_SECRET_HERE` with your actual credentials from Google Cloud Console.

## ⚠️ IMPORTANT: Configure Redirect URI in Google Cloud Console

After updating the credentials, you **MUST** configure the redirect URI in Google Cloud Console:

1. **Go to Google Cloud Console**
   - Visit: https://console.cloud.google.com/apis/credentials
   - Select your project

2. **Edit your OAuth 2.0 Client ID**
   - Click on your Client ID (it should look like: `xxxxx-xxxxx.apps.googleusercontent.com`)

3. **Add Authorized Redirect URIs**
   - Click **+ ADD URI**
   - Add these URIs (replace with your actual domain):
     ```
     http://127.0.0.1:8000/auth/google/callback
     http://localhost:8000/auth/google/callback
     https://yourdomain.com/auth/google/callback
     ```
   - **Important**: Replace `yourdomain.com` with your actual production domain

4. **Click SAVE**

## Verify the Fix

1. **Check Configuration** (optional):
   ```powershell
   cd f:\Law
   php diagnose_google_oauth.php
   ```

2. **Test Google Login**
   - Go to your login page
   - Click "Sign in with Google"
   - You should be redirected to Google's consent screen (not the error page)

## Common Issues

### Issue: Still Getting "invalid_client" Error
**Solution**: 
- Wait 5-10 minutes after updating (Google caches settings)
- Double-check the Client ID matches exactly (no extra spaces)
- Verify the redirect URI is added in Google Cloud Console
- Make sure Google Login Status is set to "active"

### Issue: Redirect URI Mismatch
**Solution**:
- The redirect URI in Google Cloud Console **must exactly match** your app's callback URL
- Check for trailing slashes, http vs https, port numbers
- Your callback URL is: `{YOUR_DOMAIN}/auth/google/callback`

### Issue: Database Connection Error
**Solution**:
- Make sure MySQL/XAMPP is running
- Check your `.env` file database settings
- Use Option 1 (Admin Panel) or Option 2 (SQL) instead

## Next Steps

1. ✅ Update credentials using one of the options above
2. ✅ Configure redirect URI in Google Cloud Console
3. ✅ Clear cache
4. ✅ Test Google login
5. ✅ Verify it works!

---

**Need Help?** Check `FIX_GOOGLE_OAUTH_ERROR.md` for more detailed troubleshooting.
