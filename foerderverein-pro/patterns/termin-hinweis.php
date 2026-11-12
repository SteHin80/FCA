<?php
/**
 * Title: Termin-Hinweis
 * Slug: foerderverein-pro/termin-hinweis
 * Categories: foerderverein
 * Description: Hinweiskasten für Termine mit roter Akzentkante.
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem","left":"1.5rem","right":"1.5rem"},"margin":{"top":"1.5rem","bottom":"1.5rem"}},"border":{"left":{"color":"#e53832","width":"4px"},"right":{"width":"0px","style":"none"},"top":{"width":"0px","style":"none"},"bottom":{"width":"0px","style":"none"}},"color":{"background":"#f3f3f4"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="margin-top:1.5rem;margin-bottom:1.5rem;border-left-color:#e53832;border-left-width:4px;border-top-style:none;border-top-width:0px;border-right-style:none;border-right-width:0px;border-bottom-style:none;border-bottom-width:0px;padding:1.25rem 1.5rem;background-color:#f3f3f4">
	<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} -->
	<p style="font-weight:700">📅 <?php echo esc_html__( 'Termin-Hinweis', 'foerderverein-pro' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph -->
	<p><?php echo esc_html__( 'Hier steht der Termin mit Datum, Uhrzeit und Ort.', 'foerderverein-pro' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
