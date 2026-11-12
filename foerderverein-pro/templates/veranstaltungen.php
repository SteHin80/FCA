<?php
/**
 * Template Name: Veranstaltungsübersicht
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
		$events = new WP_Query( array(
			'post_type'      => 'fv_event',
			'posts_per_page' => -1,
			'meta_key'       => '_fv_event_date',
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
		) );
		if ( $events->have_posts() ) :
			?>
			<div class="fv-grid">
				<?php
				while ( $events->have_posts() ) :
					$events->the_post();
					?>
					<article class="fv-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%;display:block;' ) ); ?></a>
						<?php endif; ?>
						<div class="fv-card__body">
							<span class="fv-card__meta"><?php echo esc_html( foerderverein_pro_event_date( get_the_ID() ) ); ?></span>
							<?php if ( foerderverein_pro_event_location( get_the_ID() ) ) : ?>
								<p style="margin:0 0 0.5rem;font-size:0.9rem;color:#5a6272">📍 <?php echo esc_html( foerderverein_pro_event_location( get_the_ID() ) ); ?></p>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="fv-btn fv-btn--primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Details', 'foerderverein-pro' ); ?></a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Aktuell sind keine Veranstaltungen geplant.', 'foerderverein-pro' ); ?></p>
		<?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>
