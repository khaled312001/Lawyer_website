# XAMPP MySQL Unexpected Shutdown Fix Script
# Run this script as Administrator (Right-click > Run as Administrator)

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  XAMPP MySQL Shutdown Fix Script" -ForegroundColor Cyan
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

# Check if XAMPP exists
$xamppPath = "C:\xampp"
if (-not (Test-Path $xamppPath)) {
    Write-Host "ERROR: XAMPP not found at C:\xampp" -ForegroundColor Red
    Write-Host "Please install XAMPP or update the path in this script" -ForegroundColor Yellow
    pause
    exit 1
}

$mysqlPath = "$xamppPath\mysql"
$mysqlBinPath = "$mysqlPath\bin"
$mysqlDataPath = "$mysqlPath\data"

if (-not (Test-Path $mysqlBinPath)) {
    Write-Host "ERROR: MySQL not found at $mysqlBinPath" -ForegroundColor Red
    pause
    exit 1
}

Write-Host "[Step 1/7] Stopping all MySQL processes..." -ForegroundColor Yellow
# Stop MySQL service if installed
$mysqlService = Get-Service -Name "MySQL" -ErrorAction SilentlyContinue
if ($mysqlService) {
    if ($mysqlService.Status -eq 'Running') {
        Stop-Service -Name "MySQL" -Force -ErrorAction SilentlyContinue
        Write-Host "   ✓ Stopped MySQL Windows Service" -ForegroundColor Green
    }
}

# Kill all MySQL processes
$mysqlProcesses = Get-Process | Where-Object {$_.ProcessName -like "*mysql*" -or $_.ProcessName -like "*mysqld*"}
if ($mysqlProcesses) {
    foreach ($proc in $mysqlProcesses) {
        try {
            Stop-Process -Id $proc.Id -Force -ErrorAction Stop
            Write-Host "   ✓ Stopped process: $($proc.ProcessName) (PID: $($proc.Id))" -ForegroundColor Green
        } catch {
            Write-Host "   ⚠ Could not stop process: $($proc.ProcessName)" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ✓ No MySQL processes running" -ForegroundColor Green
}
Start-Sleep -Seconds 2

Write-Host ""
Write-Host "[Step 2/7] Checking port 3306..." -ForegroundColor Yellow
$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    $portInfo = $portCheck.ToString() -split '\s+'
    $pid = $portInfo[-1]
    if ($pid -match '^\d+$') {
        Write-Host "   ⚠ Port 3306 is in use by PID: $pid" -ForegroundColor Yellow
        try {
            Stop-Process -Id [int]$pid -Force -ErrorAction Stop
            Write-Host "   ✓ Killed process using port 3306" -ForegroundColor Green
            Start-Sleep -Seconds 2
        } catch {
            Write-Host "   ✗ Could not kill process $pid. You may need to restart your computer." -ForegroundColor Red
        }
    }
} else {
    Write-Host "   ✓ Port 3306 is free" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 3/7] Checking MySQL data directory..." -ForegroundColor Yellow
if (-not (Test-Path $mysqlDataPath)) {
    Write-Host "   ⚠ Data directory not found. Creating..." -ForegroundColor Yellow
    New-Item -ItemType Directory -Path $mysqlDataPath -Force | Out-Null
    Write-Host "   ✓ Created data directory" -ForegroundColor Green
} else {
    Write-Host "   ✓ Data directory exists" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 4/7] Backing up critical files..." -ForegroundColor Yellow
$backupPath = "$mysqlDataPath\backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
if (Test-Path $mysqlDataPath) {
    $criticalFiles = @("ib_logfile0", "ib_logfile1", "ibdata1", "*.err")
    $hasFiles = $false
    foreach ($pattern in $criticalFiles) {
        $files = Get-ChildItem -Path $mysqlDataPath -Filter $pattern -ErrorAction SilentlyContinue
        if ($files) {
            $hasFiles = $true
            break
        }
    }
    
    if ($hasFiles) {
        New-Item -ItemType Directory -Path $backupPath -Force | Out-Null
        foreach ($pattern in $criticalFiles) {
            $files = Get-ChildItem -Path $mysqlDataPath -Filter $pattern -ErrorAction SilentlyContinue
            foreach ($file in $files) {
                try {
                    Copy-Item $file.FullName $backupPath -Force -ErrorAction Stop
                    Write-Host "   ✓ Backed up: $($file.Name)" -ForegroundColor Green
                } catch {
                    Write-Host "   ⚠ Could not backup: $($file.Name)" -ForegroundColor Yellow
                }
            }
        }
        Write-Host "   ✓ Backup created at: $backupPath" -ForegroundColor Green
    } else {
        Write-Host "   ℹ No critical files to backup" -ForegroundColor Cyan
    }
}

Write-Host ""
Write-Host "[Step 5/7] Removing corrupted InnoDB log files..." -ForegroundColor Yellow
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
            Write-Host "   ✗ Could not delete: $file - $_" -ForegroundColor Red
        }
    }
}
if ($deletedCount -eq 0) {
    Write-Host "   ℹ No InnoDB log files found to delete" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "[Step 6/7] Checking MySQL configuration..." -ForegroundColor Yellow
$myIniPath = "$mysqlPath\my.ini"
if (Test-Path $myIniPath) {
    Write-Host "   ✓ Configuration file found" -ForegroundColor Green
    
    # Check for common issues in my.ini
    $myIniContent = Get-Content $myIniPath -Raw
    if ($myIniContent -match 'datadir\s*=\s*(.+?)(?:\s|$)') {
        $configDataDir = $matches[1].Trim('"', "'", ' ')
        if ($configDataDir -ne $mysqlDataPath -and $configDataDir -ne $mysqlDataPath.Replace('\', '/')) {
            Write-Host "   ⚠ Warning: datadir in my.ini ($configDataDir) doesn't match expected path" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ⚠ Configuration file not found at $myIniPath" -ForegroundColor Yellow
    Write-Host "   This might cause issues. MySQL will use default settings." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "[Step 7/7] Attempting to repair/initialize MySQL..." -ForegroundColor Yellow
Set-Location $mysqlBinPath

# Try to initialize MySQL if needed
$mysqlErrorLog = Get-ChildItem -Path $mysqlDataPath -Filter "*.err" -ErrorAction SilentlyContinue | Sort-Object LastWriteTime -Descending | Select-Object -First 1

if ($mysqlErrorLog) {
    Write-Host "   ℹ Found error log: $($mysqlErrorLog.Name)" -ForegroundColor Cyan
    Write-Host "   Checking last 10 lines..." -ForegroundColor Cyan
    $lastLines = Get-Content $mysqlErrorLog.FullName -Tail 10
    foreach ($line in $lastLines) {
        Write-Host "      $line" -ForegroundColor Gray
    }
}

# Check if MySQL needs initialization
$mysqlSystemDirs = @("mysql", "performance_schema", "sys")
$needsInit = $true
foreach ($dir in $mysqlSystemDirs) {
    if (Test-Path (Join-Path $mysqlDataPath $dir)) {
        $needsInit = $false
        break
    }
}

if ($needsInit) {
    Write-Host "   ⚠ MySQL data directory appears to be empty or corrupted" -ForegroundColor Yellow
    Write-Host "   Attempting to initialize MySQL..." -ForegroundColor Yellow
    Write-Host ""
    Write-Host "   IMPORTANT: This will create a new MySQL installation!" -ForegroundColor Red
    Write-Host "   All existing databases will be lost unless you have a backup." -ForegroundColor Red
    Write-Host ""
    $response = Read-Host "   Continue? (y/N)"
    if ($response -eq 'y' -or $response -eq 'Y') {
        try {
            $initOutput = & .\mysqld.exe --initialize --console 2>&1
            if ($LASTEXITCODE -eq 0) {
                Write-Host "   ✓ MySQL initialized successfully" -ForegroundColor Green
                Write-Host ""
                Write-Host "   IMPORTANT: Check the output above for the temporary root password!" -ForegroundColor Yellow
            } else {
                Write-Host "   ✗ Initialization failed" -ForegroundColor Red
                Write-Host "   Output: $initOutput" -ForegroundColor Red
            }
        } catch {
            Write-Host "   ✗ Initialization error: $_" -ForegroundColor Red
        }
    } else {
        Write-Host "   Skipped initialization" -ForegroundColor Yellow
    }
} else {
    Write-Host "   ✓ MySQL data directory appears intact" -ForegroundColor Green
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Fix Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Open XAMPP Control Panel" -ForegroundColor White
Write-Host "2. Click 'Start' next to MySQL" -ForegroundColor White
Write-Host "3. If it still fails, check the error log:" -ForegroundColor White
Write-Host "   $mysqlDataPath\*.err" -ForegroundColor Gray
Write-Host ""
Write-Host "Alternative: Install MySQL as Windows Service" -ForegroundColor Yellow
Write-Host "Run this command as Administrator:" -ForegroundColor White
Write-Host "  cd $mysqlBinPath" -ForegroundColor Gray
Write-Host "  .\mysqld.exe --install MySQL --defaults-file=$mysqlPath\my.ini" -ForegroundColor Gray
Write-Host "  net start MySQL" -ForegroundColor Gray
Write-Host ""

if (Test-Path $backupPath) {
    Write-Host "Backup location: $backupPath" -ForegroundColor Cyan
}

pause

