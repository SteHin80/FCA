<?php
/**
 * Einzelner Beitrag.
 *
 * @package foerderverein
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
				<span class="fv-card__meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_category( ', ' ); ?></span>
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<nav class="fv-pagination">',
						'after'  => '</nav>',
					) );
					?>
				</div>

				<?php if ( get_the_tags() ) : ?>
					<p><?php the_tags( '', ', ' ); ?></p>
				<?php endif; ?>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
