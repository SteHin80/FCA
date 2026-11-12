<?php
/**
 * Suchformular.
 *
 * @package foerderverein-pro
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Suchen nach:', 'foerderverein-pro' ); ?></span>
		<input type="search" name="s" placeholder="<?php esc_attr_e( 'Suchen …', 'foerderverein-pro' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
	</label>
	<button type="submit" class="fv-btn fv-btn--primary"><?php esc_html_e( 'Suchen', 'foerderverein-pro' ); ?></button>
</form>
