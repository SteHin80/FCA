<?php
/**
 * Template Name: FAQ (Häufige Fragen)
 *
 * Fragen als Überschrift (H3) schreiben, die Antwort als Absatz darunter.
 * Erzeugt automatisch FAQPage-Structured-Data für Google und KI-Suche.
 *
 * @package foerderverein-pro
 */

get_header();

$faq_items = array();
$question  = '';
$answers   = array();

if ( have_posts() ) {
	the_post();
	$blocks = parse_blocks( get_the_content() );

	foreach ( $blocks as $block ) {
		if ( 'core/heading' === $block['blockName'] && isset( $block['attrs']['level'] ) && 3 === (int) $block['attrs']['level'] ) {
			if ( $question && $answers ) {
				$faq_items[] = array( 'q' => $question, 'a' => implode( ' ', $answers ) );
			}
			$question = wp_strip_all_tags( render_block( $block ) );
			$answers  = array();
		} elseif ( 'core/paragraph' === $block['blockName'] && $question ) {
			$answers[] = wp_strip_all_tags( render_block( $block ) );
		}
	}
	if ( $question && $answers ) {
		$faq_items[] = array( 'q' => $question, 'a' => implode( ' ', $answers ) );
	}
 rewind_posts();
}
?>

<div class="fv-container fv-content">
	<main id="primary">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php if ( $faq_items ) : ?>
				<div class="entry-content fv-faq">
					<?php foreach ( $faq_items as $item ) : ?>
						<div class="fv-faq-item">
							<h3><?php echo esc_html( $item['q'] ); ?></h3>
							<p><?php echo esc_html( $item['a'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php endif; ?>
		</article>
	</main>
</div>

<?php if ( $faq_items ) : ?>
	<script type="application/ld+json">
	<?php
	echo wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array_map( function ( $item ) {
			return array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['a'],
				),
			);
		}, $faq_items ),
	), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	?>
	</script>
<?php endif; ?>

<?php get_footer(); ?>
