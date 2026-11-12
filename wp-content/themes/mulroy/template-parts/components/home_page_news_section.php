<?php
$top_heading = get_sub_field('top_heading');
$top_heading_link = get_sub_field('top_heading_link');
$bottom_heading = get_sub_field('bottom_heading');
$desc = get_sub_field('desc');
$bottom_link = get_sub_field('bottom_link');
$select_home_page_news = get_sub_field('select_home_page_news');
?>
<!-- template-parts/components/home_page_news_section.php -->
<section class="scroll-section section-3 bg-site no_min_height_mobile pb-0 justify-between">
  <div class="page-bar md:py-[1vw] hover-orange">
    <a href="<?php echo $top_heading_link; ?>" class="page-bar-link">
      <span class="content letter__spacing__custom__-3-25px"> <?php echo $top_heading; ?> </span>
      <?php
        get_template_part(
          'template-parts/components/icons/arrow',
          null,
          [
            'container_class' => 'arrow-content',
            'arrow_class' => 'w-5 md:w-10',
          ]
        );
      ?>
    </a>
  </div>
  <div class="news-container px-[2rem] lg:px-0 lg:mt-[3vw] section__copy__content">
    <div class="col-span-12 lg:col-start-6 lg:col-end-13">
      <div class="news-sect-description fs-2xl mb-10 lg:mb-[2vw] letter__spacing__custom__-2px">
        <?php echo $desc; ?>
      </div>
    </div>
    <div class="news-list col-span-12 lg:col-start-6 lg:col-end-13">
      <div class="col-start-3 col-end-7">
        <ul class="flex flex-col">
          <?php
          $args = array(
            'category_name' => 'news',
            'numberposts' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__in' => $select_home_page_news
          );

          $posts = get_posts($args);

          foreach ($posts as $post) {
            setup_postdata($post);

            $image_url = get_the_post_thumbnail_url($post->ID, 'full');

            // Link to the news item's own page
            $permalink = get_permalink($post->ID);
          ?>
            <li class="news-post__items">
              <a
                href="<?php echo $permalink; ?>"
                data-image="<?php echo $image_url; ?>"
                class="home-news-post-item">
                <span class="home-news-date letter__spacing__custom__-2px"><?php echo get_the_date('M y'); ?></span>
                <span class="news-post-title letter__spacing__custom__-2px">
                  <?php the_title(); ?>
                  <?php
                    get_template_part(
                      'template-parts/components/icons/arrow',
                      null,
                      [
                        'arrow_class' => 'site__arrow home-news-post-arrow',
                      ]
                    );
                  ?>
                </span>
              </a>
            </li>
          <?php
          }
          wp_reset_postdata();
          ?>


        </ul>
      </div>
    </div>
    <div class="col-start-1 col-end-5 pl-[2rem] row-start-2">
      <div class="hover-image-section col-span-2">
        <div class="w-full h-[20vw] news-post-image"></div>
      </div>
    </div>
  </div>
  <div class="page-bar md:py-[1vw] hover-orange">
    <a href="<?php echo $bottom_link; ?>" class="page-bar-link">
      <span class="content letter__spacing__custom__-3-25px"><?php echo $bottom_heading; ?> </span>
      <?php
        get_template_part(
          'template-parts/components/icons/arrow',
          null,
          [
            'container_class' => 'arrow-content',
            'arrow_class' => 'w-5 md:w-10',
          ]
        );
      ?>
    </a>
  </div>
</section>
<!-- End template-parts/components/home_page_news_section.php -->