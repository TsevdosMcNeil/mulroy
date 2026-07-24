<?php
/**
 * Fento administration menu.
 *
 * @package FentoWordPressConfiguration
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the SVG icon as a base64 data URI.
 *
 * WordPress can recolour a black SVG icon automatically when it is supplied
 * as a data URI to add_menu_page().
 *
 * @return string
 */
function fento_wp_configuration_get_admin_menu_icon(): string {
	$icon_path = FENTO_WP_CONFIGURATION_PATH . 'assets/images/icon-brand.svg';

	if ( ! is_readable( $icon_path ) ) {
		return 'dashicons-admin-generic';
	}

	$svg = file_get_contents( $icon_path );

	if ( false === $svg ) {
		return 'dashicons-admin-generic';
	}

	return 'data:image/svg+xml;base64,' . base64_encode( $svg );
}

/**
 * Register the Fento top-level admin menu page.
 *
 * @return void
 */
function fento_wp_configuration_register_admin_menu(): void {
	add_menu_page(
		__( 'Fento WordPress Configuration', 'fento-wordpress-configuration' ),
		__( 'Fento', 'fento-wordpress-configuration' ),
		'manage_options',
		'fento-wordpress-configuration',
		'fento_wp_configuration_render_admin_page',
		fento_wp_configuration_get_admin_menu_icon(),
		58
	);
}

add_action( 'admin_menu', 'fento_wp_configuration_register_admin_menu' );

/**
 * Render the Fento configuration overview page.
 *
 * @return void
 */
function fento_wp_configuration_render_admin_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die(
			esc_html__( 'You do not have permission to access this page.', 'fento-wordpress-configuration' )
		);
	}

	require FENTO_WP_CONFIGURATION_PATH . 'templates/admin-page.php';
}
