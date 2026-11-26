<?php
/**
 * One news item in the News page list (news-page.php and the "load more"
 * AJAX list in inc/loadmore.php). Use inside the loop.
 *
 * The title and the image link to the news item's own page. The wrapper is a
 * div (it used to be an <a> with no href) so links inside the editor text
 * don't end up nested inside another link.
 *
 * When the single pages are turned off (Fento > Single post pages) the title
 * and image are printed without links.
 */
$has_single_page    = mulroy_news_has_single_pages();
$permalink          = $has_single_page ? get_permalink() : '';
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<!-- template-parts/news/list-item.php -->
<section class="scroll-section col-span-12 no_min_height_mobile" id="<?php echo esc_attr(mulroy_news_item_anchor()); ?>">
  <div class="flex flex-col h-full justify-around gap-y-5 lg:grid grid-cols-12 news-post__item gap-x-5">
    <div class="col-span-5">
      <div class="news-content">
        <h2 class="news-heading fs-2xl letter__spacing__custom__-2px">
          <?php if ($has_single_page) : ?>
            <a href="<?php echo esc_url($permalink); ?>" class="inline-flex items-center gap-x-4">
              <?php the_title(); ?>
              <?php
              get_template_part(
                'template-parts/components/icons/arrow',
                null,
                [
                  'arrow_class' => 'site__arrow news-heading-icon',
                ]
              );
              ?>
            </a>
          <?php else : ?>
            <?php the_title(); ?>
          <?php endif; ?>
        </h2>
        <h3 class="news-date uppercase"><?php echo get_the_date('F j, Y'); ?></h3>
        <div class="mt-6 w-full lg:w-[28vw] letter__spacing__custom__-2px">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <div class="col-start-6 col-end-13" id="atrium-post-right-text-image">
      <?php if ($has_single_page) : ?>
        <a
          href="<?php echo esc_url($permalink); ?>"
          class="block w-full relative bg-no-repeat bg-center bg-cover min-h-[40vh] lg:min-h-[40vw]"
          style="background-image: url('<?php echo esc_url($featured_image_url); ?>');"
          aria-label="<?php echo esc_attr(get_the_title()); ?>"
          tabindex="-1">
          <div class="news-page-post-overlay absolute inset-0"></div>
        </a>
      <?php else : ?>
        <div
          class="block w-full relative bg-no-repeat bg-center bg-cover min-h-[40vh] lg:min-h-[40vw]"
          style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
          <div class="news-page-post-overlay absolute inset-0"></div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- End template-parts/news/list-item.php -->
