<?php
$title       = $args['title'] ?? 'Mulroy Architects';
$hero_image  = $args['hero_image'] ?? null;
$heading     = $args['heading'] ??  null;
?>
<!-- template-parts/components/hero/main.php -->
<section class="hero-section-height scroll-section site-container border-none home-page" id='top'>
  <div class="custom-cursor" id="custom-cursor"></div>
  <?php if ($hero_image) : ?>
    <div class="hero-background">
      <?php
      if (is_numeric($hero_image)) {
        // WordPress attachment ID
        echo wp_get_attachment_image(
          (int) $hero_image,
          'full',
          false,
          [
            'class'         => 'hero-background-image',
            'alt'           => '',
            'aria-hidden'   => 'true',
            'loading'       => 'eager',
            'fetchpriority' => 'high',
          ]
        );
      } else {
        // Fallback for image URLs
      ?>
        <img
          src="<?php echo esc_url($hero_image); ?>"
          class="hero-background-image"
          alt=""
          aria-hidden="true"
          loading="eager"
          fetchpriority="high">
      <?php
      }
      ?>
    </div>
  <?php endif; ?>
  <div class="hero-overlay"></div>
  <div class="hero-content home-hero">
    <h1 class="sr-only"><?php echo wp_kses_post($title); ?></h1>
    <div class="content-sect">
      <div class="page-title title-start">
        <svg
          width="237"
          height="240"
          viewBox="0 0 237 240"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M236.456 240H208.568V29.664H207.896L129.944 240H106.424L28.472 29.664H27.8V240H0.248004V0.0959627H44.936L118.856 202.368H119.528L193.448 0.0959627H236.456V240Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> M </span>
      </div>
      <?php if ($heading) : ?>
        <h2 class="page-desc home-page-desc letter__spacing__custom__-2px">
          <?php echo wp_kses_post($heading); ?>
        </h2>
      <?php endif; ?>
      <div class="page-title title-start">
        <svg
          width="188"
          height="240"
          viewBox="0 0 188 240"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M187.4 240H154.808L92.648 142.896H28.808V240H0.248004V0.0959627H92.648C147.08 0.0959627 176.984 25.632 176.984 71.328C176.984 106.944 153.464 131.136 121.544 138.528L187.4 240ZM90.968 118.704C126.248 118.704 147.752 103.248 147.752 71.328C147.752 40.752 126.584 24.288 90.968 24.288H28.808V118.704H90.968Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> R </span>
      </div>
    </div>
    <div class="content-sect">
      <div class="page-title title-center">
        <svg
          width="195"
          height="245"
          viewBox="0 0 195 245"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> U </span>
      </div>
      <div class="page-title title-center">
        <svg
          width="220"
          height="249"
          viewBox="0 0 220 249"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M110 248.032C42.8 248.032 0.800002 195.952 0.800002 124.048C0.800002 51.136 44.144 0.0639742 110 0.0639742C175.856 0.0639742 219.2 51.136 219.2 124.048C219.2 195.952 177.2 248.032 110 248.032ZM110 223.504C161.408 223.504 189.296 183.856 189.296 124.048C189.296 65.248 162.08 24.592 110 24.592C58.256 24.592 30.368 65.248 30.368 124.048C30.368 183.184 57.248 223.504 110 223.504Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> O </span>
      </div>
    </div>
    <div class="content-sect">
      <div class="page-title title-end">
        <svg
          width="159"
          height="240"
          viewBox="0 0 159 240"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M158.168 240H0.248004V0.0959627H29.144V215.808H158.168V240Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> L </span>
      </div>
      <div class="page-title title-end">
        <svg
          width="213"
          height="240"
          viewBox="0 0 213 240"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="menu-icon">
          <path
            d="M121 240H92.104V140.544L0.712001 0.0959627H32.632L107.56 114.672H108.232L180.808 0.0959627H212.728L121 140.544V240Z" />
        </svg>
        <span class="hero-letter" aria-hidden="true"> Y </span>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/hero/main.php -->