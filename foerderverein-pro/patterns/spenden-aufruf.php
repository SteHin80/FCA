<?php
/**
 * Title: Spenden-Aufruf
 * Slug: foerderverein-pro/spenden-aufruf
 * Categories: foerderverein
 * Description: Spendenappell in Hellgrau mit rotem Button.
 */
?>
<!-- wp:group {"backgroundColor":"fv-grey-light","style":{"spacing":{"padding":{"top":"2.5rem","bottom":"2.5rem","left":"1.5rem","right":"1.5rem"},"margin":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="margin-top:2rem;margin-bottom:2rem;padding:2.5rem 1.5rem;background-color:#f3f3f4">
	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"fv-blue"} -->
	<h2 class="wp-block-heading has-text-align-center has-fv-blue-color has-text-color"><?php echo esc_html__( 'Unterstützen Sie unseren Verein', 'foerderverein-pro' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center"><?php echo esc_html__( 'Jeder Betrag kommt direkt den Mannschaften zugute – ob Geld- oder Sachspende.', 'foerderverein-pro' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/spenden"><?php echo esc_html__( 'Jetzt spenden', 'foerderverein-pro' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
