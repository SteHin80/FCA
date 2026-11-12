<?php
/**
 * Title: Hero-Banner
 * Slug: foerderverein-pro/hero-banner
 * Categories: foerderverein
 * Description: Seitenkopf mit Vereinsblau-Verlauf, Überschrift, Text und zwei Buttons.
 */
?>
<!-- wp:cover {"overlayColor":"fv-blue","isDark":true,"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem","left":"1.5rem","right":"1.5rem"}}},"gradient":"fv-blue-gradient","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-dark" style="padding-top:4rem;padding-bottom:4rem;padding-left:1.5rem;padding-right:1.5rem">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim has-background-dim-100 has-background-gradient has-fv-blue-gradient-gradient-background"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"textAlign":"center","level":1,"textColor":"fv-white"} -->
		<h1 class="wp-block-heading has-text-align-center has-fv-white-color has-text-color"><?php echo esc_html__( 'Gemeinsam für unseren Verein!', 'foerderverein-pro' ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","textColor":"fv-white"} -->
		<p class="has-text-align-center has-fv-white-color has-text-color"><?php echo esc_html__( 'Wir unterstützen unseren Amateurfussballverein – mit Spenden, Aktionen und ehrenamtlichem Engagement.', 'foerderverein-pro' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/mitgliedschaft"><?php echo esc_html__( 'Mitglied werden', 'foerderverein-pro' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/spenden"><?php echo esc_html__( 'Jetzt spenden', 'foerderverein-pro' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
</div>
<!-- /wp:cover -->
