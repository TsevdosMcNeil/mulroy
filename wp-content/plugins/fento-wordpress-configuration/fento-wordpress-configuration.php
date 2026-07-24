<?php
/**
 * Plugin Name:       Fento WordPress Configuration
 * Description:       WordPress configuration and access customisations for Fento SEO managers.
 * Version:           1.2.1
 * Author:            Fento
 * Text Domain:       fento-wordpress-configuration
 * Requires at least: 6.0
 * Requires PHP:      7.4
 */

defined( 'ABSPATH' ) || exit;

/**
 * Plugin constants.
 */
define( 'FENTO_WP_CONFIGURATION_VERSION', '1.2.1' );
define( 'FENTO_WP_CONFIGURATION_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Load plugin modules.
 */
require_once FENTO_WP_CONFIGURATION_PATH . 'includes/roles.php';
require_once FENTO_WP_CONFIGURATION_PATH . 'includes/google-site-kit.php';
require_once FENTO_WP_CONFIGURATION_PATH . 'includes/media-file-renamer.php';
require_once FENTO_WP_CONFIGURATION_PATH . 'includes/admin-menu.php';

/**
 * Add the required role capabilities when the plugin is activated.
 */
register_activation_hook(
	__FILE__,
	'fento_wp_configuration_add_seo_manager_capabilities'
);
