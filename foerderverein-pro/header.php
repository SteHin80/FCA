<?php
/**
 * Header des Themes.
 *
 * @package foerderverein-pro
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

<?php
$fv_topbar_text = get_theme_mod( 'fv_topbar_text', '' );
$fv_address     = get_theme_mod( 'fv_contact_address', '' );
$fv_phone       = get_theme_mod( 'fv_contact_phone', '' );
$fv_email       = foerderverein_pro_contact_email();
?>
<?php if ( $fv_topbar_text || $fv_phone || $fv_email ) : ?>
	<div class="fv-topbar">
		<div class="fv-container fv-topbar__inner">
			<div class="fv-topbar__items">
				<?php if ( $fv_topbar_text ) : ?>
					<span><?php echo esc_html( $fv_topbar_text ); ?></span>
				<?php endif; ?>
				<?php if ( $fv_phone ) : ?>
					<span>📞 <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $fv_phone ) ); ?>"><?php echo esc_html( $fv_phone ); ?></a></span>
				<?php endif; ?>
				<?php if ( $fv_email ) : ?>
					<span>✉ <a href="mailto:<?php echo esc_attr( antispambot( $fv_email ) ); ?>"><?php echo esc_html( antispambot( $fv_email ) ); ?></a></span>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

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

		<nav class="fv-nav" aria-label="<?php esc_attr_e( 'Hauptmenü', 'foerderverein-pro' ); ?>">
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

		<?php
		$fv_cta_text = get_theme_mod( 'fv_cta_text', __( 'Mitglied werden', 'foerderverein-pro' ) );
		$fv_cta_url  = get_theme_mod( 'fv_cta_url', '' );
		if ( $fv_cta_text && $fv_cta_url ) :
			?>
			<a class="fv-btn fv-header__cta" href="<?php echo esc_url( $fv_cta_url ); ?>"><?php echo esc_html( $fv_cta_text ); ?></a>
		<?php endif; ?>
	</div>

	<?php if ( is_active_sidebar( 'header-widgets' ) ) : ?>
		<div class="fv-container fv-header-widgets">
			<?php dynamic_sidebar( 'header-widgets' ); ?>
		</div>
	<?php endif; ?>
</header>
