<?php
/**
 * 404-Seite.
 *
 * @package foerderverein-pro
 */

get_header();
?>

<div class="fv-container fv-content">
	<main id="primary">
		<h1 class="entry-title">404</h1>
		<p><?php esc_html_e( 'Diese Seite wurde leider nicht gefunden. Vielleicht findest du über die Suche, was du suchst.', 'foerderverein-pro' ); ?></p>
		<?php get_search_form(); ?>
	</main>
</div>

<?php get_footer(); ?>
