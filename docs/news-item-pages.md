# News articles

Every news article has its own page. The News page and the News section on the home page link to it.

In the admin, WordPress "Posts" are renamed **News**: News > All News / Add News.

## What an article page shows

1. **Hero**: the month and year in large letters, then the date and title over the hero image.
2. **Main text**: the text from the article's editor box. The News page list shows this same text.
3. **Dynamic Blocks**: any extra blocks added in the article's Dynamic Blocks field, in the order they are added.
4. **Navigation**: a back arrow and a "back to top" arrow.

## Managing articles in the CMS

### Creating an article

1. Go to **News > Add News**.
2. Add the **title**. It is the H1 on the article page and the heading in the News list.
3. Write the **main text** in the editor box. Keep it to a short intro, because the News page list shows all of it.
4. Set a **Featured image**. It is used in the News list and as the hero image of the article page.
5. Tick the **News** category. The News page and the home page only list articles in this category.
6. Publish. The article date is the publish date. Change it in the Publish box if needed.

### Adding more content to the article page

The **Dynamic Blocks** field is on the article edit screen. It is the same block library used on the other pages of the site (text, images, two-column layouts, carousel, video and so on). Anything added there appears only on the article page, below the main text. The News list only shows the title, date, main text and featured image.

- **Hero section block**: optional. When the article has one, its image replaces the featured image in the article hero. The block isn't printed a second time further down the page. Use it when the hero needs a different image from the one in the list.
- If an article has neither a Hero section image nor a featured image, the hero shows the orange background used on the News page.

### Choosing which articles are listed

- **News page** (Pages > News): the **Show Selected News** field picks which articles are listed. Leave it empty to list every article in the News category, newest first.
- **Home page** (Pages > Home > Dynamic Blocks > Home Page News Section): the **Select Home Page News** field picks the articles shown on the home page.

### URLs

An article's URL follows the site's permalink setting (Settings > Permalinks) and the article slug, which is editable under the title. If you change the slug after the article is live, add a 301 redirect from the old URL.

## For developers

| File | Purpose |
|---|---|
| `single.php` | Article page (post type `post`): hero, editor text, Dynamic Blocks, navigation |
| `template-parts/components/hero/posts.php` | Article hero (date letters, date, title) |
| `template-parts/news/list-item.php` | One item in the News list, shared by `news-page.php` and the "load more" AJAX list (`inc/loadmore.php`) |
| `inc/news.php` | `mulroy_news_page_url()` (URL of the page using the News Page template, falls back to `/news/`) and `mulroy_news_hero_image()` (image from the Hero section block, otherwise the featured image) |
| `template-parts/components/home_page_news_section.php` | Home page News section, links to the article pages |

Notes:
- `template-parts/components.php` takes an optional `exclude_layouts` arg. `single.php` passes `['hero_section']` because it prints its own hero.
- `right_only_text_paragraph.php` can take the text as `$args['content']`. `single.php` uses it for the editor text, which has already been filtered by `the_content`, so embeds are kept.
- Back arrow: the page-navigation script returns visitors to the page they came from. The link's `href` is the fallback: the referrer when it is on this site, otherwise the News page.
