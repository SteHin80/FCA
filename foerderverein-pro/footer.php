<?php
/**
 * Footer des Themes.
 *
 * @package foerderverein-pro
 */

$fv_footer_about = get_theme_mod( 'fv_footer_about', '' );
$fv_copyright    = get_theme_mod( 'fv_footer_copyright', '' );
?>
<footer class="fv-footer">
	<div class="fv-container">
		<div class="fv-footer__grid">
			<?php if ( $fv_footer_about || is_active_sidebar( 'footer-1' ) ) : ?>
				<div>
					<h2 class="widget-title"><?php bloginfo( 'name' ); ?></h2>
					<?php if ( $fv_footer_about ) : ?>
						<p class="fv-footer__about"><?php echo nl2br( esc_html( $fv_footer_about ) ); ?></p>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div><?php dynamic_sidebar( 'footer-2' ); ?></div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div><?php dynamic_sidebar( 'footer-3' ); ?></div>
			<?php endif; ?>
		</div>

		<div class="fv-footer__bottom">
			<p>
				<?php
				if ( $fv_copyright ) {
					echo esc_html( $fv_copyright );
				} else {
					echo esc_html( sprintf( '© %s %s', gmdate( 'Y' ), get_bloginfo( 'name' ) ) );
				}
				?>
			</p>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container_class' => 'fv-nav',
					'depth'          => 1,
				) );
			}
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
