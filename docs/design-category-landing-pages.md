# Design category landing pages: implementation notes (Nov 2026)

Branch: `feature/design-category-landing` (one commit on top of main 65e2949)
Figma: MUL_We Design_V7, frame "SEO PAGE" (node 13100:3632)

## Taxonomies (inc/taxonomies.php)
- `design_category`: public, URL `/architecture/<slug>/` (set by the constant `MULROY_DESIGN_CATEGORY_SLUG`). Terms: home-extensions, basements, renovations, listed-buildings, sustainable-architecture
- `design_sector`: admin only. Terms: residential, commercial, educational
- Terms are created once and rewrite rules are flushed when `MULROY_TAXONOMY_VERSION` changes

## Template
`taxonomy-design_category.php` renders the Dynamic Blocks (`components`) field saved on the term. `components.php` now takes an optional `post_id` arg.

## URL

The base is one line at the top of inc/taxonomies.php:

```php
define('MULROY_DESIGN_CATEGORY_SLUG', 'architecture');
```

To change it, you would:

  1. Change the value, for example to `'services'`. That gives `/services/home-extensions/`.
  2. Flush the permalinks. Go to Settings → Permalinks and click Save. You can also bump `MULROY_TAXONOMY_VERSION` in the same file, which flushes them automatically on the next page load. Until you do one of these, the new URLs return a 404.
  3. Redirect the old URLs. Once the pages are live and indexed by Google, this is the step that matters. WordPress won’t redirect `/architecture/...` to the new base by itself, so without 301s you’d lose the rankings those pages built up. You can add them in Yoast/Rank Math or the Redirection plugin, or with one rule in `.htaccess/Nginx`:`

```bash
   RedirectMatch 301 ^/architecture/(.*)$ /services/$1
```

Changing the base doesn’t touch any content. Each category keeps its blocks, its projects and its own slug (`home-extensions`, etc.); only the URL prefix moves.

Each category’s own slug can also be changed separately in Designs → Categories. That needs a redirect for the same reason.

## How the Figma sections map to blocks
| Figma section | Block |
|---|---|
| Hero (short image, H1, Scroll) | Hero section (existing layout, new `hero/landing.php` variant) |
| Section text (left/right heading, lead, 2 columns) | Landing Text Section (new) |
| Large right-column image | Right Only Content Block (existing, photo only) |
| Portrait left + landscape right | Two Column Left Portrait and Right Landscape Image (new) |
| Featured projects (staggered 4) | Landing Featured Projects (new, auto from category or manual) |
| Services / Areas of Specialism list | Landing Info Table (new) |
| People | People Section (existing, new Layout = Landing) |
| Discuss / View projects links | Landing CTA Links (new) |
| FAQs | FAQ Section Global (new, same fields as the Legal FAQ, outputs FAQPage schema) |

## How apply a git patch

The patch is built on top of `main` at commit `65e2949` ("Merged developer changes into the main branch"). Download **mulroy-category-landing.patch**, then in your local clone:

```bash
cd path/to/mulroy

# 1. Start from an up-to-date main
git checkout main
git pull

# 2. Make a branch for the work
git checkout -b feature/design-category-landing

# 3. Apply the patch as a commit
git am mulroy-category-landing.patch
```

`git am` creates the commit with its message and changelog entry included. Check it with `git log -1` and `git show --stat`; you should see 18 files.

**If `git am` fails** (usually because `main` has moved on since `65e2949` and touches the same files):

```bash
git am --abort                       # back to a clean state
git am -3 ~/Downloads/mulroy-category-landing.patch   # retry with 3-way merge
```

If there are still conflicts, fix the files `git status` lists, then:

```bash
git add <fixed files>
git am --continue
```

**If you only want the changes, not a commit:**

```bash
git apply --check mulroy-category-landing.patch   # dry run
git apply mulroy-category-landing.patch
```

The changes are then left uncommitted, and you commit them yourself.

**After applying:** push the branch (`git push -u origin feature/design-category-landing`) and deploy it to staging. In WP admin, go to ACF → Field Groups and Sync "Dynamic Blocks" so the new blocks appear.

## Deploy checklist
1. Deploy theme, then go to ACF > Field Groups > Sync "Dynamic Blocks"
2. Assign projects to categories and sectors
3. Build each landing page under Designs > Categories > Edit
4. Settings > Permalinks > Save if the URLs return 404
