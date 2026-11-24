<?php
/**
 * Plugin Name:       Codigo Environment Colours
 * Description:       Distinguishes production and staging WordPress dashboards with enforced colour schemes and an environment badge.
 * Version:           1.1.1
 * Author:            Pablo Rica
 * Requires at least: 6.0
 * Text Domain:       codigo-environment-colours
 * Requires PHP:      7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

/** Compare host, port and installation path, ignoring scheme and trailing slash. */
function codigo_environment_key($url) {
    $parts = wp_parse_url(trim((string) $url));
    if (!$parts || empty($parts['host']) || empty($parts['scheme']) ||
        !in_array(strtolower($parts['scheme']), array('http', 'https'), true) ||
        isset($parts['user']) || isset($parts['pass']) || isset($parts['query']) || isset($parts['fragment'])) {
        return '';
    }
    return strtolower($parts['host']) . (isset($parts['port']) ? ':' . $parts['port'] : '') . rtrim($parts['path'] ?? '', '/');
}

function codigo_environment_type() {
    $settings = get_option('codigo_environment_urls', array());
    $current = codigo_environment_key(home_url());
    $production = codigo_environment_key($settings['production'] ?? '');
    $staging = codigo_environment_key($settings['staging'] ?? '');
    if (!$current || ($production && $production === $staging)) {
        return 'unknown';
    }
    if ($current === $staging) return 'staging';
    if ($current === $production) return 'production';
    return 'unknown';
}

function codigo_environment_sanitize($input) {
    $previous = get_option('codigo_environment_urls', array());
    $clean = array();
    foreach (array('production', 'staging') as $key) {
        $raw = isset($input[$key]) && is_string($input[$key]) ? trim($input[$key]) : '';
        $clean[$key] = esc_url_raw($raw, array('http', 'https'));
        if ($raw !== '' && (!codigo_environment_key($raw) || !codigo_environment_key($clean[$key]))) {
            add_settings_error('codigo_environment_urls', 'invalid_url', __('Enter a valid HTTP or HTTPS website URL without credentials, query or fragment.', 'codigo-environment-colours'));
            return $previous;
        }
    }
    if ($clean['production'] && codigo_environment_key($clean['production']) === codigo_environment_key($clean['staging'])) {
        add_settings_error('codigo_environment_urls', 'duplicate_url', __('Production and staging must have different URLs.', 'codigo-environment-colours'));
        return $previous;
    }
    return $clean;
}

add_action('admin_init', function () {
    register_setting('codigo_environment_colours', 'codigo_environment_urls', array(
        'type' => 'array', 'sanitize_callback' => 'codigo_environment_sanitize', 'default' => array(),
    ));
    add_settings_section('codigo_environment_section', __('Environment configuration', 'codigo-environment-colours'), '__return_false', 'codigo-environment-colours');
    foreach (array('production' => __('Production URL', 'codigo-environment-colours'), 'staging' => __('Staging URL', 'codigo-environment-colours')) as $key => $label) {
        add_settings_field('codigo_environment_' . $key, $label, function () use ($key) {
            $settings = get_option('codigo_environment_urls', array());
            printf('<input type="url" class="regular-text" id="codigo_environment_%1$s" name="codigo_environment_urls[%1$s]" value="%2$s" placeholder="https://%3$s.example.com">', esc_attr($key), esc_attr($settings[$key] ?? ''), esc_attr($key));
        }, 'codigo-environment-colours', 'codigo_environment_section', array('label_for' => 'codigo_environment_' . $key));
    }
});

add_action('admin_menu', function () {
    add_options_page(__('Environment Colours', 'codigo-environment-colours'), __('Environment Colours', 'codigo-environment-colours'), 'manage_options', 'codigo-environment-colours', 'codigo_environment_settings_page');
});

function codigo_environment_settings_page() {
    if (!current_user_can('manage_options')) return;
    $environment = codigo_environment_type();
    $labels = array('production' => 'LIVE', 'staging' => 'STAGING', 'unknown' => 'UNRECOGNISED / NOT CONFIGURED');
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Environment Colours', 'codigo-environment-colours'); ?></h1>
        <p><?php esc_html_e('Configure both website URLs. Unrecognised environments retain the user’s preferred colour scheme.', 'codigo-environment-colours'); ?></p>
        <form method="post" action="options.php">
            <?php settings_fields('codigo_environment_colours'); do_settings_sections('codigo-environment-colours'); submit_button(); ?>
        </form>
        <h2><?php esc_html_e('Current environment', 'codigo-environment-colours'); ?></h2>
        <p><strong><?php echo esc_html($labels[$environment]); ?></strong> — <?php echo esc_html(home_url()); ?></p>
        <p><?php esc_html_e('Production: Sunrise. Staging: Codigo Gold.', 'codigo-environment-colours'); ?></p>
    </div>
    <?php
}

add_action('admin_init', function () {
    if (codigo_environment_type() !== 'staging') {
        return;
    }
    wp_admin_css_color(
        'codigo-gold',
        __('Codigo Gold', 'codigo-environment-colours'),
        plugin_dir_url(__FILE__) . 'staging-colours.css',
        array('#28241e', '#51452b', '#d5a927', '#f3d56a'),
        array('base' => '#f7e4a5', 'focus' => '#fff', 'current' => '#fff')
    );
}, 1);

add_filter('get_user_option_admin_color', function ($color) {
    $environment = codigo_environment_type();
    if ($environment === 'staging') {
        return 'codigo-gold';
    }
    if ($environment === 'production') {
        return 'sunrise';
    }
    return $color;
});

add_action('admin_bar_menu', function ($admin_bar) {
    $environment = codigo_environment_type();
    if ($environment === 'unknown') {
        return;
    }
    $admin_bar->add_node(array(
        'id' => 'codigo-environment',
        'title' => $environment === 'staging' ? '● STAGING' : '● LIVE',
        'href' => admin_url(),
        'meta' => array('title' => $environment === 'staging' ? 'Staging environment' : 'Live production environment'),
    ));
}, 100);

add_action('admin_head', 'codigo_environment_badge_css');
add_action('wp_head', function () {
    if (is_admin_bar_showing()) {
        codigo_environment_badge_css();
    }
});

function codigo_environment_badge_css() {
    $environment = codigo_environment_type();
    if ($environment === 'unknown') {
        return;
    }
    $background = $environment === 'staging' ? '#d5a927' : '#b32d2e';
    $foreground = $environment === 'staging' ? '#211b0a' : '#fff';
    echo '<style>#wpadminbar #wp-admin-bar-codigo-environment > .ab-item {background:' . esc_attr($background) . ' !important;color:' . esc_attr($foreground) . ' !important;font-weight:700 !important;padding:0 14px !important;}#wpadminbar #wp-admin-bar-codigo-environment:hover > .ab-item {background:' . esc_attr($background) . ' !important;color:' . esc_attr($foreground) . ' !important;}</style>';
}
