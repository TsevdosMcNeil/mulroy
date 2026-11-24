# Codigo Environment Colours

A lightweight, reusable WordPress plugin that visually distinguishes production and staging environments through enforced admin colour schemes and environment labels in the WordPress toolbar.

The aim is to reduce accidental changes to live websites by making the current environment immediately recognisable.

[![version](https://img.shields.io/badge/version-1.1.1-blue.svg)](https://semver.org)


## Plugin information

| Property | Value |
| --- | --- |
| Version | 1.1.0 |
| Author | Pablo Rica |
| Minimum WordPress version | 6.0 |
| Minimum PHP version | 7.4 |
| Text domain | `codigo-environment-colours` |

## Features

- Configurable production and staging URLs through the native WordPress Settings API.
- Automatic environment detection using `home_url()`.
- Red Sunrise admin colour scheme for production.
- Custom Coffee-inspired gold admin colour scheme for staging.
- LIVE and STAGING labels in the admin toolbar, including the frontend when the toolbar is visible.
- Enforced colour schemes for all users without overwriting their saved preferences.
- Safe fallback to the user's preferred scheme on unrecognised or unconfigured environments.
- URL validation and protection against duplicate environment URLs.
- Settings restricted to users with the `manage_options` capability.

## Installation

1. Upload the `codigo-environment-colours` directory to `wp-content/plugins/`, or upload the plugin ZIP through **Plugins → Add New → Upload Plugin**.
2. Activate **Codigo Environment Colours**.
3. Navigate to **Settings → Environment Colours**.
4. Enter the production and staging website URLs.
5. Click **Save Changes**.
6. Install and configure the same plugin on the other environment, unless its database is cloned from the configured installation.

## Configuration

Enter the public website URLs, not the `/wp-admin/` URLs.

Example:

| Setting | Example |
| --- | --- |
| Production URL | `https://example.com/` |
| Staging URL | `https://staging.example.com/` |

The settings page also displays the detected environment and current home URL. Either URL may be left empty if it is not yet known.

## Environment behaviour

| Environment | Admin colour scheme | Toolbar label |
| --- | --- | --- |
| Production | Sunrise (`sunrise`) | ● LIVE |
| Staging | Codigo Gold (`codigo-gold`) | ● STAGING |
| Unknown / not configured | User's preferred scheme | None |

### URL matching

The plugin compares the configured URLs against `home_url()`, using the hostname, explicit port and installation path.

- HTTP and HTTPS are treated as equivalent.
- Trailing slashes are ignored.
- Hostnames are case-insensitive; paths remain case-sensitive.
- Different hostnames, explicit ports and paths are distinguished.
- `www.example.com` and `example.com` are treated as different hosts.
- URLs must include an HTTP or HTTPS scheme and a hostname, without credentials, query strings or fragments.
- Production and staging cannot have the same normalised URL.

Supported configurations include subdomains, subdirectory-based staging sites and local environments with custom ports. Only two environments can be configured in this version.

### Database migrations

Configuration is stored in the WordPress database. When cloning a configured production database to staging, both environment URLs are copied with it. The plugin will identify staging automatically once the destination's WordPress home URL has been correctly updated.

## Colour schemes

Production uses WordPress's built-in Sunrise scheme. Staging uses the custom stylesheet `staging-colours.css`, inspired by the Coffee scheme.

| Staging palette | Hex |
| --- | --- |
| Base | `#28241e` |
| Secondary | `#51452b` |
| Gold accent | `#d5a927` |
| Highlight | `#f3d56a` |

The production toolbar label uses `#b32d2e` with white text. The staging label uses `#d5a927` with dark text (`#211b0a`).

## File structure

```text
codigo-environment-colours/
├── codigo-environment-colours.php
├── staging-colours.css
└── README.md
```

## Technical implementation

- Database option: `codigo_environment_urls` (array containing `production` and `staging`).
- Settings group: `codigo_environment_colours`.
- Settings page slug: `codigo-environment-colours`.
- `codigo_environment_key()` normalises URLs for comparison.
- `codigo_environment_type()` returns `production`, `staging` or `unknown`.
- `codigo_environment_sanitize()` validates settings and retains previous values if validation fails.
- `wp_admin_css_color()` registers the custom staging scheme.
- `get_user_option_admin_color` filters the effective admin colour scheme.
- `admin_bar_menu` adds the environment label (`codigo-environment`).
- `admin_head` and `wp_head` output the toolbar label styles.

No external libraries or services are required. The plugin does not use `WP_ENVIRONMENT_TYPE` for detection.

## Troubleshooting

**The dashboard colour has not changed:** Check that the plugin is active, the URLs are saved and the current environment shown on the settings page is correct. Reload the dashboard.

**The environment is unrecognised:** Compare the displayed home URL with the configured URLs, paying particular attention to `www`, explicit ports and subdirectory paths.

**The toolbar label is missing on the frontend:** Check that you are logged in and the WordPress toolbar is enabled.

**The settings page is missing:** Confirm your account has the `manage_options` capability.

## Deactivation and removal

Deactivating the plugin stops colour enforcement and removes the environment labels. Users' saved colour preferences remain unchanged by the enforcement filter. Version 1.1.0 does not implement an uninstall routine, so its configuration option is not automatically removed when the plugin is deleted.


## Testing and limitations

This documentation describes the v1.1.0 source code. Runtime compatibility has not been independently verified in a running WordPress installation. Test on staging before deploying to production, including administrator and editor accounts, URL validation, frontend toolbar labels and deactivation.

The plugin is a visual aid, not an access-control or deployment-safety mechanism. It does not prevent edits to production, restrict user permissions or protect staging from public access or search engine indexing.


## Copyright and License

Copyright 2025 Mulroy Wordpress Theme released under the [MIT](https://github.com/pablorica/sparemytime/blob/main/LICENSE) license.

## Versioning

We use [SemVer](https://semver.org/) for versioning. For the versions available, [list of tags can be found in this page](https://github.com/TsevdosMcNeil/mulroy/tags).

### Changelog

[CHANGELOG.md](CHANGELOG.md)


