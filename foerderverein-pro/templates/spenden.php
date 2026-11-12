<?php
/**
 * Template Name: Spenden
 *
 * @package foerderverein-pro
 */

get_header();

$fv_email = foerderverein_pro_contact_email();
?>

<div class="fv-container fv-content">
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

		<section class="fv-section" style="padding-top:0">
			<div class="fv-grid">
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Geldspende', 'foerderverein-pro' ); ?></h3>
						<p style="white-space:pre-line"><?php echo esc_html( get_theme_mod( 'fv_donation_bank', __( "Förderverein e. V.\nIBAN: DE00 0000 0000 0000 0000 00\nBIC: XXXXXXXX\nVerwendungszweck: Spende", 'foerderverein-pro' ) ) ); ?></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Sachspende', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Bälle, Trikots, Getränke für die Kantine oder Arbeitsgeräte – sprechen Sie uns an, wir holen auch ab.', 'foerderverein-pro' ); ?></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Dauerhafte Förderung', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Mit einem Fördervertrag unterstützen Sie uns monatlich – als Privatperson oder Unternehmen. Wir beraten Sie gern.', 'foerderverein-pro' ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<section class="fv-cta">
			<h2><?php esc_html_e( 'Fragen zur Spende?', 'foerderverein-pro' ); ?></h2>
			<p><?php esc_html_e( 'Wir melden uns umgehend bei Ihnen zurück.', 'foerderverein-pro' ); ?></p>
			<a class="fv-btn" href="mailto:<?php echo esc_attr( antispambot( $fv_email ) ); ?>?subject=<?php echo rawurlencode( __( 'Spendenanfrage', 'foerderverein-pro' ) ); ?>"><?php esc_html_e( 'E-Mail schreiben', 'foerderverein-pro' ); ?></a>
		</section>
	</main>
</div>

<?php get_footer(); ?>
