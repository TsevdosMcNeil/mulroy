<?php
get_header();
?>
<!-- single-peoples.php -->
<?php
get_template_part('template-parts/components');

$position = get_field('position');
$hover_picture = get_field('hover_picture');
$picture = get_field('picture');
?>
<div class="scroll-section py-8 pt-[5rem] lg:h-[100vh]  lg:py-12 bg-site">
  <a href="/studio#<?php echo get_post_field('post_name', get_the_ID()); ?>"
    class="absolute person-profile-cross z-20 lg:top-[1vw] lg:right-[1vw] top-[1rem] right-[2rem]"><span>
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/media/X.svg"
        class="site__arrow w-[2.5rem] lg:w-[2.5rem]"
        alt="" /> </span></a>
  <section class="site-container bg-site h-full">
    <div class="section-inner-container ">
      <div class="col-start-1 col-end-5">
        <div
          class="img-1 w-full h-[30rem] lg:h-full bg-cover image-container" style='background-image:url("<?php echo $picture; ?>")'>
        </div>
      </div>
      <div class="col-start-8 col-end-13">
        <div
          class="person-profile flex justify-between flex-col h-full">
          <div class="person-content">
            <div class="person-bio mb-10">
              <h2 class="person-name fs-3xl letter__spacing__custom__-3-25px"><?php echo get_the_title(); ?></h2>
              <h3 class="person-page-position fs-xl tracking-[3px] lg:tracking-auto uppercase"><?php echo $position; ?></h3>
            </div>
            <div class="person-desc letter__spacing__custom__-2px">
              <?php the_content(); ?>
            </div>
          </div>
          <div class="persons-nav flex justify-between mt-10 lg:mt-0">
            <?php $next_post = get_next_post();
            $prev_post = get_previous_post();

            // Loop around: last person -> first, first person -> last.
            if (!$next_post) {
              $next_post = get_posts([
                'post_type'      => get_post_type(),
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'ASC',
              ])[0] ?? null;
            }
            if (!$prev_post) {
              $prev_post = get_posts([
                'post_type'      => get_post_type(),
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'orderby'        => 'date',
                'order'          => 'DESC',
              ])[0] ?? null;
            } ?>
            <a href="<?php echo get_permalink($prev_post->ID); ?>" class='gray-hover-icon'>
              <span><img
                  src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                  class="site__arrow rotate-180"
                  alt="site-arrow" /></span>
            </a>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class='gray-hover-icon'>
              <span><img
                  src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                  class="site__arrow"
                  alt="site-arrow" /></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- End single-peoples.php -->
<?php get_footer(); ?>