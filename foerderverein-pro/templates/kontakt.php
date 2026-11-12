<?php
/**
 * Template Name: Kontaktseite
 *
 * @package foerderverein-pro
 */

get_header();

$fv_address = get_theme_mod( 'fv_contact_address', '' );
$fv_phone   = get_theme_mod( 'fv_contact_phone', '' );
$fv_email   = foerderverein_pro_contact_email();
?>

<div class="fv-container fv-content fv-content--split">
	<main id="primary">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<div class="fv-grid">
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'Anschrift', 'foerderverein-pro' ); ?></h3>
					<p style="white-space:pre-line"><?php echo esc_html( $fv_address ? $fv_address : __( 'Bitte im Customizer unter „Kontaktdaten" eintragen.', 'foerderverein-pro' ) ); ?></p>
				</div>
			</div>
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'Telefon', 'foerderverein-pro' ); ?></h3>
					<p>
						<?php if ( $fv_phone ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $fv_phone ) ); ?>"><?php echo esc_html( $fv_phone ); ?></a>
						<?php else : ?>
							<?php esc_html_e( 'Bitte im Customizer unter „Kontaktdaten" eintragen.', 'foerderverein-pro' ); ?>
						<?php endif; ?>
					</p>
				</div>
			</div>
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'E-Mail', 'foerderverein-pro' ); ?></h3>
					<p><a href="mailto:<?php echo esc_attr( antispambot( $fv_email ) ); ?>"><?php echo esc_html( antispambot( $fv_email ) ); ?></a></p>
				</div>
			</div>
		</div>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
