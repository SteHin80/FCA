<?php
/**
 * Template Name: Formularseite (Kontakt- / Antragsformular)
 *
 * Für Kontakt-, Mitgliedschafts- oder Spendenformulare per Plugin
 * (z. B. Contact Form 7, WPForms). Der Formular-Bereich wird unter
 * Design → Widgets → „Kontaktformular-Bereich" befüllt – oder der
 * Plugin-Shortcode wird direkt in den Seiteninhalt eingefügt.
 *
 * @package foerderverein-pro
 */

get_header();
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

		<?php if ( is_active_sidebar( 'contact-form' ) ) : ?>
			<div class="fv-form-area">
				<?php dynamic_sidebar( 'contact-form' ); ?>
			</div>
		<?php else : ?>
			<div class="fv-form-area">
				<p><strong><?php esc_html_e( 'Formular-Bereich', 'foerderverein-pro' ); ?></strong><br />
				<?php esc_html_e( 'Füge hier dein Formular ein: entweder den Shortcode des Formular-Plugins direkt in den Seiteninhalt oben, oder das Formular-Widget unter Design → Widgets → „Kontaktformular-Bereich".', 'foerderverein-pro' ); ?></p>
			</div>
		<?php endif; ?>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
