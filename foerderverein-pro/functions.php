<?php
/**
 * Foerderverein Pro Theme: Funktionen.
 *
 * @package foerderverein-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FOERDERVEREIN_PRO_VERSION', '1.0.0' );

/**
 * Theme-Grundfunktionen.
 */
function foerderverein_pro_setup() {
	load_theme_textdomain( 'foerderverein-pro', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Hauptmenü', 'foerderverein-pro' ),
		'footer'  => __( 'Footer-Menü', 'foerderverein-pro' ),
	) );
}
add_action( 'after_setup_theme', 'foerderverein_pro_setup' );

/**
 * Styles laden.
 */
function foerderverein_pro_scripts() {
	wp_enqueue_style( 'foerderverein-pro-style', get_stylesheet_uri(), array(), FOERDERVEREIN_PRO_VERSION );
}
add_action( 'wp_enqueue_scripts', 'foerderverein_pro_scripts' );

/**
 * Widget-Bereiche: Header, Seitenleiste und drei Footer-Spalten.
 */
function foerderverein_pro_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Kopfzeile (unter dem Menü)', 'foerderverein-pro' ),
		'id'            => 'header-widgets',
		'description'   => __( 'Widgets unter dem Header-Menü, z. B. Kontaktinfos oder Hinweise.', 'foerderverein-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Seitenleiste', 'foerderverein-pro' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Seitenleiste für Beiträge und Seiten mit Vorlage „Seite mit Seitenleiste".', 'foerderverein-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array(
			/* translators: %d: Nummer der Footer-Spalte. */
			'name'          => sprintf( __( 'Footer Spalte %d', 'foerderverein-pro' ), $i ),
			'id'            => 'footer-' . $i,
			'description'   => __( 'Widget-Bereich im Footer.', 'foerderverein-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'foerderverein_pro_widgets_init' );

/**
 * Eigene Inhaltstypen.
 */
function foerderverein_pro_register_post_types() {
	register_post_type( 'fv_event', array(
		'labels' => array(
			'name'          => __( 'Veranstaltungen', 'foerderverein-pro' ),
			'singular_name' => __( 'Veranstaltung', 'foerderverein-pro' ),
			'add_new_item'  => __( 'Veranstaltung hinzufügen', 'foerderverein-pro' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-calendar-alt',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite'      => array( 'slug' => 'veranstaltungen' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'fv_sponsor', array(
		'labels' => array(
			'name'          => __( 'Sponsoren', 'foerderverein-pro' ),
			'singular_name' => __( 'Sponsor', 'foerderverein-pro' ),
			'add_new_item'  => __( 'Sponsor hinzufügen', 'foerderverein-pro' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-awards',
		'supports'     => array( 'title', 'thumbnail', 'page-attributes', 'editor' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'foerderverein_pro_register_post_types' );

/**
 * Meta-Box: Datum einer Veranstaltung.
 */
function foerderverein_pro_event_metabox() {
	add_meta_box(
		'fv_event_date',
		__( 'Datum & Uhrzeit', 'foerderverein-pro' ),
		'foerderverein_pro_event_metabox_html',
		'fv_event',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'foerderverein_pro_event_metabox' );

/**
 * HTML der Meta-Box.
 *
 * @param WP_Post $post Aktiver Beitrag.
 */
function foerderverein_pro_event_metabox_html( $post ) {
	wp_nonce_field( 'fv_event_date_save', 'fv_event_date_nonce' );
	$value = get_post_meta( $post->ID, '_fv_event_date', true );
	echo '<input type="datetime-local" style="width:100%" name="fv_event_date" value="' . esc_attr( $value ) . '" />';
}

/**
 * Meta-Box speichern.
 *
 * @param int $post_id Beitrag-ID.
 */
function foerderverein_pro_event_metabox_save( $post_id ) {
	if ( ! isset( $_POST['fv_event_date_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['fv_event_date_nonce'] ), 'fv_event_date_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['fv_event_date'] ) ) {
		update_post_meta( $post_id, '_fv_event_date', sanitize_text_field( wp_unslash( $_POST['fv_event_date'] ) ) );
	}
}
add_action( 'save_post_fv_event', 'foerderverein_pro_event_metabox_save' );

/**
 * Lesbares Datum für Veranstaltungen.
 *
 * @param int $post_id Beitrag-ID.
 * @return string Formatiertes Datum oder leer.
 */
function foerderverein_pro_event_date( $post_id ) {
	$raw = get_post_meta( $post_id, '_fv_event_date', true );
	if ( ! $raw ) {
		return '';
	}
	$timestamp = strtotime( $raw );
	if ( false === $timestamp ) {
		return '';
	}
	return date_i18n( get_option( 'date_format' ) . ' \u\m H:i \U\h\r', $timestamp );
}

/**
 * Customizer: Header, Footer, Hero, Kontakt und Spenden.
 *
 * @param WP_Customize_Manager $wp_customize Customizer-Instanz.
 */
function foerderverein_pro_customize_register( $wp_customize ) {
	/* --- Kopfzeile --- */
	$wp_customize->add_section( 'fv_header', array(
		'title'    => __( 'Kopfzeile & Header', 'foerderverein-pro' ),
		'priority' => 25,
	) );

	$wp_customize->add_setting( 'fv_topbar_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_topbar_text', array(
		'label'       => __( 'Hinweis in der oberen Leiste', 'foerderverein-pro' ),
		'description' => __( 'Z. B. „Nächstes Heimspiel: Sonntag, 15 Uhr". Leer lassen zum Ausblenden.', 'foerderverein-pro' ),
		'section'     => 'fv_header',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'fv_cta_text', array(
		'default'           => __( 'Mitglied werden', 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_cta_text', array(
		'label'   => __( 'Button-Text im Header', 'foerderverein-pro' ),
		'section' => 'fv_header',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'fv_cta_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'fv_cta_url', array(
		'label'       => __( 'Button-Link im Header', 'foerderverein-pro' ),
		'description' => __( 'Z. B. die URL der Seite mit der Vorlage „Mitgliedschaft".', 'foerderverein-pro' ),
		'section'     => 'fv_header',
		'type'        => 'url',
	) );

	/* --- Hero --- */
	$wp_customize->add_section( 'fv_hero', array(
		'title'    => __( 'Startseite: Hero', 'foerderverein-pro' ),
		'priority' => 26,
	) );

	$wp_customize->add_setting( 'fv_hero_title', array(
		'default'           => __( 'Gemeinsam für unseren Verein!', 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_hero_title', array(
		'label'   => __( 'Titel', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'fv_hero_text', array(
		'default'           => __( 'Wir unterstützen unseren Amateurfussballverein – mit Spenden, Aktionen und ehrenamtlichem Engagement. Werden Sie Teil der Förderfamilie.', 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_hero_text', array(
		'label'   => __( 'Text', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'fv_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fv_hero_image', array(
		'label'       => __( 'Hintergrundbild (optional)', 'foerderverein-pro' ),
		'description' => __( 'Z. B. ein Mannschaftsfoto. Wird mit dunkler Fläche überlagert.', 'foerderverein-pro' ),
		'section'     => 'fv_hero',
	) ) );

	$wp_customize->add_setting( 'fv_hero_btn1_text', array(
		'default'           => __( 'Mitglied werden', 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'fv_hero_btn1_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_setting( 'fv_hero_btn2_text', array(
		'default'           => __( 'Jetzt spenden', 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'fv_hero_btn2_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'fv_hero_btn1_text', array(
		'label'   => __( 'Button 1 – Text', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'fv_hero_btn1_url', array(
		'label'   => __( 'Button 1 – Link', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'url',
	) );
	$wp_customize->add_control( 'fv_hero_btn2_text', array(
		'label'   => __( 'Button 2 – Text', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'text',
	) );
	$wp_customize->add_control( 'fv_hero_btn2_url', array(
		'label'   => __( 'Button 2 – Link', 'foerderverein-pro' ),
		'section' => 'fv_hero',
		'type'    => 'url',
	) );

	/* --- Kontakt --- */
	$wp_customize->add_section( 'fv_kontakt', array(
		'title'    => __( 'Kontaktdaten', 'foerderverein-pro' ),
		'priority' => 27,
	) );

	$wp_customize->add_setting( 'fv_contact_address', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_contact_address', array(
		'label'   => __( 'Anschrift', 'foerderverein-pro' ),
		'section' => 'fv_kontakt',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'fv_contact_phone', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_contact_phone', array(
		'label'   => __( 'Telefon', 'foerderverein-pro' ),
		'section' => 'fv_kontakt',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'fv_contact_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'fv_contact_email', array(
		'label'   => __( 'E-Mail', 'foerderverein-pro' ),
		'section' => 'fv_kontakt',
		'type'    => 'email',
	) );

	/* --- Spenden --- */
	$wp_customize->add_section( 'fv_spenden', array(
		'title'    => __( 'Spenden', 'foerderverein-pro' ),
		'priority' => 28,
	) );

	$wp_customize->add_setting( 'fv_donation_bank', array(
		'default'           => __( "Förderverein e. V.\nIBAN: DE00 0000 0000 0000 0000 00\nBIC: XXXXXXXX\nVerwendungszweck: Spende", 'foerderverein-pro' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_donation_bank', array(
		'label'       => __( 'Bankverbindung', 'foerderverein-pro' ),
		'description' => __( 'Zeilen: Verein, IBAN, BIC, Verwendungszweck.', 'foerderverein-pro' ),
		'section'     => 'fv_spenden',
		'type'        => 'textarea',
	) );

	/* --- Footer --- */
	$wp_customize->add_section( 'fv_footer', array(
		'title'    => __( 'Footer', 'foerderverein-pro' ),
		'priority' => 29,
	) );

	$wp_customize->add_setting( 'fv_footer_about', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_footer_about', array(
		'label'       => __( 'Über-uns-Text (erste Spalte)', 'foerderverein-pro' ),
		'description' => __( 'Wird über den Footer-Widgets angezeigt. Die drei Footer-Spalten befüllst du unter Design → Widgets.', 'foerderverein-pro' ),
		'section'     => 'fv_footer',
		'type'        => 'textarea',
	) );

	$wp_customize->add_setting( 'fv_footer_copyright', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_footer_copyright', array(
		'label'       => __( 'Copyright-Zeile', 'foerderverein-pro' ),
		'description' => __( 'Leer lassen für „© Jahr Website-Titel".', 'foerderverein-pro' ),
		'section'     => 'fv_footer',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'foerderverein_pro_customize_register' );

/**
 * Kontakt-E-Mail mit Fallback auf die Admin-E-Mail.
 *
 * @return string E-Mail-Adresse.
 */
function foerderverein_pro_contact_email() {
	$email = get_theme_mod( 'fv_contact_email', '' );
	return $email ? $email : get_option( 'admin_email' );
}

/**
 * Excerpt anpassen.
 */
function foerderverein_pro_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'foerderverein_pro_excerpt_length' );

function foerderverein_pro_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'foerderverein_pro_excerpt_more' );
