
# Change Log
All notable changes to this project will be documented in this file.
 
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).


---

## [1.1.5] - 2026-10-06

### Updated

- **Refactor: Shared ACF component rendering**
  - Refactored repeated ACF flexible content rendering across page and single templates.
  - Added a shared component renderer to dynamically load template parts based on the ACF layout name.
  - Removed duplicated component conditionals from individual templates.
  - Moved page-specific components into the shared component structure.
  - Consolidated repeated legal page component rendering into shared templates.
  - Refactored repeated post navigation into a reusable template part.
  - Standardised component file naming and organisation.
  - Reduced duplicated code and simplified the process of adding new ACF components.

## [1.1.4] - 2026-10-05

### Updated

- Deployment script: 
   - Staging and Production environment



## [1.1.3] - 2026-10-02

### Updated

- HTML image tags across all site

## [1.1.2] - 2026-10-03

### Fixed

- Design images object cover

### Updated

- Admin area: Design columns titles
- Refactored theme CSS structure by moving styles from `style.css` into a dedicated stylesheet, leaving `style.css` for WordPress theme metadata only.

## [1.1.1] - 2026-10-03

### Added

- Deployment script


## [1.1.0] - 2026-10-02

### Updated

- Project templates & content structure

  - Refactored project templates to improve code consistency and reuse shared project components.

  - Updated hero templates to use the shared project card structure where appropriate.

  - Improved video hero handling, including proper poster image support and image fallback when no video is available.

  - Updated the project content structure so the WordPress post title can be used as the actual project title.

  - Added support for a separate project subtitle, replacing the previous approach where the article-style subtitle was incorrectly stored as the WordPress post title.

  - Updated project heading output so the correct project title can be used as the primary H1.

  - Prepared project templates for the title/slug migration, improving compatibility with Yoast SEO and WordPress-generated URLs.

  - Removed reliance on the legacy project_title field from the updated project templates.


## [1.0.2] - 2026-07-24

### Updated

- Load remote uploads


## [1.0.1] - 2026-07-24

### Added

- Fento plugin

## [0.0.3] - 2023-10-21

### Updated

- PATHS AND URLS in .md files

## [0.0.2] - 2023-10-20

### Added

- wp-config.php to Wordpress root and WP-CLI

## [0.0.1] - 2023-10-19

### Added

- Adding DOCKER
