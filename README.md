# Wordpress Template & Plugins for Mulroy
Infrastructure as code (Docker & Wordpress) project for Mulroy

[![version](https://img.shields.io/badge/version-1.3.1-green.svg)](https://semver.org)


## Staging Server

https://staging.mulroyarchitects.com/


## Production Server

https://mulroyarchitects.com/


## Documentation

- [Category landing pages](docs/design-category-landing-pages.md)
- ["News" pages](docs/news-item-pages.md)
- [Docker installation](docs/DOCKER.md)

## Installation

### Docker Installation

[DOCKER.md](docs/DOCKER.md)


## Deployment

Change permissions:

```bash
chmod +x deploy.sh
```

Deploy:

```bash
cd ~/Dockers/mulroy
./deploy.sh
```
You'll get:

```bash
Select deployment environment:
  1) Staging
  2) Production

Environment [1/2]:
```

Choosing 1 deploys to:

```bash
/public_html/staging/wp-content/themes/mulroy
```
with no backup.

Choosing 2 deploys to:

```bash
/public_html/wp-content/themes/mulroy
```

and runs the production backup and cleanup first. The script asks for confirmation after showing the dry run, and shows which environment was selected.

> **Note:** `deploy.sh` only deploys the theme. Changes to the custom plugins in `wp-content/plugins/` (Fento WordPress Configuration, Environment colours) have to be uploaded separately.

---
## Landing Pages

Custom landing pages for the custom taxonomy "Design category", e.g. `/architecture/basements/`.

- Each category's landing page can be published or unpublished from **Designs > Categories**. An unpublished page shows a 404 to visitors and is removed from the sitemap. Editors can still preview it while logged in. The category itself keeps working.
- [Design category landing pages](docs/design-category-landing-pages.md)

---

## Fento plugin

`wp-content/plugins/fento-wordpress-configuration/`

This plugin manages the access of the SEO Manager role and also some custom features related to SEO:

- [News articles](docs/news-item-pages.md): the single post pages can be enabled/disabled in **Fento > Single post pages**. Also, the posts have been renamed "News".
- Plugin details and changelog: [readme.txt](wp-content/plugins/fento-wordpress-configuration/readme.txt)

---

## Environment colours

`wp-content/plugins/codigo-environment-colours/`

This plugin manages the CMS colour set for staging and production.

- [README](wp-content/plugins/codigo-environment-colours/README.md)

---

## Required Plugins

* [Advanced Custom Fields](https://www.advancedcustomfields.com/pro/)
* [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) (XML sitemaps, SEO Manager role)
* [All-in-One WP Migration and Backup](https://wordpress.org/plugins/all-in-one-wp-migration/)

Optional, used by the Fento plugin's access rules:

* [Site Kit by Google](https://wordpress.org/plugins/google-site-kit/)
* [Media File Renamer](https://wordpress.org/plugins/media-file-renamer/)

## Acknowledgements

* [TM studio](http://tm-studio.co.uk/)


## Copyright and License

Copyright 2026 Mulroy Wordpress Theme released under the [MIT](LICENSE) license.

## Versioning

We use [SemVer](https://semver.org/) for versioning. For the versions available, [list of tags can be found in this page](https://github.com/TsevdosMcNeil/mulroy/tags).

### Changelog

[CHANGELOG.md](CHANGELOG.md)
