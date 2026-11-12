<?php
/**
 * SEO- und KI-Suche-Funktionen (Meta-Tags, Open Graph, JSON-LD, llms.txt).
 *
 * Wird nur aktiv, wenn kein SEO-Plugin die Ausgaben übernimmt,
 * damit Tags nicht doppelt ausgegeben werden.
 *
 * @package foerderverein-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prüft, ob ein SEO-Plugin aktiv ist.
 *
 * @return bool True, wenn ein bekanntes SEO-Plugin aktiv ist.
 */
function foerderverein_pro_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )              // Yoast SEO.
		|| class_exists( 'RankMath' )              // Rank Math.
		|| defined( 'SEOPRESS_VERSION' )           // SEOPress.
		|| defined( 'AIOSEO_VERSION' )             // All in One SEO.
		|| defined( 'THE_SEO_FRAMEWORK_VERSION' ); // The SEO Framework.
}

/**
 * Meta-Beschreibung für die aktuelle Seite.
 *
 * @return string
 */
function foerderverein_pro_meta_description() {
	$description = '';

	if ( is_front_page() ) {
		$description = get_bloginfo( 'description' );
	} elseif ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
	} elseif ( is_archive() ) {
		$description = get_the_archive_description()
			? wp_strip_all_tags( get_the_archive_description() )
			: wp_strip_all_tags( get_the_archive_title() );
	}

	if ( $description ) {
		$description = wp_html_excerpt( $description, 155, '…' );
	}

	return trim( (string) $description );
}

/**
 * Canonical-URL der aktuellen Seite.
 *
 * @return string
 */
function foerderverein_pro_canonical_url() {
	if ( is_singular() ) {
		return (string) wp_get_canonical_url();
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_post_type_archive() ) {
		return get_post_type_archive_link( get_query_var( 'post_type' ) );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? '' : (string) $link;
	}
	return '';
}

/**
 * OG-/Twitter-Bild der aktuellen Seite.
 *
 * @return string Bild-URL oder leer.
 */
function foerderverein_pro_og_image() {
	$image = '';

	if ( is_singular() && has_post_thumbnail() ) {
		$image = (string) get_the_post_thumbnail_url( null, 'large' );
	}
	if ( ! $image ) {
		$image = (string) get_theme_mod( 'fv_hero_image', '' );
	}
	if ( ! $image ) {
		$image = (string) get_site_icon_url( 512 );
	}

	return $image;
}

/**
 * Meta-, Open-Graph- und Twitter-Tags ausgeben.
 */
function foerderverein_pro_meta_tags() {
	if ( foerderverein_pro_seo_plugin_active() ) {
		return;
	}

	$description = foerderverein_pro_meta_description();
	$canonical   = foerderverein_pro_canonical_url();
	$image       = foerderverein_pro_og_image();
	$site_name   = get_bloginfo( 'name' );

	// Robots: Suchergebnisse und 404 nicht indexieren.
	if ( is_search() || is_404() ) {
		echo '<meta name="robots" content="noindex, follow" />' . "\n";
	} else {
		echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />' . "\n";
	}

	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
	}
	if ( $canonical ) {
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
	}

	// Open Graph.
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $canonical ? $canonical : home_url( '/' ) ) . '" />' . "\n";
	echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '" />' . "\n";
	if ( $description ) {
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
	}
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
	}

	// Twitter Card.
	echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '" />' . "\n";
	if ( $description ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
	}
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'foerderverein_pro_meta_tags', 1 );

/**
 * Organisation (Förderverein) als JSON-LD.
 *
 * @return array
 */
function foerderverein_pro_schema_organization() {
	$schema = array(
		'@type' => 'NGO',
		'@id'   => home_url( '/#organization' ),
		'name'  => get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);

	$description = get_bloginfo( 'description' );
	if ( $description ) {
		$schema['description'] = $description;
	}

	$logo = get_site_icon_url( 512 );
	if ( $logo ) {
		$schema['logo'] = array( '@type' => 'ImageObject', 'url' => $logo );
	}

	$email = foerderverein_pro_contact_email();
	if ( $email ) {
		$schema['email'] = $email;
	}

	$phone = get_theme_mod( 'fv_contact_phone', '' );
	if ( $phone ) {
		$schema['telephone'] = $phone;
	}

	$address = get_theme_mod( 'fv_contact_address', '' );
	if ( $address ) {
		$schema['address'] = array(
			'@type'       => 'PostalAddress',
			'streetAddress' => $address,
			'addressCountry' => 'DE',
		);
	}

	return $schema;
}

/**
 * Website-Schema mit Suchaktion.
 *
 * @return array
 */
function foerderverein_pro_schema_website() {
	return array(
		'@type'           => 'WebSite',
		'@id'             => home_url( '/#website' ),
		'url'             => home_url( '/' ),
		'name'            => get_bloginfo( 'name' ),
		'publisher'       => array( '@id' => home_url( '/#organization' ) ),
		'inLanguage'      => get_locale(),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
}

/**
 * Brotkrumen-Schema.
 *
 * @return array
 */
function foerderverein_pro_schema_breadcrumbs() {
	$items = array( array(
		'@type'    => 'ListItem',
		'position' => 1,
		'name'     => __( 'Startseite', 'foerderverein-pro' ),
		'item'     => home_url( '/' ),
	) );

	if ( is_singular() && ! is_front_page() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);
}

/**
 * Artikel-Schema für Beiträge.
 *
 * @return array
 */
function foerderverein_pro_schema_article() {
	return array(
		'@type'            => 'Article',
		'headline'         => get_the_title(),
		'url'              => get_permalink(),
		'datePublished'    => get_the_date( DATE_W3C ),
		'dateModified'     => get_the_modified_date( DATE_W3C ),
		'inLanguage'       => get_locale(),
		'author'           => array( '@id' => home_url( '/#organization' ) ),
		'publisher'        => array( '@id' => home_url( '/#organization' ) ),
		'mainEntityOfPage' => get_permalink(),
	);
}

/**
 * Veranstaltungs-Schema.
 *
 * @param int $post_id Veranstaltung-ID.
 * @return array|null
 */
function foerderverein_pro_schema_event( $post_id ) {
	$raw = get_post_meta( $post_id, '_fv_event_date', true );
	if ( ! $raw ) {
		return null;
	}

	try {
		$start = new DateTimeImmutable( $raw, wp_timezone() );
	} catch ( Exception $e ) {
		return null;
	}

	$schema = array(
		'@type'     => 'Event',
		'name'      => get_the_title( $post_id ),
		'url'       => get_permalink( $post_id ),
		'startDate' => $start->format( DATE_W3C ),
		'eventStatus' => 'https://schema.org/EventScheduled',
		'organizer' => array( '@id' => home_url( '/#organization' ) ),
	);

	$excerpt = get_the_excerpt( $post_id );
	if ( $excerpt ) {
		$schema['description'] = $excerpt;
	}

	$location = foerderverein_pro_event_location( $post_id );
	if ( $location ) {
		$schema['location'] = array(
			'@type' => 'Place',
			'name'  => $location,
		);
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$schema['image'] = get_the_post_thumbnail_url( $post_id, 'large' );
	}

	return $schema;
}

/**
 * JSON-LD für die aktuelle Seite ausgeben.
 */
function foerderverein_pro_schema_output() {
	if ( foerderverein_pro_seo_plugin_active() ) {
		return;
	}

	$graph = array();

	if ( is_front_page() ) {
		$graph[] = foerderverein_pro_schema_organization();
		$graph[] = foerderverein_pro_schema_website();
	}

	if ( is_singular( 'post' ) ) {
		$graph[] = foerderverein_pro_schema_article();
	}

	if ( is_singular( 'fv_event' ) ) {
		$event = foerderverein_pro_schema_event( get_the_ID() );
		if ( $event ) {
			$graph[] = $event;
		}
	}

	if ( is_singular() && ! is_front_page() ) {
		$graph[] = foerderverein_pro_schema_breadcrumbs();
	}

	if ( ! $graph ) {
		return;
	}

	$payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'foerderverein_pro_schema_output', 5 );

/**
 * llms.txt-Endpunkt registrieren (KI-Crawler-Zusammenfassung der Website).
 */
function foerderverein_pro_llms_txt_rewrite() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?fv_llms_txt=1', 'top' );
}
add_action( 'init', 'foerderverein_pro_llms_txt_rewrite' );

/**
 * Query-Var für llms.txt erlauben.
 *
 * @param array $vars Erlaubte Query-Variablen.
 * @return array
 */
function foerderverein_pro_llms_txt_query_var( $vars ) {
	$vars[] = 'fv_llms_txt';
	return $vars;
}
add_filter( 'query_vars', 'foerderverein_pro_llms_txt_query_var' );

/**
 * llms.txt ausgeben.
 */
function foerderverein_pro_llms_txt_output() {
	if ( ! get_query_var( 'fv_llms_txt' ) ) {
		return;
	}

	$lines   = array();
	$lines[] = '# ' . get_bloginfo( 'name' );
	$lines[] = '';
	$lines[] = '> ' . ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Förderverein eines Amateurfussballvereins.', 'foerderverein-pro' ) );
	$lines[] = '';
	$lines[] = __( 'Der Förderverein unterstützt den Amateurfussballverein durch Spenden, Mitgliedschaften, Sponsoring und ehrenamtliche Arbeit.', 'foerderverein-pro' );
	$lines[] = '';

	$lines[] = '## ' . __( 'Kontakt', 'foerderverein-pro' );
	$email = foerderverein_pro_contact_email();
	$phone = get_theme_mod( 'fv_contact_phone', '' );
	if ( $email ) {
		$lines[] = '- Email: ' . antispambot( $email );
	}
	if ( $phone ) {
		$lines[] = '- Phone: ' . $phone;
	}
	$address = get_theme_mod( 'fv_contact_address', '' );
	if ( $address ) {
		$lines[] = '- Address: ' . preg_replace( '/\s+/', ', ', $address );
	}
	$lines[] = '';

	$lines[] = '## ' . __( 'Seiten', 'foerderverein-pro' );
	$pages = get_pages( array( 'sort_column' => 'menu_order' ) );
	foreach ( (array) $pages as $page ) {
		$lines[] = '- [' . get_the_title( $page ) . '](' . get_permalink( $page ) . ')';
	}
	$lines[] = '';

	$events = get_posts( array(
		'post_type'      => 'fv_event',
		'posts_per_page' => 10,
		'meta_key'       => '_fv_event_date',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
	) );
	if ( $events ) {
		$lines[] = '## ' . __( 'Veranstaltungen', 'foerderverein-pro' );
		foreach ( $events as $event ) {
			$date = foerderverein_pro_event_date( $event->ID );
			$lines[] = '- [' . get_the_title( $event ) . '](' . get_permalink( $event ) . ')' . ( $date ? ' – ' . $date : '' );
		}
		$lines[] = '';
	}

	$posts = get_posts( array( 'posts_per_page' => 10 ) );
	if ( $posts ) {
		$lines[] = '## ' . __( 'Aktuelle News', 'foerderverein-pro' );
		foreach ( $posts as $post ) {
			$lines[] = '- [' . get_the_title( $post ) . '](' . get_permalink( $post ) . ')';
		}
		$lines[] = '';
	}

	header( 'Content-Type: text/plain; charset=utf-8' );
	echo esc_html( implode( "\n", $lines ) );
	exit;
}
add_action( 'template_redirect', 'foerderverein_pro_llms_txt_output' );

/**
 * Nach Theme-Aktivierung Rewrite-Regeln einschreiben (für llms.txt).
 */
function foerderverein_pro_flush_rewrite_rules() {
	foerderverein_pro_llms_txt_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'foerderverein_pro_flush_rewrite_rules' );

