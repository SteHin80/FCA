<?php
/**
 * Template Name: Übersicht: Unterseiten
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

		<?php
		$children = new WP_Query( array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_parent'    => get_the_ID(),
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		) );
		if ( $children->have_posts() ) :
			?>
			<div class="fv-grid">
				<?php
				while ( $children->have_posts() ) :
					$children->the_post();
					?>
					<article class="fv-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%;display:block;' ) ); ?></a>
						<?php endif; ?>
						<div class="fv-card__body">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="fv-btn fv-btn--primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Mehr erfahren', 'foerderverein-pro' ); ?></a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Diese Seite hat noch keine Unterseiten. Lege im Seiten-Menü neue Seiten an und wähle diese Seite als übergeordnete Seite.', 'foerderverein-pro' ); ?></p>
		<?php endif; ?>
	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
