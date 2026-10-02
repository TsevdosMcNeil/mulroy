<?php
get_header();
global $post;

?>
<!-- single-designs.php -->
<?php
$post_id = get_the_ID();
$post = get_post($post_id);
$position = get_field('position');
$hover_picture = get_field('hover_picture');
$picture = get_field('picture');
?>
<?php
if (have_rows('components')) :
  while (have_rows('components')) : the_row();

    if (get_row_layout() == 'hero_section') {
      include get_theme_file_path('template-parts/components/hero_section.php');
    }
    if (get_row_layout() == 'right_only_content_block') {
      include get_theme_file_path('template-parts/components/right_only_content_block.php');
    }
    if (get_row_layout() == 'two_column_left_image_right_text') {
      include get_theme_file_path('template-parts/components/two_column_left_image_right_text.php');
    }
    if (get_row_layout() == 'two_column_left_text_right_image') {
      include get_theme_file_path('template-parts/components/two_column_left_text_right_image.php');
    }
    if (get_row_layout() == 'centered_banner_image_with_caption') {
      include get_theme_file_path('template-parts/components/centered_banner_image_with_caption.php');
    }
    if (get_row_layout() == 'two_column_left_heading_right_image_and_text') {
      include get_theme_file_path('template-parts/components/two_column_left_heading_right_image_and_text.php');
    }
    if (get_row_layout() == 'three_column_left_image_center_text_right_text') {
      include get_theme_file_path('template-parts/components/three_column_left_image_center_text_right_text.php');
    }
    if (get_row_layout() == 'landscape-img-right-text-left') {
      include get_theme_file_path('template-parts/components/landscape-img-right-text-left.php');
    }
    if (get_row_layout() == 'full_width_big_centered_image') {
      include get_theme_file_path('template-parts/components/full_width_big_centered_image.php');
    }
    if (get_row_layout() == 'three_column_right_image_center_text_left_text') {
      include get_theme_file_path('template-parts/components/three_column_right_image_center_text_left_text.php');
    }
    if (get_row_layout() == 'people_section') {
      include get_theme_file_path('template-parts/components/people_section.php');
    }
    if (get_row_layout() == 'carousel_hero_section') {
      include get_theme_file_path('template-parts/components/carousel_hero_section.php');
    }
    if (get_row_layout() == 'home_page_studio_section') {
      include get_theme_file_path('template-parts/components/home_page_studio_section.php');
    }
    if (get_row_layout() == 'home_page_design_section') {
      include get_theme_file_path('template-parts/components/home_page_design_section.php');
    }
    if (get_row_layout() == 'home_page_news_section') {
      include get_theme_file_path('template-parts/components/home_page_news_section.php');
    }
    if (get_row_layout() == 'home_page_atrium_section') {
      include get_theme_file_path('template-parts/components/home_page_atrium_section.php');
    }
    if (get_row_layout() == 'video_hero_section') {
      include get_theme_file_path('template-parts/components/video_hero_section.php');
    }
    if (get_row_layout() == 'design_page_left_table_right_image_heading') {
      include get_theme_file_path('template-parts/components/design_page_left_table_right_image_heading.php');
    }
    if (get_row_layout() == 'two_column_left_full_image_with_heading_right_text') {
      include get_theme_file_path('template-parts/components/two_column_left_full_image_with_heading_right_text.php');
    }
    if (get_row_layout() == 'two_column_left_landscape_and_righ_portriat_image') {
      include get_theme_file_path('template-parts/components/two_column_left_landscape_and_righ_portriat_image.php');
    }
    if (get_row_layout() == 'two_coulmn_both_side_image') {
      include get_theme_file_path('template-parts/components/two_coulmn_both_side_image.php');
    }

    if (get_row_layout() == 'privacy_policy_section_global') {
      include get_theme_file_path('template-parts/privacy-policy-section.php');
    }
  endwhile;
endif;
?>

<div class="bg-site site-container py-8 col-span-12">
  <div class="flex justify-between">
    <a href="/design">
      <span>
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/media/arrow-left.svg"
          class="site__arrow post__arrow arrow__right"
          alt="Go back" />
      </span>
    </a>
    <a href="#news-top">
      <span>
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
          class="site__arrow post__arrow arrow__up"
          alt="Go up" />
      </span>
    </a>
  </div>
</div>
<?php
$atriumdesc =  get_field('desc', 'option');
$select_page_atrium = get_field('select_page_atrium', 'option');

$args = array(
  'post_type'      => 'atriums',
  'posts_per_page' => 1,
  'post_status'    => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
  'post__in'       => array($select_page_atrium)
);

$posts = get_posts($args);

foreach ($posts as $post) {

  setup_postdata($post);
  $image_url = get_the_post_thumbnail_url($post->ID, 'full');
  $permalink = get_permalink($post->ID);

?>
  <section class="bg-site pt-0">
    <a
      class="lg:grid grid-cols-12 lg:h-[30vw] h-[60vh] atrium-post-at-design-post-page flex flex-col"
      href="<?php echo $permalink; ?>">
      <div
        class="col-start-1 col-end-7 h-full lg:h-full project-mobile-responsive">
        <div class="bg-accent h-full lg:pl-[2vw] atrium__section__design__page">
          <div
            class="design-post-atrium-content relative lg:h-full">
            <div class="content-sect">
              <div
                class="design-post-atrium-text title-start text-black">
                A
              </div>
              <div
                class="design-post-atrium-text title-start text-black">
                I
              </div>
            </div>
            <div class="design-atrium-post-link">
              <div
                class="flex gap-x-5 w-full items-center home-atrium-post-anchor">
                <span
                  class="home-atrium-post-no inline-flex gap-5 fs-2xl items-center letter__spacing__custom__-2px">01
                </span>

                <span class="fs-2xl letter__spacing__custom__-2px">
                  <?php echo $atriumdesc; ?>
                </span>
                <span class="">
                  <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                    class="site__arrow post-icon"
                    alt="" />
                </span>
              </div>
            </div>
            <div class="content-sect">
              <div
                class="design-post-atrium-text title-center text-black">
                T
              </div>
              <div
                class="design-post-atrium-text title-center text-black">
                U
              </div>
            </div>
            <div class="content-sect">
              <div class="design-post-atrium-text title-end text-black">
                R
              </div>
              <div class="design-post-atrium-text title-end text-black">
                M
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-start-7 col-end-13 relative h-full lg:h-full">
        <div
          class="w-full bg-no-repeat bg-center bg-cover h-full"
          style="
                    background-image: url('<?php echo $image_url; ?>');
                  "></div>
        <div
          class="overlay absolute inset-0 bg-black/20 design-atrium-post-overlay"></div>
      </div>
    </a>
  </section>
<?php
}
wp_reset_postdata();
?>
<!-- End single-designs.php -->
<?php get_footer(); ?>