=== Fento WordPress Configuration ===
Contributors: fento
Tags: permissions, seo, yoast, site kit, media file renamer
Requires at least: 6.0
Requires PHP: 7.4
Stable tag: 1.2.1

WordPress configuration and access customisations for Fento SEO managers.

== Description ==

This plugin contains Fento-specific WordPress configuration and permission rules.

Current functionality:

* Adds `manage_options` to Yoast's SEO Manager role (`wpseo_manager`) so its users can manage Google Site Kit.
* Adds the custom `fento_manage_media_file_renamer` capability to that role.
* Allows users with the custom capability to access Meow Media File Renamer.
* Provides separate files for role configuration and each supported plugin integration.
* Adds a branded Fento top-level menu item and configuration overview page.

== File structure ==

fento-wordpress-configuration/
* fento-wordpress-configuration.php
* includes/roles.php
* includes/google-site-kit.php
* includes/media-file-renamer.php

== Installation ==

1. Upload the ZIP through Plugins > Add New > Upload Plugin.
2. Activate "Fento WordPress Configuration".
3. Log out and back in with the SEO Manager account.
4. Confirm access to Google Site Kit and Media File Renamer.
5. User Role Editor can then be deactivated and removed if it is no longer needed.

== Security note ==

The `manage_options` capability provides access to many WordPress and plugin settings, not only Google Site Kit. Only assign the SEO Manager role to trusted users.

== Notes ==

The plugin does not remove capabilities when deactivated, preventing temporary deactivation from unexpectedly changing user permissions.

== Changelog ==

= 1.2.1 =
* Register the Media File Renamer permission filter after WordPress loads its pluggable user functions.
* Prevent a fatal error when the integration is evaluated during early plugin loading.

= 1.2.0 =
* Added a Fento top-level WordPress admin menu.
* Added a custom monochrome SVG menu icon.
* Added a configuration overview page.
* Added reusable brand icon assets.

= 1.1.0 =
* Split the plugin into separate role, Site Kit and Media File Renamer modules.
* Added `manage_options` to Yoast SEO Managers for Google Site Kit access.

= 1.0.0 =
* Initial release.
* Added Media File Renamer access for Yoast SEO Managers.
