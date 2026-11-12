<?php
/**
 * Seitenleiste mit Widgets.
 *
 * @package foerderverein
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="fv-sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
