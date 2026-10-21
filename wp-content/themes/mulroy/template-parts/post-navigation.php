<?php
$id         = $args['id'] ?? '';
$class      = $args['class'] ?? 'bg-site w-full site-container py-8';
$back_url   = $args['back_url'] ?? '';
$top_anchor = $args['top_anchor'] ?? '';
?>
<!-- template-parts/post-navigation.php -->
<div id="<?php echo esc_html($id); ?>"
  class="<?php echo esc_html($class); ?>">
  <div class="flex justify-between">

    <?php if ($back_url): ?>
      <a href="<?php echo esc_url($back_url); ?>" class="js-go-back" data-barba-prevent>
        <span>
          <img
            src="<?php echo esc_url(
                    get_template_directory_uri() .
                      '/assets/media/arrow-left.svg'
                  ); ?>"
            class="site__arrow post__arrow arrow__right"
            alt="Go back">
        </span>
      </a>
    <?php endif ?>
    <?php if ($top_anchor): ?>
      <a href="<?php echo esc_url($top_anchor); ?>" data-barba-prevent>
        <span class="upward__arrow__got__top">
          <img
            src="<?php echo esc_url(
                    get_template_directory_uri() .
                      '/assets/media/arrow-left.svg'
                  ); ?>"
            class="site__arrow post__arrow"
            alt="Go to top">
        </span>
      </a>
    <?php endif ?>

  </div>
</div>
<!-- End template-parts/post-navigation.php -->