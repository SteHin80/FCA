<?php
/**
 * Header des Themes.
 *
 * @package foerderverein
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="fv-header">
	<div class="fv-container fv-header__inner">
		<div class="fv-logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php endif; ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php bloginfo( 'name' ); ?>
				<span class="fv-logo__tag"><?php bloginfo( 'description' ); ?></span>
			</a>
		</div>

		<nav class="fv-nav" aria-label="<?php esc_attr_e( 'Hauptmenü', 'foerderverein' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
				) );
			} else {
				wp_list_pages( array( 'title_li' => '' ) );
			}
			?>
		</nav>
	</div>
</header>
