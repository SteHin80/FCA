<?php
/**
 * Title: Kontaktbereich
 * Slug: foerderverein-pro/kontakt-bereich
 * Categories: foerderverein
 * Description: Drei Kontaktkarten (Adresse, Telefon, E-Mail) im Theme-Look.
 */
?>
<!-- wp:columns {"style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"}}}} -->
<div class="wp-block-columns" style="margin-top:2rem;margin-bottom:2rem">
	<!-- wp:column {"style":{"border":{"width":"1px","color":"#c0c0c1","radius":"10px"},"spacing":{"padding":{"all":"1.25rem"}}}} -->
	<div class="wp-block-column has-border-color" style="border-color:#c0c0c1;border-width:1px;border-radius:10px;padding:1.25rem">
		<!-- wp:heading {"level":3,"textColor":"fv-blue"} -->
		<h3 class="wp-block-heading has-fv-blue-color has-text-color"><?php echo esc_html__( 'Anschrift', 'foerderverein-pro' ); ?></h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'Förderverein e. V.
Musterstraße 1
12345 Musterstadt', 'foerderverein-pro' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
	<!-- wp:column {"style":{"border":{"width":"1px","color":"#c0c0c1","radius":"10px"},"spacing":{"padding":{"all":"1.25rem"}}}} -->
	<div class="wp-block-column has-border-color" style="border-color:#c0c0c1;border-width:1px;border-radius:10px;padding:1.25rem">
		<!-- wp:heading {"level":3,"textColor":"fv-blue"} -->
		<h3 class="wp-block-heading has-fv-blue-color has-text-color"><?php echo esc_html__( 'Telefon', 'foerderverein-pro' ); ?></h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html__( '0123 456789', 'foerderverein-pro' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
	<!-- wp:column {"style":{"border":{"width":"1px","color":"#c0c0c1","radius":"10px"},"spacing":{"padding":{"all":"1.25rem"}}}} -->
	<div class="wp-block-column has-border-color" style="border-color:#c0c0c1;border-width:1px;border-radius:10px;padding:1.25rem">
		<!-- wp:heading {"level":3,"textColor":"fv-blue"} -->
		<h3 class="wp-block-heading has-fv-blue-color has-text-color"><?php echo esc_html__( 'E-Mail', 'foerderverein-pro' ); ?></h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'info@foerderverein.de', 'foerderverein-pro' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
