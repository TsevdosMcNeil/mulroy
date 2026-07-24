<?php
/**
 * Meow Media File Renamer access configuration.
 *
 * @package FentoWordPressConfiguration
 */

defined( 'ABSPATH' ) || exit;

/**
 * Allow users with the Fento capability to use Media File Renamer.
 *
 * @param bool $allow Whether Media File Renamer already allows access.
 * @return bool
 */
function fento_wp_configuration_allow_media_file_renamer(
	bool $allow
): bool {
	if ( $allow ) {
		return true;
	}

	/*
	 * current_user_can() depends on wp_get_current_user(), which is loaded
	 * from wp-includes/pluggable.php after active plugins have been included.
	 */
	if ( ! function_exists( 'wp_get_current_user' ) ) {
		return false;
	}

	return current_user_can(
		FENTO_WP_CONFIGURATION_CAP_MEDIA_FILE_RENAMER
	);
}

/**
 * Register the Media File Renamer access filter after WordPress has loaded
 * its pluggable user functions.
 *
 * @return void
 */
function fento_wp_configuration_register_media_file_renamer_access(): void {
	add_filter(
		'mfrh_allow_usage',
		'fento_wp_configuration_allow_media_file_renamer'
	);
}

add_action(
	'plugins_loaded',
	'fento_wp_configuration_register_media_file_renamer_access'
);
