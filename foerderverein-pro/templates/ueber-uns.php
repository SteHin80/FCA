<?php
/**
 * Template Name: Über uns / Vorstand
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

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<section class="fv-section fv-section--grey" style="margin-top:2rem">
			<h2 class="fv-section__title"><?php esc_html_e( 'So erreichen Sie uns', 'foerderverein-pro' ); ?></h2>
			<div class="fv-grid">
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'E-Mail', 'foerderverein-pro' ); ?></h3>
						<p><a href="mailto:<?php echo esc_attr( antispambot( $fv_email ) ); ?>"><?php echo esc_html( antispambot( $fv_email ) ); ?></a></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Telefon', 'foerderverein-pro' ); ?></h3>
						<p><?php echo esc_html( get_theme_mod( 'fv_contact_phone', __( 'Bitte im Customizer eintragen.', 'foerderverein-pro' ) ) ); ?></p>
					</div>
				</div>
				<div class="fv-card">
					<div class="fv-card__body">
						<h3><?php esc_html_e( 'Mitmachen', 'foerderverein-pro' ); ?></h3>
						<p><?php esc_html_e( 'Wir suchen immer engagierte Unterstützer – ob als Fördermitglied oder beim Arbeitseinsatz.', 'foerderverein-pro' ); ?></p>
						<a class="fv-btn fv-btn--primary" href="<?php echo esc_url( home_url( '/#mitglied-werden' ) ); ?>"><?php esc_html_e( 'Mitglied werden', 'foerderverein-pro' ); ?></a>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>
