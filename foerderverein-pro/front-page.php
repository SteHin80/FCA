<?php
/**
 * Startseite des Themes.
 *
 * @package foerderverein-pro
 */

get_header();

$fv_hero_image   = get_theme_mod( 'fv_hero_image', '' );
$fv_hero_class   = $fv_hero_image ? ' fv-hero--image' : '';
$fv_hero_style   = $fv_hero_image ? ' style="background-image:url(' . esc_url( $fv_hero_image ) . ')"' : '';
$fv_btn1_text    = get_theme_mod( 'fv_hero_btn1_text', __( 'Mitglied werden', 'foerderverein-pro' ) );
$fv_btn1_url     = get_theme_mod( 'fv_hero_btn1_url', '' );
$fv_btn2_text    = get_theme_mod( 'fv_hero_btn2_text', __( 'Jetzt spenden', 'foerderverein-pro' ) );
$fv_btn2_url     = get_theme_mod( 'fv_hero_btn2_url', '' );
$fv_default_link = home_url( '/#mitglied-werden' );
?>

<section class="fv-hero<?php echo esc_attr( $fv_hero_class ); ?>"<?php echo $fv_hero_style; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
	<div class="fv-container">
		<h1><?php echo esc_html( get_theme_mod( 'fv_hero_title', __( 'Gemeinsam für unseren Verein!', 'foerderverein-pro' ) ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'fv_hero_text', __( 'Wir unterstützen unseren Amateurfussballverein – mit Spenden, Aktionen und ehrenamtlichem Engagement. Werden Sie Teil der Förderfamilie.', 'foerderverein-pro' ) ) ); ?></p>
		<?php if ( $fv_btn1_text ) : ?>
			<a class="fv-btn" href="<?php echo esc_url( $fv_btn1_url ? $fv_btn1_url : $fv_default_link ); ?>"><?php echo esc_html( $fv_btn1_text ); ?></a>
		<?php endif; ?>
		<?php if ( $fv_btn2_text ) : ?>
			<a class="fv-btn fv-btn--ghost" href="<?php echo esc_url( $fv_btn2_url ? $fv_btn2_url : home_url( '/#spenden' ) ); ?>"><?php echo esc_html( $fv_btn2_text ); ?></a>
		<?php endif; ?>
	</div>
</section>

<section class="fv-section">
	<div class="fv-container">
		<div class="fv-stats">
			<div class="fv-stat">
				<div class="fv-stat__number">100 %</div>
				<div class="fv-stat__label"><?php esc_html_e( 'Ehrenamt', 'foerderverein-pro' ); ?></div>
			</div>
			<div class="fv-stat">
				<div class="fv-stat__number">€ € €</div>
				<div class="fv-stat__label"><?php esc_html_e( 'für Trainer, Bälle & Platzpflege', 'foerderverein-pro' ); ?></div>
			</div>
			<div class="fv-stat">
				<div class="fv-stat__number">11</div>
				<div class="fv-stat__label"><?php esc_html_e( 'Mannschaften im Rücken', 'foerderverein-pro' ); ?></div>
			</div>
			<div class="fv-stat">
				<div class="fv-stat__number">↑</div>
				<div class="fv-stat__label"><?php esc_html_e( 'Aufstieg bleibt unser Ziel', 'foerderverein-pro' ); ?></div>
			</div>
		</div>
	</div>
</section>

<section class="fv-section fv-section--grey">
	<div class="fv-container">
		<h2 class="fv-section__title"><?php esc_html_e( 'Aktuelle News', 'foerderverein-pro' ); ?></h2>
		<p class="fv-section__sub"><?php esc_html_e( 'Neuigkeiten aus dem Verein und von uns.', 'foerderverein-pro' ); ?></p>

		<div class="fv-grid">
			<?php
			$news = new WP_Query( array(
				'post_type'           => 'post',
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
			) );
			if ( $news->have_posts() ) :
				while ( $news->have_posts() ) :
					$news->the_post();
					?>
					<article class="fv-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%;display:block;' ) ); ?></a>
						<?php endif; ?>
						<div class="fv-card__body">
							<span class="fv-card__meta"><?php echo esc_html( get_the_date() ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
							<a class="fv-btn fv-btn--primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Weiterlesen', 'foerderverein-pro' ); ?></a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<p><?php esc_html_e( 'Noch keine Beiträge veröffentlicht.', 'foerderverein-pro' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="fv-section">
	<div class="fv-container">
		<h2 class="fv-section__title"><?php esc_html_e( 'Nächste Veranstaltungen', 'foerderverein-pro' ); ?></h2>
		<p class="fv-section__sub"><?php esc_html_e( 'Grillabende, Turniere, Arbeitseinsätze – hier sind wir dabei.', 'foerderverein-pro' ); ?></p>

		<div class="fv-grid">
			<?php
			$events = new WP_Query( array(
				'post_type'      => 'fv_event',
				'posts_per_page' => 3,
				'meta_key'       => '_fv_event_date',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
			) );
			if ( $events->have_posts() ) :
				while ( $events->have_posts() ) :
					$events->the_post();
					?>
					<article class="fv-card">
						<div class="fv-card__body">
							<span class="fv-card__meta"><?php echo esc_html( foerderverein_pro_event_date( get_the_ID() ) ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<p><?php esc_html_e( 'Aktuell sind keine Veranstaltungen geplant.', 'foerderverein-pro' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="fv-cta" id="mitglied-werden">
	<h2><?php esc_html_e( 'Mitglied im Förderverein werden', 'foerderverein-pro' ); ?></h2>
	<p><?php esc_html_e( 'Mit Ihrem Beitrag finanzieren wir Trainingsmaterial, Trikots und die Jugendarbeit. Schreiben Sie uns – wir melden uns umgehend.', 'foerderverein-pro' ); ?></p>
	<a class="fv-btn" href="mailto:<?php echo esc_attr( antispambot( foerderverein_pro_contact_email() ) ); ?>?subject=<?php echo rawurlencode( __( 'Mitgliedsantrag', 'foerderverein-pro' ) ); ?>"><?php esc_html_e( 'Mitgliedsantrag anfordern', 'foerderverein-pro' ); ?></a>
</section>

<section class="fv-section" id="spenden">
	<div class="fv-container">
		<h2 class="fv-section__title"><?php esc_html_e( 'Spenden', 'foerderverein-pro' ); ?></h2>
		<p class="fv-section__sub"><?php esc_html_e( 'Jeder Betrag kommt direkt dem Verein zugute – ob Geldspende oder Sachspende.', 'foerderverein-pro' ); ?></p>
		<div class="fv-grid">
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'Bankverbindung', 'foerderverein-pro' ); ?></h3>
					<p style="white-space:pre-line"><?php echo esc_html( get_theme_mod( 'fv_donation_bank', __( "Förderverein e. V.\nIBAN: DE00 0000 0000 0000 0000 00\nBIC: XXXXXXXX\nVerwendungszweck: Spende", 'foerderverein-pro' ) ) ); ?></p>
				</div>
			</div>
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'Sachspenden', 'foerderverein-pro' ); ?></h3>
					<p><?php esc_html_e( 'Bälle, Trikots, Getränke für die Kantine oder Arbeitsgeräte – sprechen Sie uns an, wir holen auch ab.', 'foerderverein-pro' ); ?></p>
				</div>
			</div>
			<div class="fv-card">
				<div class="fv-card__body">
					<h3><?php esc_html_e( 'Kontakt', 'foerderverein-pro' ); ?></h3>
					<p><?php esc_html_e( 'Sie haben Fragen zu Spenden oder Mitgliedschaft? Schreiben Sie uns eine E-Mail – wir helfen gern.', 'foerderverein-pro' ); ?></p>
					<a class="fv-btn fv-btn--primary" href="mailto:<?php echo esc_attr( antispambot( foerderverein_pro_contact_email() ) ); ?>"><?php esc_html_e( 'E-Mail schreiben', 'foerderverein-pro' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
$sponsors = new WP_Query( array(
	'post_type'      => 'fv_sponsor',
	'posts_per_page' => 20,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
if ( $sponsors->have_posts() ) :
	?>
	<section class="fv-section fv-section--grey">
		<div class="fv-container">
			<h2 class="fv-section__title"><?php esc_html_e( 'Unsere Sponsoren', 'foerderverein-pro' ); ?></h2>
			<p class="fv-section__sub"><?php esc_html_e( 'Danke an alle Unterstützer unseres Vereins!', 'foerderverein-pro' ); ?></p>
			<div class="fv-sponsors">
				<?php
				while ( $sponsors->have_posts() ) :
					$sponsors->the_post();
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) );
					} else {
						echo '<strong>' . esc_html( get_the_title() ) . '</strong>';
					}
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
