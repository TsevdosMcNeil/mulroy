<?php
/**
 * Single post pages (post type `post`) on/off switch.
 *
 * Managed from Fento > "Single post pages". When the pages are turned off:
 *
 * - Visiting a post URL redirects (301) to the posts list. The theme can
 *   change the target with the `fento_wp_configuration_single_post_url`
 *   filter, e.g. to point at the post's anchor on a News page.
 * - Category, tag, author and date archives redirect to the posts list too,
 *   because they only exist to link to single posts.
 * - get_permalink() is not changed (Yoast stores permalinks in its
 *   indexables, so changing it could leave wrong URLs behind when the pages
 *   are turned back on). The theme hides or changes its own links by calling
 *   fento_wp_configuration_single_posts_disabled().
 * - Posts, categories, tags and authors are removed from the XML sitemaps
 *   (Yoast SEO and the WordPress core sitemaps).
 *
 * Previews still work, so editors can check a post before publishing.
 * Turning the option back on restores everything; nothing is deleted.
 *
 * @package FentoWordPressConfiguration
 */

defined( 'ABSPATH' ) || exit;

/**
 * Option name. Stored as '1' when single post pages are turned off.
 */
const FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION = 'fento_wp_configuration_disable_single_posts';

/**
 * Whether single post pages are turned off.
 *
 * The theme can call this to hide links to single posts.
 *
 * @return bool
 */
function fento_wp_configuration_single_posts_disabled(): bool {
	return (bool) get_option( FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION, false );
}

/**
 * URL of the page that lists the posts.
 *
 * Defaults to the "Posts page" from Settings > Reading, otherwise the home
 * page. Themes with their own list page use the
 * `fento_wp_configuration_posts_list_url` filter.
 *
 * @return string
 */
function fento_wp_configuration_posts_list_url(): string {
	$page_for_posts = (int) get_option( 'page_for_posts' );
	$url            = $page_for_posts ? get_permalink( $page_for_posts ) : home_url( '/' );

	return (string) apply_filters( 'fento_wp_configuration_posts_list_url', $url );
}

/**
 * Where a single post points to when its page is turned off.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function fento_wp_configuration_single_post_url( WP_Post $post ): string {
	return (string) apply_filters(
		'fento_wp_configuration_single_post_url',
		fento_wp_configuration_posts_list_url(),
		$post
	);
}

/**
 * Register the option so the settings page can save it.
 *
 * @return void
 */
function fento_wp_configuration_register_single_posts_setting(): void {
	register_setting(
		'fento_wp_configuration',
		FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION,
		array(
			'type'              => 'boolean',
			'default'           => false,
			'sanitize_callback' => static function ( $value ): string {
				return $value ? '1' : '0';
			},
		)
	);
}

add_action( 'admin_init', 'fento_wp_configuration_register_single_posts_setting' );

/**
 * Clear the Yoast sitemap cache when the option changes, so the sitemaps
 * update straight away.
 *
 * @return void
 */
function fento_wp_configuration_clear_sitemap_cache(): void {
	if ( class_exists( 'WPSEO_Sitemaps_Cache' ) && method_exists( 'WPSEO_Sitemaps_Cache', 'clear' ) ) {
		WPSEO_Sitemaps_Cache::clear();
	}
}

add_action( 'add_option_' . FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION, 'fento_wp_configuration_clear_sitemap_cache' );
add_action( 'update_option_' . FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION, 'fento_wp_configuration_clear_sitemap_cache' );

/**
 * Redirect single posts and post archives.
 *
 * Runs before redirect_canonical() (priority 10).
 *
 * @return void
 */
function fento_wp_configuration_redirect_single_posts(): void {
	if ( ! fento_wp_configuration_single_posts_disabled() || is_preview() ) {
		return;
	}

	$target = '';

	if ( is_singular( 'post' ) ) {
		$post   = get_queried_object();
		$target = $post instanceof WP_Post ? fento_wp_configuration_single_post_url( $post ) : '';
	} elseif ( ! is_feed() && ( is_category() || is_tag() || is_author() || is_date() ) ) {
		$target = fento_wp_configuration_posts_list_url();
	}

	if ( '' === $target ) {
		return;
	}

	$status = (int) apply_filters( 'fento_wp_configuration_single_posts_redirect_status', 301 );

	wp_safe_redirect( $target, $status, 'Fento WordPress Configuration' );
	exit;
}

add_action( 'template_redirect', 'fento_wp_configuration_redirect_single_posts', 1 );

/**
 * Yoast SEO: leave posts out of the sitemap.
 *
 * @param bool   $excluded  Whether the post type is excluded.
 * @param string $post_type Post type.
 * @return bool
 */
function fento_wp_configuration_yoast_exclude_posts( $excluded, $post_type ) {
	if ( 'post' === $post_type && fento_wp_configuration_single_posts_disabled() ) {
		return true;
	}

	return $excluded;
}

add_filter( 'wpseo_sitemap_exclude_post_type', 'fento_wp_configuration_yoast_exclude_posts', 10, 2 );

/**
 * Yoast SEO: leave the post categories and tags out of the sitemap.
 *
 * @param bool   $excluded Whether the taxonomy is excluded.
 * @param string $taxonomy Taxonomy.
 * @return bool
 */
function fento_wp_configuration_yoast_exclude_post_taxonomies( $excluded, $taxonomy ) {
	if ( in_array( $taxonomy, array( 'category', 'post_tag' ), true ) && fento_wp_configuration_single_posts_disabled() ) {
		return true;
	}

	return $excluded;
}

add_filter( 'wpseo_sitemap_exclude_taxonomy', 'fento_wp_configuration_yoast_exclude_post_taxonomies', 10, 2 );

/**
 * Yoast SEO: leave the author archives out of the sitemap.
 *
 * @param array $users Users in the author sitemap.
 * @return array
 */
function fento_wp_configuration_yoast_exclude_authors( $users ) {
	return fento_wp_configuration_single_posts_disabled() ? array() : $users;
}

add_filter( 'wpseo_sitemap_exclude_author', 'fento_wp_configuration_yoast_exclude_authors' );

/**
 * WordPress core sitemaps (used when Yoast's sitemaps are off): leave posts out.
 *
 * @param array $post_types Post types in the sitemap.
 * @return array
 */
function fento_wp_configuration_core_sitemap_post_types( $post_types ) {
	if ( fento_wp_configuration_single_posts_disabled() ) {
		unset( $post_types['post'] );
	}

	return $post_types;
}

add_filter( 'wp_sitemaps_post_types', 'fento_wp_configuration_core_sitemap_post_types' );

/**
 * WordPress core sitemaps: leave categories and tags out.
 *
 * @param array $taxonomies Taxonomies in the sitemap.
 * @return array
 */
function fento_wp_configuration_core_sitemap_taxonomies( $taxonomies ) {
	if ( fento_wp_configuration_single_posts_disabled() ) {
		unset( $taxonomies['category'], $taxonomies['post_tag'] );
	}

	return $taxonomies;
}

add_filter( 'wp_sitemaps_taxonomies', 'fento_wp_configuration_core_sitemap_taxonomies' );

/**
 * WordPress core sitemaps: leave the author (users) sitemap out.
 *
 * @param WP_Sitemaps_Provider|false $provider Provider.
 * @param string                     $name     Provider name.
 * @return WP_Sitemaps_Provider|false
 */
function fento_wp_configuration_core_sitemap_users( $provider, $name ) {
	if ( 'users' === $name && fento_wp_configuration_single_posts_disabled() ) {
		return false;
	}

	return $provider;
}

add_filter( 'wp_sitemaps_add_provider', 'fento_wp_configuration_core_sitemap_users', 10, 2 );
