<?php
/**
 * Fento configuration overview template.
 *
 * @package FentoWordPressConfiguration
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="wrap">
	<h1><?php esc_html_e( 'Fento WordPress Configuration', 'fento-wordpress-configuration' ); ?></h1>

	<p>
		<?php esc_html_e( 'This plugin contains the custom WordPress configuration and access rules maintained by Fento.', 'fento-wordpress-configuration' ); ?>
	</p>

	<h2><?php esc_html_e( 'Active access rules', 'fento-wordpress-configuration' ); ?></h2>

	<ul class="ul-disc">
		<li><?php esc_html_e( 'Yoast SEO Managers can manage Google Site Kit through the manage_options capability.', 'fento-wordpress-configuration' ); ?></li>
		<li><?php esc_html_e( 'Yoast SEO Managers can access Meow Media File Renamer through a dedicated Fento capability.', 'fento-wordpress-configuration' ); ?></li>
	</ul>

	<p>
		<strong><?php esc_html_e( 'Plugin version:', 'fento-wordpress-configuration' ); ?></strong>
		<?php echo esc_html( FENTO_WP_CONFIGURATION_VERSION ); ?>
	</p>
</div>
