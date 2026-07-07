$phpExe = "C:\xampp\php\php.exe"
$siteDir = "C:\xampp\htdocs\diginovaplus-test"
$wpCli = "$siteDir\wp-cli.phar"

Write-Host "Creating Home pages..."
$homeSaasId = & $phpExe $wpCli post create --post_type=page --post_title="Home SaaS" --post_status=publish --porcelain --path=$siteDir
& $phpExe $wpCli post meta update $homeSaasId _wp_page_template "page-templates/template-home-saas.php" --path=$siteDir

$homeMarketId = & $phpExe $wpCli post create --post_type=page --post_title="Home Marketplace" --post_status=publish --porcelain --path=$siteDir
& $phpExe $wpCli post meta update $homeMarketId _wp_page_template "page-templates/template-home-marketplace.php" --path=$siteDir

$homeCreativeId = & $phpExe $wpCli post create --post_type=page --post_title="Home Creative" --post_status=publish --porcelain --path=$siteDir
& $phpExe $wpCli post meta update $homeCreativeId _wp_page_template "page-templates/template-home-creative.php" --path=$siteDir

Write-Host "Setting Home SaaS as Front Page..."
& $phpExe $wpCli option update show_on_front page --path=$siteDir
& $phpExe $wpCli option update page_on_front $homeSaasId --path=$siteDir

Write-Host "Creating Main Menu..."
$menuId = & $phpExe $wpCli menu create "Main Menu" --porcelain --path=$siteDir
& $phpExe $wpCli menu item add-post $menuId $homeSaasId --title="SaaS Demo" --path=$siteDir
& $phpExe $wpCli menu item add-post $menuId $homeMarketId --title="Marketplace Demo" --path=$siteDir
& $phpExe $wpCli menu item add-post $menuId $homeCreativeId --title="Creative Demo" --path=$siteDir
& $phpExe $wpCli menu location assign $menuId primary --path=$siteDir

Write-Host "Setup Complete!"
