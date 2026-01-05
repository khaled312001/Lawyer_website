# سكريبت إصلاح MySQL في XAMPP - حل شامل
# قم بتشغيل هذا السكريبت كمسؤول (Run as Administrator)

Write-Host "=== إصلاح مشكلة MySQL في XAMPP ===" -ForegroundColor Cyan
Write-Host ""

# 1. إيقاف جميع عمليات MySQL
Write-Host "[1/5] إيقاف عمليات MySQL..." -ForegroundColor Yellow
Get-Process | Where-Object {$_.ProcessName -like "*mysql*"} | Stop-Process -Force -ErrorAction SilentlyContinue
Start-Sleep -Seconds 3
Write-Host "   ✓ تم الإيقاف" -ForegroundColor Green

# 2. التحقق من المنفذ 3306
Write-Host "[2/5] التحقق من المنفذ 3306..." -ForegroundColor Yellow
$port3306 = netstat -ano | Select-String ":3306.*LISTENING"
if ($port3306) {
    $pid = ($port3306.ToString() -split '\s+')[-1]
    if ($pid -match '^\d+$') {
        Stop-Process -Id [int]$pid -Force -ErrorAction SilentlyContinue
        Write-Host "   ✓ تم إيقاف العملية على المنفذ 3306" -ForegroundColor Green
    }
} else {
    Write-Host "   ✓ المنفذ 3306 غير مستخدم" -ForegroundColor Green
}

# 3. نسخ احتياطي
Write-Host "[3/5] إنشاء نسخة احتياطية..." -ForegroundColor Yellow
$dataPath = "C:\xampp\mysql\data"
$backupPath = "C:\xampp\mysql\data_backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"

if (Test-Path $dataPath) {
    if (-not (Test-Path $backupPath)) {
        New-Item -ItemType Directory -Path $backupPath -Force | Out-Null
    }
    $filesToBackup = @("ib_logfile0", "ib_logfile1", "ibdata1")
    foreach ($file in $filesToBackup) {
        $source = Join-Path $dataPath $file
        if (Test-Path $source) {
            Copy-Item $source $backupPath -Force -ErrorAction SilentlyContinue
        }
    }
    Write-Host "   ✓ تم النسخ الاحتياطي إلى: $backupPath" -ForegroundColor Green
}

# 4. حذف ملفات InnoDB المؤقتة
Write-Host "[4/5] حذف ملفات InnoDB المؤقتة..." -ForegroundColor Yellow
$filesToDelete = @("ib_logfile0", "ib_logfile1", "ibtmp1")
foreach ($file in $filesToDelete) {
    $filePath = Join-Path $dataPath $file
    if (Test-Path $filePath) {
        Remove-Item $filePath -Force -ErrorAction SilentlyContinue
        Write-Host "   ✓ تم حذف: $file" -ForegroundColor Green
    }
}

# 5. محاولة إعادة تهيئة MySQL
Write-Host "[5/5] إعادة تهيئة MySQL..." -ForegroundColor Yellow
cd C:\xampp\mysql\bin

# محاولة التهيئة العادية
$initResult = & .\mysqld.exe --initialize --console 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "   ✓ تمت التهيئة بنجاح" -ForegroundColor Green
} else {
    Write-Host "   ⚠ فشلت التهيئة التلقائية" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "=== الحل اليدوي ===" -ForegroundColor Cyan
    Write-Host "1. افتح PowerShell كمسؤول (Run as Administrator)" -ForegroundColor White
    Write-Host "2. نفذ الأوامر التالية:" -ForegroundColor White
    Write-Host "   cd C:\xampp\mysql\bin" -ForegroundColor Yellow
    Write-Host "   .\mysqld.exe --initialize --console" -ForegroundColor Yellow
    Write-Host "3. بعد التهيئة، افتح XAMPP Control Panel" -ForegroundColor White
    Write-Host "4. اضغط على 'Start' بجانب MySQL" -ForegroundColor White
}

Write-Host ""
Write-Host "=== ملاحظات ===" -ForegroundColor Cyan
Write-Host "- تم حفظ نسخة احتياطية في: $backupPath" -ForegroundColor White
Write-Host "- إذا كان لديك بيانات مهمة، استخدم mysqldump لتصديرها أولاً" -ForegroundColor Yellow
Write-Host "- بعد إعادة التهيئة، قد تحتاج إلى إنشاء قاعدة البيانات من جديد" -ForegroundColor Yellow
Write-Host ""

