<?php
/**
 * Kommentarbereich.
 *
 * @package foerderverein-pro
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2>
			<?php
			printf(
				/* translators: %s: Anzahl der Kommentare. */
				esc_html( _n( '%s Kommentar', '%s Kommentare', get_comments_number(), 'foerderverein-pro' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'avatar_size' => 48,
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
		) );
	endif;

	if ( ! comments_open() && get_comments_number() ) :
		?>
		<p><?php esc_html_e( 'Die Kommentare sind geschlossen.', 'foerderverein-pro' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'  => __( 'Kommentar schreiben', 'foerderverein-pro' ),
		'label_submit' => __( 'Absenden', 'foerderverein-pro' ),
	) );
	?>
</div>
