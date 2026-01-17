# Fix MySQL Service Path Conflict and Port 3306 Issue
# This script fixes the XAMPP MySQL service conflict where another MySQL service
# is installed with a different path, blocking XAMPP's MySQL from starting
# Run this script as Administrator (Right-click > Run as Administrator)

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  MySQL Service Conflict Fix" -ForegroundColor Cyan
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
$expectedMysqldPath = "$mysqlBinPath\mysqld.exe"

# Check if XAMPP exists
if (-not (Test-Path $xamppPath)) {
    Write-Host "ERROR: XAMPP not found at C:\xampp" -ForegroundColor Red
    Write-Host "Please install XAMPP or update the path in this script" -ForegroundColor Yellow
    pause
    exit 1
}

if (-not (Test-Path $expectedMysqldPath)) {
    Write-Host "ERROR: MySQL not found at $expectedMysqldPath" -ForegroundColor Red
    pause
    exit 1
}

Write-Host "[Step 1/6] Checking for MySQL Windows Service..." -ForegroundColor Yellow

# Get all MySQL services
$mysqlServices = Get-Service | Where-Object {$_.Name -like "*mysql*" -or $_.DisplayName -like "*mysql*"}

if ($mysqlServices) {
    Write-Host "   Found MySQL service(s):" -ForegroundColor Cyan
    foreach ($service in $mysqlServices) {
        Write-Host "     - $($service.Name) ($($service.DisplayName))" -ForegroundColor Gray
        Write-Host "       Status: $($service.Status)" -ForegroundColor Gray
        
        # Get service details using WMI
        try {
            $serviceWMI = Get-WmiObject Win32_Service -Filter "Name='$($service.Name)'" -ErrorAction SilentlyContinue
            if ($serviceWMI) {
                $servicePath = $serviceWMI.PathName
                Write-Host "       Path: $servicePath" -ForegroundColor Gray
                
                # Check if path is wrong (not XAMPP's MySQL)
                if ($servicePath -notlike "*xampp*" -and $servicePath -like "*mysql*") {
                    Write-Host "       ⚠ WARNING: This service is NOT using XAMPP's MySQL!" -ForegroundColor Yellow
                    Write-Host "       Expected: $expectedMysqldPath" -ForegroundColor Yellow
                    Write-Host "       Found: $servicePath" -ForegroundColor Yellow
                    
                    # Stop the service first
                    if ($service.Status -eq 'Running') {
                        Write-Host "       Stopping service..." -ForegroundColor Yellow
                        Stop-Service -Name $service.Name -Force -ErrorAction SilentlyContinue
                        Start-Sleep -Seconds 2
                        Write-Host "       ✓ Service stopped" -ForegroundColor Green
                    }
                    
                    # Remove the service
                    Write-Host "       Removing service..." -ForegroundColor Yellow
                    try {
                        # Try to remove using sc.exe (more reliable)
                        $removeResult = sc.exe delete $service.Name 2>&1
                        if ($LASTEXITCODE -eq 0) {
                            Write-Host "       ✓ Service removed successfully" -ForegroundColor Green
                        } else {
                            Write-Host "       ⚠ Service removal may have failed. Trying alternative method..." -ForegroundColor Yellow
                            # Alternative: Use mysqld --remove if it's a MySQL service
                            if ($service.Name -eq "MySQL") {
                                $removeResult2 = & "$mysqlBinPath\mysqld.exe" --remove MySQL 2>&1
                                if ($LASTEXITCODE -eq 0) {
                                    Write-Host "       ✓ Service removed using mysqld --remove" -ForegroundColor Green
                                } else {
                                    Write-Host "       ✗ Could not remove service automatically" -ForegroundColor Red
                                    Write-Host "       You may need to remove it manually using:" -ForegroundColor Yellow
                                    Write-Host "         sc.exe delete $($service.Name)" -ForegroundColor Gray
                                }
                            }
                        }
                    } catch {
                        Write-Host "       ✗ Error removing service: $_" -ForegroundColor Red
                    }
                } else {
                    Write-Host "       ✓ Service is using XAMPP's MySQL (or correct path)" -ForegroundColor Green
                }
            }
        } catch {
            Write-Host "       ⚠ Could not get service details: $_" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ✓ No MySQL Windows Service found" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 2/6] Stopping all MySQL processes..." -ForegroundColor Yellow

# Kill all MySQL processes
$mysqlProcesses = Get-Process | Where-Object {$_.ProcessName -like "*mysql*" -or $_.ProcessName -like "*mysqld*"}
if ($mysqlProcesses) {
    foreach ($proc in $mysqlProcesses) {
        try {
            $procPath = $proc.Path
            Write-Host "   Stopping: $($proc.ProcessName) (PID: $($proc.Id))" -ForegroundColor Gray
            if ($procPath) {
                Write-Host "     Path: $procPath" -ForegroundColor Gray
            }
            Stop-Process -Id $proc.Id -Force -ErrorAction Stop
            Write-Host "     ✓ Stopped" -ForegroundColor Green
        } catch {
            Write-Host "     ✗ Could not stop process: $($proc.ProcessName)" -ForegroundColor Red
        }
    }
} else {
    Write-Host "   ✓ No MySQL processes running" -ForegroundColor Green
}
Start-Sleep -Seconds 2

Write-Host ""
Write-Host "[Step 3/6] Checking and freeing port 3306..." -ForegroundColor Yellow

$portCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck) {
    $portInfo = $portCheck.ToString() -split '\s+'
    $pid = $portInfo[-1]
    if ($pid -match '^\d+$') {
        Write-Host "   ⚠ Port 3306 is in use by PID: $pid" -ForegroundColor Yellow
        
        # Try to get process info
        try {
            $process = Get-Process -Id [int]$pid -ErrorAction Stop
            Write-Host "     Process: $($process.ProcessName)" -ForegroundColor Gray
            if ($process.Path) {
                Write-Host "     Path: $($process.Path)" -ForegroundColor Gray
            }
        } catch {
            Write-Host "     Process not found (may have already terminated)" -ForegroundColor Gray
        }
        
        # Kill the process
        try {
            Stop-Process -Id [int]$pid -Force -ErrorAction Stop
            Write-Host "   ✓ Killed process using port 3306" -ForegroundColor Green
            Start-Sleep -Seconds 2
        } catch {
            Write-Host "   ✗ Could not kill process $pid" -ForegroundColor Red
            Write-Host "     You may need to restart your computer or manually kill the process" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ✓ Port 3306 is free" -ForegroundColor Green
}

# Double-check port is free
Start-Sleep -Seconds 1
$portCheck2 = netstat -ano | Select-String ":3306.*LISTENING"
if ($portCheck2) {
    Write-Host "   ⚠ WARNING: Port 3306 is still in use after cleanup!" -ForegroundColor Red
    Write-Host "     You may need to restart your computer" -ForegroundColor Yellow
} else {
    Write-Host "   ✓ Port 3306 confirmed free" -ForegroundColor Green
}

Write-Host ""
Write-Host "[Step 4/6] Installing XAMPP MySQL as Windows Service (optional)..." -ForegroundColor Yellow

$response = Read-Host "   Do you want to install XAMPP's MySQL as a Windows Service? (Y/n)"
if ($response -ne 'n' -and $response -ne 'N') {
    Set-Location $mysqlBinPath
    
    # Check if my.ini exists
    $myIniPath = "$mysqlPath\my.ini"
    if (-not (Test-Path $myIniPath)) {
        Write-Host "   ⚠ Warning: my.ini not found at $myIniPath" -ForegroundColor Yellow
        Write-Host "     MySQL service will use default settings" -ForegroundColor Yellow
    }
    
    # Remove existing MySQL service if it exists
    $existingService = Get-Service -Name "MySQL" -ErrorAction SilentlyContinue
    if ($existingService) {
        Write-Host "   Removing existing MySQL service..." -ForegroundColor Yellow
        if ($existingService.Status -eq 'Running') {
            Stop-Service -Name "MySQL" -Force -ErrorAction SilentlyContinue
        }
        & .\mysqld.exe --remove MySQL 2>&1 | Out-Null
        Start-Sleep -Seconds 1
    }
    
    # Install MySQL service with correct path
    Write-Host "   Installing MySQL service with XAMPP path..." -ForegroundColor Yellow
    if (Test-Path $myIniPath) {
        $installResult = & .\mysqld.exe --install MySQL --defaults-file="$myIniPath" 2>&1
    } else {
        $installResult = & .\mysqld.exe --install MySQL 2>&1
    }
    
    if ($LASTEXITCODE -eq 0 -or $installResult -match "successfully") {
        Write-Host "   ✓ MySQL service installed successfully" -ForegroundColor Green
        
        # Start the service
        Write-Host "   Starting MySQL service..." -ForegroundColor Yellow
        try {
            Start-Service -Name "MySQL" -ErrorAction Stop
            Start-Sleep -Seconds 2
            $serviceStatus = Get-Service -Name "MySQL"
            if ($serviceStatus.Status -eq 'Running') {
                Write-Host "   ✓ MySQL service started successfully" -ForegroundColor Green
            } else {
                Write-Host "   ⚠ MySQL service installed but not running" -ForegroundColor Yellow
                Write-Host "     Status: $($serviceStatus.Status)" -ForegroundColor Yellow
            }
        } catch {
            Write-Host "   ⚠ Could not start MySQL service: $_" -ForegroundColor Yellow
            Write-Host "     You can start it manually using: net start MySQL" -ForegroundColor Gray
        }
    } else {
        Write-Host "   ⚠ Service installation may have failed" -ForegroundColor Yellow
        Write-Host "     Output: $installResult" -ForegroundColor Gray
        Write-Host "     You can try installing manually:" -ForegroundColor Yellow
        Write-Host "       cd $mysqlBinPath" -ForegroundColor Gray
        if (Test-Path $myIniPath) {
            Write-Host "       .\mysqld.exe --install MySQL --defaults-file=`"$myIniPath`"" -ForegroundColor Gray
        } else {
            Write-Host "       .\mysqld.exe --install MySQL" -ForegroundColor Gray
        }
    }
} else {
    Write-Host "   Skipped service installation" -ForegroundColor Cyan
    Write-Host "   You can use XAMPP Control Panel to start MySQL manually" -ForegroundColor Gray
}

Write-Host ""
Write-Host "[Step 5/6] Verifying MySQL service configuration..." -ForegroundColor Yellow

$finalService = Get-Service -Name "MySQL" -ErrorAction SilentlyContinue
if ($finalService) {
    try {
        $serviceWMI = Get-WmiObject Win32_Service -Filter "Name='MySQL'" -ErrorAction SilentlyContinue
        if ($serviceWMI) {
            $servicePath = $serviceWMI.PathName
            Write-Host "   Current MySQL service path:" -ForegroundColor Cyan
            Write-Host "     $servicePath" -ForegroundColor Gray
            
            if ($servicePath -like "*xampp*" -or $servicePath -like "*$mysqlBinPath*") {
                Write-Host "   ✓ Service is using XAMPP's MySQL" -ForegroundColor Green
            } else {
                Write-Host "   ⚠ Service path doesn't match XAMPP" -ForegroundColor Yellow
                Write-Host "     Expected path should contain: xampp" -ForegroundColor Yellow
            }
        }
    } catch {
        Write-Host "   ⚠ Could not verify service path" -ForegroundColor Yellow
    }
} else {
    Write-Host "   ℹ MySQL service not installed (this is OK if using XAMPP Control Panel)" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "[Step 6/6] Final port check..." -ForegroundColor Yellow
$finalPortCheck = netstat -ano | Select-String ":3306.*LISTENING"
if ($finalPortCheck) {
    $portInfo = $finalPortCheck.ToString() -split '\s+'
    $processId = $portInfo[-1]
    if ($processId -match '^\d+$') {
        try {
            $process = Get-Process -Id [int]$processId -ErrorAction SilentlyContinue
            if ($process) {
                Write-Host "   Port 3306 is in use by:" -ForegroundColor Cyan
                Write-Host "     Process: $($process.ProcessName) (PID: $processId)" -ForegroundColor Gray
                if ($process.Path) {
                    Write-Host "     Path: $($process.Path)" -ForegroundColor Gray
                    if ($process.Path -like "*xampp*") {
                        Write-Host "   ✓ Port is being used by XAMPP's MySQL - Good!" -ForegroundColor Green
                    } else {
                        Write-Host "   ⚠ Port is being used by non-XAMPP MySQL" -ForegroundColor Yellow
                    }
                }
            } else {
                Write-Host "   ⚠ Port 3306 is in use but process not found" -ForegroundColor Yellow
            }
        } catch {
            Write-Host "   ⚠ Port 3306 is in use (PID: $processId)" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "   ℹ Port 3306 is free (MySQL not running)" -ForegroundColor Cyan
    Write-Host "     You can start MySQL from XAMPP Control Panel" -ForegroundColor Gray
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Fix Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Open XAMPP Control Panel" -ForegroundColor White
Write-Host "2. Click 'Start' next to MySQL" -ForegroundColor White
Write-Host "3. If MySQL service is installed, it should start automatically" -ForegroundColor White
Write-Host ""
Write-Host "If you still see errors:" -ForegroundColor Yellow
Write-Host "- Check the error log: C:\xampp\mysql\data\*.err" -ForegroundColor White
Write-Host "- Run diagnose_mysql.ps1 for detailed diagnostics" -ForegroundColor White
Write-Host "- Make sure no other MySQL installation is running" -ForegroundColor White
Write-Host ""

pause
