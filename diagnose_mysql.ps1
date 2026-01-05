# Quick MySQL Diagnostic Script for XAMPP
# This script helps identify the cause of MySQL shutdown issues

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  MySQL Diagnostic Tool" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$xamppPath = "C:\xampp"
$mysqlPath = "$xamppPath\mysql"
$mysqlDataPath = "$mysqlPath\data"
$mysqlBinPath = "$mysqlPath\bin"

Write-Host "Checking XAMPP Installation..." -ForegroundColor Yellow
if (Test-Path $xamppPath) {
    Write-Host "  ✓ XAMPP found at: $xamppPath" -ForegroundColor Green
} else {
    Write-Host "  ✗ XAMPP not found at: $xamppPath" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "Checking MySQL Processes..." -ForegroundColor Yellow
$mysqlProcesses = Get-Process | Where-Object {$_.ProcessName -like "*mysql*"}
if ($mysqlProcesses) {
    Write-Host "  ⚠ MySQL processes running:" -ForegroundColor Yellow
    foreach ($proc in $mysqlProcesses) {
        Write-Host "    - $($proc.ProcessName) (PID: $($proc.Id))" -ForegroundColor Gray
    }
} else {
    Write-Host "  ✓ No MySQL processes running" -ForegroundColor Green
}

Write-Host ""
Write-Host "Checking Port 3306..." -ForegroundColor Yellow
$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    $portInfo = $portCheck.ToString() -split '\s+'
    $pid = $portInfo[-1]
    $process = Get-Process -Id $pid -ErrorAction SilentlyContinue
    if ($process) {
        Write-Host "  ⚠ Port 3306 is in use by:" -ForegroundColor Yellow
        Write-Host "    - Process: $($process.ProcessName) (PID: $pid)" -ForegroundColor Gray
        Write-Host "    - Path: $($process.Path)" -ForegroundColor Gray
    } else {
        Write-Host "  ⚠ Port 3306 is in use by PID: $pid (process not found)" -ForegroundColor Yellow
    }
} else {
    Write-Host "  ✓ Port 3306 is free" -ForegroundColor Green
}

Write-Host ""
Write-Host "Checking MySQL Data Directory..." -ForegroundColor Yellow
if (Test-Path $mysqlDataPath) {
    Write-Host "  ✓ Data directory exists: $mysqlDataPath" -ForegroundColor Green
    
    $errorLogs = Get-ChildItem -Path $mysqlDataPath -Filter "*.err" -ErrorAction SilentlyContinue | Sort-Object LastWriteTime -Descending
    if ($errorLogs) {
        Write-Host ""
        Write-Host "  Latest Error Log: $($errorLogs[0].Name)" -ForegroundColor Yellow
        Write-Host "  Last 20 lines:" -ForegroundColor Yellow
        Write-Host "  ----------------------------------------" -ForegroundColor Gray
        $lastLines = Get-Content $errorLogs[0].FullName -Tail 20
        foreach ($line in $lastLines) {
            if ($line -match "ERROR|FATAL|failed|shutdown") {
                Write-Host "  $line" -ForegroundColor Red
            } else {
                Write-Host "  $line" -ForegroundColor Gray
            }
        }
        Write-Host "  ----------------------------------------" -ForegroundColor Gray
    } else {
        Write-Host "  ℹ No error logs found" -ForegroundColor Cyan
    }
    
    # Check for InnoDB files
    Write-Host ""
    Write-Host "  Checking InnoDB files..." -ForegroundColor Yellow
    $innodbFiles = @("ib_logfile0", "ib_logfile1", "ibdata1", "ibtmp1")
    foreach ($file in $innodbFiles) {
        $filePath = Join-Path $mysqlDataPath $file
        if (Test-Path $filePath) {
            $fileInfo = Get-Item $filePath
            Write-Host "    ✓ $file ($([math]::Round($fileInfo.Length/1MB, 2)) MB)" -ForegroundColor Green
        } else {
            Write-Host "    - $file (not found)" -ForegroundColor Gray
        }
    }
} else {
    Write-Host "  ✗ Data directory not found: $mysqlDataPath" -ForegroundColor Red
}

Write-Host ""
Write-Host "Checking MySQL Configuration..." -ForegroundColor Yellow
$myIniPath = "$mysqlPath\my.ini"
if (Test-Path $myIniPath) {
    Write-Host "  ✓ Configuration file found" -ForegroundColor Green
    $myIniContent = Get-Content $myIniPath -Raw
    
    # Extract key settings
    if ($myIniContent -match 'port\s*=\s*(\d+)') {
        Write-Host "    Port: $($matches[1])" -ForegroundColor Gray
    }
    if ($myIniContent -match 'datadir\s*=\s*(.+?)(?:\s|$)') {
        $dataDir = $matches[1].Trim('"', "'", ' ')
        Write-Host "    Data Directory: $dataDir" -ForegroundColor Gray
    }
    if ($myIniContent -match 'innodb_buffer_pool_size\s*=\s*(\d+[KMGT]?)') {
        Write-Host "    InnoDB Buffer Pool: $($matches[1])" -ForegroundColor Gray
    }
} else {
    Write-Host "  ⚠ Configuration file not found: $myIniPath" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Checking MySQL Service..." -ForegroundColor Yellow
$mysqlService = Get-Service -Name "MySQL" -ErrorAction SilentlyContinue
if ($mysqlService) {
    Write-Host "  ✓ MySQL Windows Service found" -ForegroundColor Green
    Write-Host "    Status: $($mysqlService.Status)" -ForegroundColor Gray
    Write-Host "    Start Type: $($mysqlService.StartType)" -ForegroundColor Gray
} else {
    Write-Host "  ℹ MySQL not installed as Windows Service" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Diagnostic Complete" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Common Issues and Solutions:" -ForegroundColor Yellow
Write-Host "1. Port 3306 in use → Stop the conflicting process" -ForegroundColor White
Write-Host "2. Corrupted InnoDB files → Delete ib_logfile0, ib_logfile1, ibtmp1" -ForegroundColor White
Write-Host "3. Missing data directory → Run MySQL initialization" -ForegroundColor White
Write-Host "4. Configuration errors → Check my.ini file" -ForegroundColor White
Write-Host ""
Write-Host "Run fix_xampp_mysql.ps1 as Administrator to attempt automatic fix" -ForegroundColor Cyan
Write-Host ""

pause

