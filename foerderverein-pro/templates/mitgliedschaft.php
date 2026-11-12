<?php
/**
 * Template Name: Mitgliedschaft (Mitglied werden)
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
						<h3><?php esc_html_e( 'Fördermitglied', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Regelmäßiger Beitrag, freie Höhe. Sie unterstützen Trainer, Material und Jugendarbeit – ohne aktive Pflichten.', 'foerderverein-pro' ); ?></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Aktives Mitglied', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Sie helfen bei Aktionen, Festen und Arbeitseinsätzen mit – ideal für alle, die anpacken wollen.', 'foerderverein-pro' ); ?></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Firmen-Mitgliedschaft', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Für Unternehmen: Beitrag plus Präsenz auf unserer Website und bei Vereinsaktionen als Dank.', 'foerderverein-pro' ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<section class="fv-cta">
			<h2><?php esc_html_e( 'Beitritt erklären', 'foerderverein-pro' ); ?></h2>
			<p><?php esc_html_e( 'Schreiben Sie uns eine E-Mail mit Ihrem Namen – wir senden Ihnen den Mitgliedsantrag und alle Informationen zu.', 'foerderverein-pro' ); ?></p>
			<a class="fv-btn" href="mailto:<?php echo esc_attr( antispambot( $fv_email ) ); ?>?subject=<?php echo rawurlencode( __( 'Mitgliedsantrag', 'foerderverein-pro' ) ); ?>"><?php esc_html_e( 'Mitgliedsantrag anfordern', 'foerderverein-pro' ); ?></a>
		</section>
	</main>
</div>

<?php get_footer(); ?>
