$htdocs = "C:\xampp\htdocs"
$siteDir = "$htdocs\diginovaplus-test"
$themeSource = "d:\Flutter App\Wordpress\DigiNova Plus - ThemeForest WordPress Theme\diginovaplus"
$pluginSource = "d:\Flutter App\Wordpress\DigiNova Plus - ThemeForest WordPress Theme\diginovaplus-core"

Write-Host "Creating site directory..."
if (Test-Path $siteDir) {
    Remove-Item -Recurse -Force $siteDir
}
New-Item -ItemType Directory -Force -Path $siteDir | Out-Null

Write-Host "Downloading WordPress..."
Invoke-WebRequest -Uri "https://wordpress.org/latest.zip" -OutFile "$htdocs\latest.zip"

Write-Host "Extracting WordPress..."
Expand-Archive -Path "$htdocs\latest.zip" -DestinationPath "$htdocs\wp_extract" -Force
Move-Item -Path "$htdocs\wp_extract\wordpress\*" -Destination $siteDir -Force
Remove-Item -Recurse -Force "$htdocs\wp_extract"
Remove-Item -Force "$htdocs\latest.zip"

Write-Host "Setting up Database..."
$mysqlExe = "C:\xampp\mysql\bin\mysql.exe"
if (Test-Path $mysqlExe) {
    & $mysqlExe -u root -e "DROP DATABASE IF EXISTS diginovaplus_test; CREATE DATABASE diginovaplus_test;"
} else {
    Write-Host "MySQL not found at $mysqlExe, please create database manually."
}

Write-Host "Creating wp-config.php..."
$wpConfigSample = "$siteDir\wp-config-sample.php"
$wpConfig = "$siteDir\wp-config.php"
if (Test-Path $wpConfigSample) {
    $configContent = Get-Content $wpConfigSample -Raw
    $configContent = $configContent -replace "'database_name_here'", "'diginovaplus_test'"
    $configContent = $configContent -replace "'username_here'", "'root'"
    $configContent = $configContent -replace "'password_here'", "''"
    Set-Content -Path $wpConfig -Value $configContent
}

Write-Host "Copying Theme..."
Copy-Item -Path $themeSource -Destination "$siteDir\wp-content\themes\diginovaplus" -Recurse -Force

Write-Host "Copying Plugin..."
Copy-Item -Path $pluginSource -Destination "$siteDir\wp-content\plugins\diginovaplus-core" -Recurse -Force

Write-Host "Setup Complete!"
