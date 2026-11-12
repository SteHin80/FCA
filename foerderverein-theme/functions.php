<?php
/**
 * Foerderverein Fussball Theme: Funktionen.
 *
 * @package foerderverein
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FOERDERVEREIN_VERSION', '1.0.0' );

/**
 * Theme-Grundfunktionen.
 */
function foerderverein_setup() {
	load_theme_textdomain( 'foerderverein', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 96,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Hauptmenü', 'foerderverein' ),
		'footer'  => __( 'Footer-Menü', 'foerderverein' ),
	) );
}
add_action( 'after_setup_theme', 'foerderverein_setup' );

/**
 * Styles und Scripts laden.
 */
function foerderverein_scripts() {
	wp_enqueue_style( 'foerderverein-style', get_stylesheet_uri(), array(), FOERDERVEREIN_VERSION );
}
add_action( 'wp_enqueue_scripts', 'foerderverein_scripts' );

/**
 * Widget-Bereiche.
 */
function foerderverein_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Seitenleiste', 'foerderverein' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Seitenleiste für Beiträge und Seiten.', 'foerderverein' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'foerderverein' ),
		'id'            => 'footer-1',
		'description'   => __( 'Widget-Bereich im Footer.', 'foerderverein' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'foerderverein_widgets_init' );

/**
 * Eigene Beitragsformate für den Verein.
 */
function foerderverein_register_post_types() {
	register_post_type( 'fv_event', array(
		'labels' => array(
			'name'          => __( 'Veranstaltungen', 'foerderverein' ),
			'singular_name' => __( 'Veranstaltung', 'foerderverein' ),
			'add_new_item'  => __( 'Veranstaltung hinzufügen', 'foerderverein' ),
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
			'name'          => __( 'Sponsoren', 'foerderverein' ),
			'singular_name' => __( 'Sponsor', 'foerderverein' ),
			'add_new_item'  => __( 'Sponsor hinzufügen', 'foerderverein' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-awards',
		'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'foerderverein_register_post_types' );

/**
 * Zusatzfeld: Datum einer Veranstaltung (Meta-Box).
 */
function foerderverein_event_metabox() {
	add_meta_box(
		'fv_event_date',
		__( 'Datum & Uhrzeit', 'foerderverein' ),
		'foerderverein_event_metabox_html',
		'fv_event',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'foerderverein_event_metabox' );

/**
 * HTML der Meta-Box.
 *
 * @param WP_Post $post Aktiver Beitrag.
 */
function foerderverein_event_metabox_html( $post ) {
	wp_nonce_field( 'fv_event_date_save', 'fv_event_date_nonce' );
	$value = get_post_meta( $post->ID, '_fv_event_date', true );
	echo '<input type="datetime-local" style="width:100%" name="fv_event_date" value="' . esc_attr( $value ) . '" />';
}

/**
 * Meta-Box speichern.
 *
 * @param int $post_id Beitrag-ID.
 */
function foerderverein_event_metabox_save( $post_id ) {
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
add_action( 'save_post_fv_event', 'foerderverein_event_metabox_save' );

/**
 * Lesbares Datum für Veranstaltungen.
 *
 * @param int $post_id Beitrag-ID.
 * @return string Formatiertes Datum oder leer.
 */
function foerderverein_event_date( $post_id ) {
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
 * Customizer-Einstellungen für Startseite und Spendeninfo.
 *
 * @param WP_Customize_Manager $wp_customize Customizer-Instanz.
 */
function foerderverein_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'fv_startseite', array(
		'title'    => __( 'Förderverein: Startseite', 'foerderverein' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'fv_hero_title', array(
		'default'           => __( 'Gemeinsam für unseren Verein!', 'foerderverein' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'fv_hero_title', array(
		'label'   => __( 'Hero-Titel', 'foerderverein' ),
		'section' => 'fv_startseite',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'fv_hero_text', array(
		'default'           => __( 'Wir unterstützen unseren Amateurfussballverein – mit Spenden, Aktionen und ehrenamtlichem Engagement. Werden Sie Teil der Förderfamilie.', 'foerderverein' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_hero_text', array(
		'label'   => __( 'Hero-Text', 'foerderverein' ),
		'section' => 'fv_startseite',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'fv_donation_bank', array(
		'default'           => __( "Förderverein e. V.\nIBAN: DE00 0000 0000 0000 0000 00\nBIC: XXXXXXXX\nVerwendungszweck: Spende", 'foerderverein' ),
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'fv_donation_bank', array(
		'label'       => __( 'Bankverbindung (Spenden)', 'foerderverein' ),
		'description' => __( 'Zeilen: Verein, IBAN, BIC, Verwendungszweck.', 'foerderverein' ),
		'section'     => 'fv_startseite',
		'type'        => 'textarea',
	) );
}
add_action( 'customize_register', 'foerderverein_customize_register' );

/**
 * Excerpt-Länge und -Endung anpassen.
 */
function foerderverein_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'foerderverein_excerpt_length' );

function foerderverein_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'foerderverein_excerpt_more' );
