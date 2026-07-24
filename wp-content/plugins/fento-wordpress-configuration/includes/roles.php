<?php
/**
 * Role and capability configuration.
 *
 * @package FentoWordPressConfiguration
 */

defined( 'ABSPATH' ) || exit;

/**
 * Yoast SEO Manager role slug.
 */
const FENTO_WP_CONFIGURATION_SEO_MANAGER_ROLE = 'wpseo_manager';

/**
 * Custom capability used to control Media File Renamer access.
 */
const FENTO_WP_CONFIGURATION_CAP_MEDIA_FILE_RENAMER =
	'fento_manage_media_file_renamer';

/**
 * Return the capabilities required by Fento SEO Managers.
 *
 * Add future capabilities to this list when another plugin needs access.
 *
 * @return string[]
 */
function fento_wp_configuration_get_seo_manager_capabilities(): array {
	return array(
		'manage_options',
		FENTO_WP_CONFIGURATION_CAP_MEDIA_FILE_RENAMER,
	);
}

/**
 * Add the required capabilities to Yoast's SEO Manager role.
 *
 * The function also runs on init so capabilities are restored if Yoast
 * creates or updates its role after this plugin has been activated.
 *
 * @return void
 */
function fento_wp_configuration_add_seo_manager_capabilities(): void {
	$seo_manager_role = get_role(
		FENTO_WP_CONFIGURATION_SEO_MANAGER_ROLE
	);

	if ( ! $seo_manager_role instanceof WP_Role ) {
		return;
	}

	foreach (
		fento_wp_configuration_get_seo_manager_capabilities() as $capability
	) {
		if ( ! $seo_manager_role->has_cap( $capability ) ) {
			$seo_manager_role->add_cap( $capability );
		}
	}
}

add_action(
	'init',
	'fento_wp_configuration_add_seo_manager_capabilities'
);
