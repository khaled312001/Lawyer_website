# إصلاح مشكلة الأسرار في Git

## المشكلة
GitHub يكتشف أسرار Google OAuth في الـ commits القديمة في التاريخ.

## الحل

### الطريقة 1: إزالة الأسرار من التاريخ (موصى بها)

```bash
# استخدام git filter-branch لإزالة الأسرار من التاريخ
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch app/Console/Commands/UpdateGoogleCredentials.php update_google_credentials.php GOOGLE_CREDENTIALS_SETUP.md" \
  --prune-empty --tag-name-filter cat -- --all

# Force push (احذر: هذا سيغير التاريخ!)
git push origin --force --all
```

### الطريقة 2: تعديل الـ commits المتأثرة فقط

```bash
# عرض الـ commits المتأثرة
git log --all --oneline | grep -E "71487ed7|bb9347e9"

# تعديل الـ commit الأخير إذا كان يحتوي على الأسرار
git commit --amend

# Force push
git push origin --force
```

### الطريقة 3: استخدام BFG Repo-Cleaner (الأسرع)

```bash
# تحميل BFG
# https://rtyley.github.io/bfg-repo-cleaner/

# إزالة الأسرار
java -jar bfg.jar --replace-text passwords.txt

# تنظيف
git reflog expire --expire=now --all
git gc --prune=now --aggressive
```

## بعد الإصلاح

1. تأكد من أن جميع الملفات الحالية لا تحتوي على أسرار
2. أضف الملفات الجديدة
3. اعمل commit جديد
4. اعمل push

## ملاحظات

⚠️ **تحذير**: Force push سيغير تاريخ الـ repository. تأكد من أنك الوحيد الذي يعمل على الفرع.
