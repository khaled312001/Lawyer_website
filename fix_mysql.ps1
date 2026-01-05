# سكريبت إصلاح MySQL في XAMPP
# قم بتشغيل هذا السكريبت كمسؤول (Run as Administrator)

Write-Host "=== إصلاح مشكلة MySQL في XAMPP ===" -ForegroundColor Cyan
Write-Host ""

# التحقق من وجود XAMPP
if (-not (Test-Path "C:\xampp\mysql\bin\mysqld.exe")) {
    Write-Host "خطأ: لم يتم العثور على XAMPP MySQL" -ForegroundColor Red
    Write-Host "تأكد من تثبيت XAMPP في C:\xampp" -ForegroundColor Yellow
    exit 1
}

Write-Host "1. إيقاف عمليات MySQL..." -ForegroundColor Yellow
Get-Process | Where-Object {$_.ProcessName -like "*mysql*"} | Stop-Process -Force -ErrorAction SilentlyContinue
Start-Sleep -Seconds 2

Write-Host "2. التحقق من المنفذ 3306..." -ForegroundColor Yellow
$portCheck = netstat -ano | Select-String ":3306"
if ($portCheck) {
    Write-Host "   تحذير: المنفذ 3306 مستخدم" -ForegroundColor Yellow
    Write-Host "   سيتم محاولة إيقاف العملية..." -ForegroundColor Yellow
}

Write-Host "3. حذف ملفات InnoDB المؤقتة..." -ForegroundColor Yellow
$dataPath = "C:\xampp\mysql\data"
$filesToDelete = @("ib_logfile0", "ib_logfile1", "ibtmp1")

foreach ($file in $filesToDelete) {
    $filePath = Join-Path $dataPath $file
    if (Test-Path $filePath) {
        try {
            Remove-Item $filePath -Force -ErrorAction Stop
            Write-Host "   ✓ تم حذف: $file" -ForegroundColor Green
        } catch {
            Write-Host "   ✗ فشل حذف: $file - $_" -ForegroundColor Red
        }
    }
}

Write-Host ""
Write-Host "4. جاهز!" -ForegroundColor Green
Write-Host ""
Write-Host "الآن قم بـ:" -ForegroundColor Cyan
Write-Host "  1. افتح XAMPP Control Panel" -ForegroundColor White
Write-Host "  2. اضغط على 'Start' بجانب MySQL" -ForegroundColor White
Write-Host "  3. إذا استمرت المشكلة، جرب الحلول في ملف FIX_MYSQL.md" -ForegroundColor White
Write-Host ""

