
# Change Log
All notable changes to this project will be documented in this file.
 
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).


---

## [1.1.14] - 2026-11-04

### Updated
  Studio and People Bio page transition
    - Fixed studio hero flash while going from studio page to bio page.
    - Fixed hero flash and instant scroll while going back from bio page with X button.
    - X button now uses Barba with a smooth fade and lands on the same person.
    - Browser back and forward buttons no longer flash the hero.
  Barba and Scroll
    - Barba timeout increased from 2s to 8s so slow pages do not fall back to full reload.
    - Browser scroll restoration set to manual on all pages.

## [1.1.13] - 2026-10-16

### Updated
  Design Archive Page
    - Update the hover image position.
    - Update there js code so the image will load faster preloader added.
  

## [1.1.12] - 2026-10-15

### Updated
  Design Page
    - Hero Carousel Section hover arrow color change from black to white.
  Atrium Section HomePage
    - Update the design alignment
  Indvidual Atrium page
    - Number now appear in hero section automatically according to there published date.
    

## [1.1.11] - 2026-10-08

### Updated
- Merged developer changes into the main branch.
  - Restored the original `CHANGELOG.md` file.
  - Removed unnecessary Docker configuration changes and phpMyAdmin-related files to preserve the shared server configuration.

## [1.1.10] - 2026-10-08

### Updated
 - Developer changes merged
    - Design Archive Page
      - Update the design according to figma
      - Add JS for the hover effect on that page.
    - Design Page
      - Link in the carousel section is not working added variable for that.

## [1.1.9] - 2026-10-06

### Updated
- Developer changes merged
    - Preloader Update
      - Homepage hero description added to preloader as well.
    - ACF Changing
      - Convert all the text area field into Editor field to have a ability to link any text in the descrioption.
    - Atrium Section & Atrium Page
      - Atrium section new design update implemeted.
      - Story Number now come according to the publication date both on homepage and atrium page
    


## [1.1.8] - 2026-10-06

### Updated

 - Remove deprecated files
   - template-parts/components/design/hero_section.php

### Added

  - Shared component renderer to dynamically load SEO background images


## [1.1.7] - 2026-10-06

### Updated

 - **Hero sections – SEO and image improvements**
  - Added proper semantic **H1 headings** to the Home and Studio hero sections, allowing search engines to correctly identify the page titles while keeping the existing SVG-based design unchanged.
  - Updated the hero SVG lettering to be treated as decorative content.
  - Improved the heading hierarchy on the Home page by changing the secondary hero heading to an **H2**.
  - Replaced CSS background images with WordPress-generated `<img>` elements using `wp_get_attachment_image()`, providing responsive `srcset`/`sizes` markup and better image optimisation.
  - Added fallback support for hero images provided as direct URLs.
  - Optimised hero images for LCP by using eager loading and high fetch priority.

## [1.1.6] - 2026-10-06

### Added

 - Home `about` section

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
