<?php
/**
 * Template Name: Sponsoren
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
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php
		$sponsors = new WP_Query( array(
			'post_type'      => 'fv_sponsor',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		) );
		if ( $sponsors->have_posts() ) :
			?>
			<div class="fv-grid">
				<?php
				while ( $sponsors->have_posts() ) :
					$sponsors->the_post();
					?>
					<article class="fv-card">
						<div class="fv-card__body" style="text-align:center">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'style' => 'max-height:120px;width:auto;margin:0 auto 1rem;display:block;' ) );
							}
							?>
							<h3><?php the_title(); ?></h3>
							<?php if ( get_the_content() ) : ?>
								<div><?php the_content(); ?></div>
							<?php endif; ?>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Noch keine Sponsoren eingetragen. Sponsoren legst du im Dashboard unter „Sponsoren" an.', 'foerderverein-pro' ); ?></p>
		<?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>
