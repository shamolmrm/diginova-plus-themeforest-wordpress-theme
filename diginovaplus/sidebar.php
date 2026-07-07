<?php
/**
 * The sidebar containing the main widget area
 *
 * @package DigiNova_Plus
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="bg-white p-4 rounded-4 shadow-sm">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>
