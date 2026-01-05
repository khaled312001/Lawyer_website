# phpMyAdmin MySQL Connection Fix Script
# Fixes "MySQL server has gone away" and connection errors
# Run this script as Administrator (Right-click > Run as Administrator)

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  phpMyAdmin Connection Fix" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
if (-not $isAdmin) {
    Write-Host "ERROR: This script must be run as Administrator!" -ForegroundColor Red
    Write-Host "Right-click PowerShell and select 'Run as Administrator'" -ForegroundColor Yellow
    pause
    exit 1
}

$xamppPath = "C:\xampp"
$mysqlPath = "$xamppPath\mysql"
$mysqlBinPath = "$mysqlPath\bin"
$mysqlDataPath = "$mysqlPath\data"

# Check if XAMPP exists
if (-not (Test-Path $xamppPath)) {
    Write-Host "ERROR: XAMPP not found at C:\xampp" -ForegroundColor Red
    Write-Host "Please install XAMPP or update the path in this script" -ForegroundColor Yellow
    pause
    exit 1
}

Write-Host "[Step 1/6] Checking MySQL processes..." -ForegroundColor Yellow
$mysqlProcesses = Get-Process | Where-Object {$_.ProcessName -like "*mysql*" -or $_.ProcessName -like "*mysqld*"}
if ($mysqlProcesses) {
    Write-Host "   Found MySQL processes:" -ForegroundColor Cyan
    foreach ($proc in $mysqlProcesses) {
        Write-Host "   - $($proc.ProcessName) (PID: $($proc.Id))" -ForegroundColor Gray
    }
    Write-Host "   Stopping all MySQL processes..." -ForegroundColor Yellow
    foreach ($proc in $mysqlProcesses) {
        try {
            Stop-Process -Id $proc.Id -Force -ErrorAction Stop
            Write-Host "   ✓ Stopped: $($proc.ProcessName) (PID: $($proc.Id))" -ForegroundColor Green
        } catch {
            Write-Host "   ✗ Could not stop: $($proc.ProcessName)" -ForegroundColor Red
        }
    }
    Start-Sleep -Seconds 3
} else {
    Write-Host "   ✓ No MySQL processes running" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 2/6] Checking port 3306..." -ForegroundColor Yellow
$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    $portInfo = $portCheck.ToString() -split '\s+'
    $pid = $portInfo[-1]
    if ($pid -match '^\d+$') {
        Write-Host "   ⚠ Port 3306 is still in use by PID: $pid" -ForegroundColor Yellow
        try {
            Stop-Process -Id [int]$pid -Force -ErrorAction Stop
            Write-Host "   ✓ Killed process using port 3306" -ForegroundColor Green
            Start-Sleep -Seconds 2
        } catch {
            Write-Host "   ✗ Could not kill process $pid" -ForegroundColor Red
            Write-Host "   You may need to restart your computer" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ✓ Port 3306 is free" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 3/6] Checking MySQL error logs..." -ForegroundColor Yellow
$errorLogs = Get-ChildItem -Path $mysqlDataPath -Filter "*.err" -ErrorAction SilentlyContinue | Sort-Object LastWriteTime -Descending
if ($errorLogs) {
    $latestLog = $errorLogs[0]
    Write-Host "   Latest error log: $($latestLog.Name)" -ForegroundColor Cyan
    Write-Host "   Last 15 lines:" -ForegroundColor Cyan
    $lastLines = Get-Content $latestLog.FullName -Tail 15 -ErrorAction SilentlyContinue
    foreach ($line in $lastLines) {
        if ($line -match "ERROR|FATAL|failed|shutdown|gone away") {
            Write-Host "      $line" -ForegroundColor Red
        } else {
            Write-Host "      $line" -ForegroundColor Gray
        }
    }
} else {
    Write-Host "   ℹ No error logs found" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "[Step 4/6] Cleaning up corrupted InnoDB files..." -ForegroundColor Yellow
$innodbFiles = @("ib_logfile0", "ib_logfile1", "ibtmp1")
$deletedCount = 0
foreach ($file in $innodbFiles) {
    $filePath = Join-Path $mysqlDataPath $file
    if (Test-Path $filePath) {
        try {
            Remove-Item $filePath -Force -ErrorAction Stop
            Write-Host "   ✓ Deleted: $file" -ForegroundColor Green
            $deletedCount++
        } catch {
            Write-Host "   ⚠ Could not delete: $file" -ForegroundColor Yellow
        }
    }
}
if ($deletedCount -eq 0) {
    Write-Host "   ℹ No InnoDB log files to clean" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "[Step 5/6] Checking MySQL Windows Service..." -ForegroundColor Yellow
$mysqlService = Get-Service -Name "MySQL" -ErrorAction SilentlyContinue
if ($mysqlService) {
    Write-Host "   MySQL service found (Status: $($mysqlService.Status))" -ForegroundColor Cyan
    if ($mysqlService.Status -eq 'Running') {
        Write-Host "   Stopping MySQL service..." -ForegroundColor Yellow
        Stop-Service -Name "MySQL" -Force -ErrorAction SilentlyContinue
        Start-Sleep -Seconds 2
    }
    Write-Host "   Starting MySQL service..." -ForegroundColor Yellow
    try {
        Start-Service -Name "MySQL" -ErrorAction Stop
        Write-Host "   ✓ MySQL service started successfully" -ForegroundColor Green
        Start-Sleep -Seconds 3
    } catch {
        Write-Host "   ✗ Could not start MySQL service: $_" -ForegroundColor Red
        Write-Host "   Will try starting MySQL manually..." -ForegroundColor Yellow
    }
} else {
    Write-Host "   ℹ MySQL not installed as Windows Service" -ForegroundColor Cyan
    Write-Host "   Will start MySQL manually..." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "[Step 6/6] Starting MySQL manually..." -ForegroundColor Yellow
Set-Location $mysqlBinPath

# Check if MySQL is already running
Start-Sleep -Seconds 2
$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    Write-Host "   ✓ MySQL is already running on port 3306" -ForegroundColor Green
} else {
    Write-Host "   Starting MySQL server..." -ForegroundColor Yellow
    Write-Host "   (This may take a few seconds...)" -ForegroundColor Gray
    
    # Start MySQL in background
    $mysqlProcess = Start-Process -FilePath ".\mysqld.exe" -ArgumentList "--defaults-file=..\my.ini" -WindowStyle Hidden -PassThru -ErrorAction SilentlyContinue
    
    if ($mysqlProcess) {
        Write-Host "   ✓ MySQL process started (PID: $($mysqlProcess.Id))" -ForegroundColor Green
        
        # Wait for MySQL to start
        $maxWait = 15
        $waited = 0
        $started = $false
        
        while ($waited -lt $maxWait) {
            Start-Sleep -Seconds 1
            $waited++
            $portCheck = netstat -ano | Select-String ":3306.*LISTENING"
            if ($portCheck) {
                Write-Host "   ✓ MySQL is now listening on port 3306" -ForegroundColor Green
                $started = $true
                break
            }
            Write-Host "   ." -NoNewline -ForegroundColor Gray
        }
        Write-Host ""
        
        if (-not $started) {
            Write-Host "   ⚠ MySQL may still be starting. Check error logs if connection fails." -ForegroundColor Yellow
        }
    } else {
        Write-Host "   ✗ Could not start MySQL process" -ForegroundColor Red
        Write-Host "   Check the error log at: $mysqlDataPath\*.err" -ForegroundColor Yellow
    }
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Fix Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Verifying MySQL connection..." -ForegroundColor Yellow

# Test MySQL connection
Start-Sleep -Seconds 2
$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    Write-Host "✓ MySQL is running on port 3306" -ForegroundColor Green
    Write-Host ""
    Write-Host "Next steps:" -ForegroundColor Yellow
    Write-Host "1. Refresh phpMyAdmin in your browser" -ForegroundColor White
    Write-Host "2. If it still fails, check:" -ForegroundColor White
    Write-Host "   - phpMyAdmin config: C:\xampp\phpMyAdmin\config.inc.php" -ForegroundColor Gray
    Write-Host "   - MySQL error log: $mysqlDataPath\*.err" -ForegroundColor Gray
    Write-Host ""
    Write-Host "To test MySQL connection manually:" -ForegroundColor Cyan
    Write-Host "  cd $mysqlBinPath" -ForegroundColor Gray
    Write-Host "  .\mysql.exe -u root" -ForegroundColor Gray
} else {
    Write-Host "✗ MySQL is not running on port 3306" -ForegroundColor Red
    Write-Host ""
    Write-Host "Troubleshooting:" -ForegroundColor Yellow
    Write-Host "1. Check error log: $mysqlDataPath\*.err" -ForegroundColor White
    Write-Host "2. Try running: diagnose_mysql.ps1" -ForegroundColor White
    Write-Host "3. Try running: fix_xampp_mysql.ps1" -ForegroundColor White
}

Write-Host ""
pause




