# Wordpress Template & Plugins for Mulroy
Infrastructure as code (Docker & Wordpress) project for Mulroy

[![version](https://img.shields.io/badge/version-1.1.8-green.svg)](https://semver.org)


## Staging Server

https://staging.mulroyarchitects.com/


## Production Server

https://mulroyarchitects.com/


## Installation

### Docker Installation

[DOCKER.md](https://github.com/TsevdosMcNeil/mulroy/blob/main/DOCKER.md)


## Deployment

Change permissions:

```bash
chmod +x deploy.sh
```

Deploy;

```bash
cd ~/Dockers/mulroy
./deploy.sh
```
you’ll get:

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

and runs your existing production backup + cleanup first. The script also still asks for confirmation after showing the dry-run, but now identifies the selected environment clearly.

## Required Plugins

* [Advanced Custom Fields](https://www.advancedcustomfields.com/pro/)
* [All-in-One WP Migration and Backup](https://wordpress.org/plugins/all-in-one-wp-migration/)

## Acknowledgements

* [TM studio](http://tm-studio.co.uk/)


## Copyright and License

Copyright 2025 Mulroy Wordpress Theme released under the [MIT](https://github.com/pablorica/sparemytime/blob/main/LICENSE) license.

## Versioning

We use [SemVer](https://semver.org/) for versioning. For the versions available, [list of tags can be found in this page](https://github.com/TsevdosMcNeil/mulroy/tags).

### Changelog

[CHANGELOG.md](https://github.com/TsevdosMcNeil/mulroy/blob/main/CHANGELOG.md)
