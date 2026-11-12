<?php
/**
 * Template Name: Rechtliches (Impressum / Datenschutz)
 *
 * @package foerderverein-pro
 */

get_header();
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
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<nav class="fv-pagination">',
						'after'  => '</nav>',
					) );
					?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
</div>

<?php get_footer(); ?>
