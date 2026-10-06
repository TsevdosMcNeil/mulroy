<?php
$desc = get_sub_field('desc');
$select_home_page_atrium = get_sub_field('select_home_page_atrium');
?>
<?php

// Get all published Atrium posts ordered by newest first
$all_atriums = get_posts([
  'post_type'      => 'atriums',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'fields'         => 'ids',
]);

// Find the position of the selected Atrium post
$atrium_number = array_search($select_home_page_atrium, $all_atriums);

if ($atrium_number !== false) {
  $atrium_number = str_pad($atrium_number + 1, 2, '0', STR_PAD_LEFT);
} else {
  $atrium_number = '01';
}

$args = array(
  'post_type'      => 'atriums',
  'posts_per_page' => 1,
  'post_status'    => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
  'post__in'       => array($select_home_page_atrium)
);

$posts = get_posts($args);

foreach ($posts as $post) {

  setup_postdata($post);
  //$image_url      = get_the_post_thumbnail_url($post->ID, 'full');
  $post_thumbnail = get_post_thumbnail_id($post->ID, 'full');
  $permalink      = get_permalink($post->ID);

?>
  <!-- template-parts/components/home_page_atrium_section.php -->
  <section class="scroll-section site-container hero-section-height atrium-section_home">
    <div class="hero-background bg-accent"></div>
    <div class="hero-content atrium-section_hero">
      <div class="content-sect">
        <div class="page-title title-start text-black">
          <svg
            width="228"
            height="241"
            viewBox="0 0 228 241"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M227.848 240.5H197.608L171.064 173.636H56.152L29.608 240.5H0.712001L97.816 0.595963H130.408L227.848 240.5ZM161.656 149.78L114.28 29.492H113.272L65.56 149.78H161.656Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black"> A </span>
        </div>
        <div class="page-title title-start text-black">
          <svg
            width="30"
            height="241"
            viewBox="0 0 30 241"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M29.144 240.5H0.248004V0.595963H29.144V240.5Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black">I </span>
        </div>
      </div>
      <div class="home-atrium-post-desc letter__spacing__custom__-1px">
        <?php echo $desc; ?>
      </div>
      <div class="home-atrium-post">
        <a
          href="<?php echo $permalink; ?>"
          class="flex flex-col lg:flex-row justify-start w-full lg:items-center home-atrium-post-anchor gap-y-5 gap-x-[37px]">
          <span
            class="home-atrium-post-no inline-flex gap-5 fs-3xl items-center letter__spacing__custom__-3-25px">
            <?php echo $atrium_number; ?>

          </span>
          <span class="fs-3xl atrium-title-home w-auto letter__spacing__custom__-3-25px">
            <?php the_title(); ?>
          </span>
          <?php
          get_template_part(
            'template-parts/components/icons/arrow',
            null,
            [
              'arrow_class' => 'site__arrow w-[46px] h-[45px]',
              'container_class' => 'home-atrium-post-icon',
            ]
          );
          ?>
        </a>
      </div>

      <div class="home-atrium-post home-atrium-post__mobile">
        <a
          href="<?php echo $permalink; ?>"
          class="flex flex-col lg:flex-row justify-between w-full lg:items-center home-atrium-post-anchor gap-y-12">
          <div class="new__design__home__atrium">

            <span
              class="home-atrium-post-no inline-flex gap-5 fs-3xl items-center letter__spacing__custom__-3-25px">01
              <?php
              get_template_part(
                'template-parts/components/icons/arrow',
                null,
                [
                  'arrow_class' => 'site__arrow',
                  'container_class' => 'home-atrium-post-icon',
                ]
              );
              ?>
            </span>
            <span class="fs-2xl letter__spacing__custom__-3-25px">
              <?php the_title(); ?>
            </span>

          </div>
          <?php
          get_template_part(
            'template-parts/components/column-image',
            null,
            [
              'image'   => $post_thumbnail,
              'image_class' => "atruim__home__image__background__fit",
              'image_wrap' => 'none',
            ]
          );
          ?>

        </a>
      </div>

      <div class="content-sect">
        <div class="page-title title-center text-black">
          <svg
            width="209"
            height="240"
            viewBox="0 0 209 240"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M118.712 240H89.816V24.288H0.440002V0.0959627H208.424V24.288H118.712V240Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black"> T </span>
        </div>
        <div class="page-title title-center text-black">
          <svg
            width="195"
            height="245"
            viewBox="0 0 195 245"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black"> U </span>
        </div>
      </div>
      <div class="content-sect">
        <div class="page-title title-end text-black">
          <svg
            width="188"
            height="240"
            viewBox="0 0 188 240"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M187.4 240H154.808L92.648 142.896H28.808V240H0.248004V0.0959627H92.648C147.08 0.0959627 176.984 25.632 176.984 71.328C176.984 106.944 153.464 131.136 121.544 138.528L187.4 240ZM90.968 118.704C126.248 118.704 147.752 103.248 147.752 71.328C147.752 40.752 126.584 24.288 90.968 24.288H28.808V118.704H90.968Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black"> R </span>
        </div>
        <div class="page-title title-end text-black">
          <svg
            width="237"
            height="240"
            viewBox="0 0 237 240"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="menu-icon">
            <path
              d="M236.456 240H208.568V29.664H207.896L129.944 240H106.424L28.472 29.664H27.8V240H0.248004V0.0959627H44.936L118.856 202.368H119.528L193.448 0.0959627H236.456V240Z"
              fill="black" />
          </svg>
          <span class="hero-letter text-black"> M </span>
        </div>
      </div>
    </div>
  </section>
  <!-- End template-parts/components/home_page_atrium_section.php -->
<?php
}
wp_reset_postdata();
?>