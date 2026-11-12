<?php
/**
 * Standard-Listenansicht (Blog / Archiv).
 *
 * @package foerderverein
 */

get_header();
?>

<div class="fv-container fv-content fv-content--split">
	<main id="primary">
		<?php if ( have_posts() ) : ?>

			<?php
			if ( is_home() && ! is_front_page() ) {
				echo '<h1 class="entry-title">' . esc_html( single_post_title( '', false ) ) . '</h1>';
			} elseif ( is_archive() ) {
				echo '<h1 class="entry-title">' . esc_html( get_the_archive_title() ) . '</h1>';
			} elseif ( is_search() ) {
				echo '<h1 class="entry-title">' . esc_html( sprintf( __( 'Suchergebnisse für: %s', 'foerderverein' ), get_search_query() ) ) . '</h1>';
			}
			?>

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

			<nav class="fv-pagination" aria-label="<?php esc_attr_e( 'Beitragsnavigation', 'foerderverein' ); ?>">
				<?php
				the_posts_pagination( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) );
				?>
			</nav>

		<?php else : ?>
			<h1><?php esc_html_e( 'Nichts gefunden', 'foerderverein' ); ?></h1>
			<p><?php esc_html_e( 'Es wurden keine passenden Inhalte gefunden. Versuche es gerne mit der Suche.', 'foerderverein' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
