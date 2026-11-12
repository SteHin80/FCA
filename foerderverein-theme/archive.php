<?php
/**
 * Archivansicht (Kategorien, Schlagwörter, Veranstaltungen).
 *
 * @package foerderverein
 */

get_header();
?>

<div class="fv-container fv-content fv-content--split">
	<main id="primary">
		<h1 class="entry-title"><?php echo esc_html( get_the_archive_title() ); ?></h1>

		<?php if ( get_the_archive_description() ) : ?>
			<div><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="fv-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'fv-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%;display:block;' ) ); ?></a>
						<?php endif; ?>
						<div class="fv-card__body">
							<span class="fv-card__meta"><?php echo esc_html( get_the_date() ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="fv-btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Weiterlesen', 'foerderverein' ); ?></a>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<nav class="fv-pagination">
				<?php
				the_posts_pagination( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			</nav>

		<?php else : ?>
			<p><?php esc_html_e( 'Keine Einträge gefunden.', 'foerderverein' ); ?></p>
		<?php endif; ?>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
