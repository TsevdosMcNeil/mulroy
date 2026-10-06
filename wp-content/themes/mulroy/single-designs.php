<?php
get_header();
?>
<!-- single-designs.php -->
<?php
get_template_part('template-parts/components');
get_template_part(
  'template-parts/post-navigation',
  null,
  [
    'class'      => 'bg-site site-container py-8 col-span-12',
    'back_url'   => '/design',
    'top_anchor' => "#news-top"
  ]
);

$position = get_field('position');
$hover_picture = get_field('hover_picture');
$picture = get_field('picture');
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