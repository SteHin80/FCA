<?php
/**
 * Title: Mitglied werden
 * Slug: foerderverein-pro/mitglied-werden
 * Categories: foerderverein
 * Description: Handlungsaufforderung mit Vereinsblau-Hintergrund und Button zur Mitgliedschaft.
 */
?>
<!-- wp:group {"backgroundColor":"fv-blue","textColor":"fv-white","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-fv-white-color has-fv-blue-background-color has-text-color has-background" style="margin-top:2rem;margin-bottom:2rem;padding:2.5rem 1.5rem">
	<!-- wp:heading {"textAlign":"center","level":2} -->
	<h2 class="wp-block-heading has-text-align-center"><?php echo esc_html__( 'Mitglied im Förderverein werden', 'foerderverein-pro' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center"><?php echo esc_html__( 'Mit Ihrem Beitrag finanzieren wir Trainingsmaterial, Trikots und die Jugendarbeit.', 'foerderverein-pro' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/mitgliedschaft"><?php echo esc_html__( 'Jetzt Mitglied werden', 'foerderverein-pro' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
