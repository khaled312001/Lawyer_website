# Fix Google OAuth "OAuth client was not found" Error

## Error Details
- **Error**: Access blocked: Authorization Error
- **Error Code**: 401: invalid_client
- **Message**: The OAuth client was not found

## What This Error Means

The error "Error 401: invalid_client" occurs when:
1. ❌ The Google Client ID doesn't exist in Google Cloud Console
2. ❌ The Client ID was deleted or disabled
3. ❌ The redirect URI is not properly configured in Google Cloud Console
4. ❌ The Client ID in your database doesn't match any OAuth client in Google Cloud Console

## Step-by-Step Fix

### Step 1: Verify Your Google OAuth Client Exists

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Select your project (or create a new one)
3. Navigate to **APIs & Services** > **Credentials**
4. Look for **OAuth 2.0 Client IDs** section
5. **Verify** that your Client ID exists and is **enabled**

   ⚠️ **If the Client ID doesn't exist**, you need to create one:
   - Click **+ CREATE CREDENTIALS** > **OAuth client ID**
   - Application type: **Web application**
   - Name: Your application name
   - **Authorized redirect URIs**: Add the URI from Step 2 below
   - Click **CREATE**
   - **Copy** the Client ID and Client Secret

### Step 2: Get Your Redirect URI

Your application's redirect URI should be:
```
https://yourdomain.com/auth/google/callback
```

For local development:
```
http://127.0.0.1:8000/auth/google/callback
```

Or check your `APP_URL` in `.env` file:
```
APP_URL=https://yourdomain.com
```

The redirect URI will be: `{APP_URL}/auth/google/callback`

### Step 3: Configure Redirect URI in Google Cloud Console

1. Go to [Google Cloud Console Credentials](https://console.cloud.google.com/apis/credentials)
2. Click on your **OAuth 2.0 Client ID**
3. Scroll to **Authorized redirect URIs**
4. Click **+ ADD URI**
5. Add **ALL** possible redirect URIs:
   ```
   https://yourdomain.com/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback  (for local)
   http://localhost:8000/auth/google/callback   (for local)
   ```
6. Click **SAVE**

### Step 4: Update Credentials in Your Application

You have **3 options** to update the credentials:

#### Option A: Using Admin Panel (Recommended)
1. Login to your admin panel
2. Navigate to: **Settings** > **Credentials** > **Social Login**
3. Enter:
   - **Google Client ID**: Your Client ID from Google Cloud Console
   - **Google Secret ID**: Your Client Secret from Google Cloud Console
   - **Google Login Status**: Set to **Active**
4. Click **Update**

#### Option B: Using Artisan Command
```bash
php artisan google:update-credentials --client_id="YOUR_CLIENT_ID" --client_secret="YOUR_CLIENT_SECRET" --status=active
```

#### Option C: Using SQL Directly
```sql
UPDATE `settings` SET `value` = 'YOUR_CLIENT_ID_HERE' WHERE `key` = 'gmail_client_id';
UPDATE `settings` SET `value` = 'YOUR_CLIENT_SECRET_HERE' WHERE `key` = 'gmail_secret_id';
UPDATE `settings` SET `value` = 'active' WHERE `key` = 'google_login_status';
```

### Step 5: Clear Cache

After updating credentials, clear the cache:
```bash
php artisan cache:clear
php artisan config:clear
```

### Step 6: Verify Configuration

Run the diagnostic script:
```bash
php diagnose_google_oauth.php
```

This will show you:
- Current Google Login Status
- Current Client ID (first 20 characters)
- Current Client Secret status
- Redirect URI that should be configured

### Step 7: Test Again

1. Go to your login page
2. Click **"Sign in with Google"**
3. You should be redirected to Google's consent screen
4. After authorization, you'll be redirected back to your application

## Common Issues and Solutions

### Issue 1: Client ID Not Found
**Solution**: 
- Verify the Client ID exists in Google Cloud Console
- Make sure you're using the correct project
- Check that the Client ID hasn't been deleted

### Issue 2: Redirect URI Mismatch
**Solution**:
- The redirect URI in Google Cloud Console **must exactly match** the one your app uses
- Check for trailing slashes, http vs https, port numbers
- Add all possible variations (local, staging, production)

### Issue 3: OAuth Consent Screen Not Configured
**Solution**:
1. Go to **APIs & Services** > **OAuth consent screen**
2. Fill in required information:
   - User support email
   - Application name
   - Authorized domains
3. Add test users if in testing mode
4. Submit for verification if needed

### Issue 4: API Not Enabled
**Solution**:
1. Go to **APIs & Services** > **Library**
2. Search for **Google+ API** or **Google Identity**
3. Make sure it's **enabled** for your project

## Security Notes

⚠️ **Important**:
- Never commit Client ID and Secret to Git
- Keep your Client Secret secure
- Use environment-specific credentials (dev/staging/production)
- Regularly rotate your secrets

## Still Having Issues?

If you're still experiencing the error:

1. **Double-check** the Client ID matches exactly (no extra spaces)
2. **Verify** the redirect URI is added in Google Cloud Console
3. **Check** that OAuth consent screen is configured
4. **Ensure** the Google+ API is enabled
5. **Wait** a few minutes after making changes (Google caches settings)

## Additional Resources

- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Google Cloud Console](https://console.cloud.google.com/)
