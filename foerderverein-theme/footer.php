<?php
/**
 * Footer des Themes.
 *
 * @package foerderverein
 */
?>
<footer class="fv-footer">
	<div class="fv-container">
		<div class="fv-footer__grid">
			<div>
				<h2 class="widget-title"><?php bloginfo( 'name' ); ?></h2>
				<p><?php bloginfo( 'description' ); ?></p>
			</div>
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php endif; ?>
		</div>

		<div class="fv-footer__bottom">
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'depth'          => 1,
					'menu_class'     => 'fv-nav',
				) );
			}
			?>
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
