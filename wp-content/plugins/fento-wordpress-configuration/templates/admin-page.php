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

	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php settings_fields( 'fento_wp_configuration' ); ?>

		<h2><?php esc_html_e( 'Single post pages', 'fento-wordpress-configuration' ); ?></h2>

		<table class="form-table" role="presentation">
			<tr>
				<th scope="row"><?php esc_html_e( 'Single post pages', 'fento-wordpress-configuration' ); ?></th>
				<td>
					<fieldset>
						<label for="<?php echo esc_attr( FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION ); ?>">
							<input
								type="checkbox"
								id="<?php echo esc_attr( FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION ); ?>"
								name="<?php echo esc_attr( FENTO_WP_CONFIGURATION_DISABLE_SINGLE_POSTS_OPTION ); ?>"
								value="1"
								<?php checked( fento_wp_configuration_single_posts_disabled() ); ?>
							/>
							<?php esc_html_e( 'Turn off single post pages', 'fento-wordpress-configuration' ); ?>
						</label>
						<p class="description">
							<?php esc_html_e( 'Post URLs, and category, tag, author and date archives, redirect (301) to the posts list, and they are removed from the XML sitemaps. Previews still work. Untick to bring the pages back; nothing is deleted.', 'fento-wordpress-configuration' ); ?>
						</p>
						<p class="description">
							<?php esc_html_e( 'Posts list:', 'fento-wordpress-configuration' ); ?>
							<a href="<?php echo esc_url( fento_wp_configuration_posts_list_url() ); ?>" target="_blank" rel="noopener"><?php echo esc_html( fento_wp_configuration_posts_list_url() ); ?></a>
						</p>
					</fieldset>
				</td>
			</tr>
		</table>

		<?php submit_button(); ?>
	</form>

	<p>
		<strong><?php esc_html_e( 'Plugin version:', 'fento-wordpress-configuration' ); ?></strong>
		<?php echo esc_html( FENTO_WP_CONFIGURATION_VERSION ); ?>
	</p>
</div>
