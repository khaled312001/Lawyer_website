# Lawyer Login Test Guide

## Test Credentials
- **URL**: https://lawyer.khaledahmed.net/login?type=lawyer
- **Email**: `daniel.martinez@law.com`
- **Password**: `1234`

## Quick Test Steps

1. **Open the login page**: https://lawyer.khaledahmed.net/login?type=lawyer

2. **Enter credentials**:
   - Email: `daniel.martinez@law.com`
   - Password: `1234`

3. **Click "تسجيل الدخول" (Login)**

4. **Expected Result**: 
   - Should redirect to lawyer dashboard
   - Should show success message: "Logged in successfully."

## Common Issues & Solutions

### Issue: "Invalid Credentials"
**Possible causes:**
- Lawyer doesn't exist in database
- Password is incorrect
- Email is incorrect

**Solution:**
- Run: `php artisan db:seed` to seed the database
- Verify the lawyer exists: Check database `lawyers` table
- Verify password hash matches: Should be `bcrypt('1234')`

### Issue: "Inactive account"
**Possible causes:**
- Lawyer status is not ACTIVE

**Solution:**
- Update lawyer status to `1` (ACTIVE) in database
- Or use admin panel to activate the lawyer

### Issue: "Please verify your email"
**Possible causes:**
- `email_verified_at` is NULL

**Solution:**
- Update `email_verified_at` to current timestamp in database
- Or use admin panel to verify the email

## Database Verification

Run the test script to verify credentials:
```bash
php test_lawyer_login.php
```

This will check:
- ✓ Lawyer exists
- ✓ Status is ACTIVE
- ✓ Email is verified
- ✓ Password is correct

## Manual Database Check

If you have database access, verify:

```sql
SELECT id, name, email, status, email_verified_at 
FROM lawyers 
WHERE email = 'daniel.martinez@law.com';
```

Expected values:
- `status` = `1` (ACTIVE)
- `email_verified_at` = NOT NULL
- `password` = Hashed version of '1234'

## Test Script Usage

```bash
# Run the test script
php test_lawyer_login.php
```

The script will:
1. Check if lawyer exists
2. Verify status is ACTIVE
3. Verify email is verified
4. Verify password matches
5. Provide summary and next steps

## Automated Test (PHPUnit)

Run the PHPUnit test:
```bash
php artisan test --filter LawyerAuthenticationTest
```

Note: This requires a fully migrated and seeded database.

## Alternative Test Lawyers

If `daniel.martinez@law.com` doesn't work, try:
- `james.anderson@law.com` (password: `1234`)
- Any other lawyer from the seeded data (all use password: `1234`)

## Login Flow

1. User submits form to `/lawyer/lawyer-login` (POST)
2. Controller validates:
   - Email format
   - Password presence
   - reCAPTCHA (if enabled)
3. Controller checks:
   - Lawyer exists
   - Status is ACTIVE
   - Email is verified
   - Password matches
4. On success:
   - Logs in lawyer using `Auth::guard('lawyer')`
   - Redirects to `/lawyer/dashboard`
5. On failure:
   - Redirects back to login with error message

## Controller Location

`app/Http/Controllers/Lawyer/Auth/AuthenticatedSessionController.php`

## Route

- **GET**: `/login?type=lawyer` - Show login form
- **POST**: `/lawyer/lawyer-login` - Process login

