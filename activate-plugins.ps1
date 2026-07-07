$phpExe = "C:\xampp\php\php.exe"
$siteDir = "C:\xampp\htdocs\diginovaplus-test"
$wpCli = "$siteDir\wp-cli.phar"

Write-Host "Downloading WP-CLI..."
Invoke-WebRequest -Uri "https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar" -OutFile $wpCli

Write-Host "Activating Theme..."
& $phpExe $wpCli theme activate diginovaplus --path=$siteDir

Write-Host "Installing Required Plugins (Elementor, WooCommerce, OCDI)..."
& $phpExe $wpCli plugin install elementor woocommerce one-click-demo-import --activate --path=$siteDir

Write-Host "Installing DigiNova Plus Core..."
& $phpExe $wpCli plugin install "$siteDir\wp-content\themes\diginovaplus\plugins\diginovaplus-core.zip" --activate --path=$siteDir

Write-Host "Done!"
