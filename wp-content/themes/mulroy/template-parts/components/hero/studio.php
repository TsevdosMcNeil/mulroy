<?php
$hero_image  = $args['hero_image'] ?? null;
?>
<!-- template-parts/components/hero/studio.php -->
<section class="scroll-section site-container hero-section-height section-2" id="studio-top">
  <div class="custom-cursor" id="custom-cursor">

  </div>
  <?php if ($hero_image) : 
    get_template_part(
      'template-parts/components/background-image',
      null,
      [
        'image' => $hero_image,
      ]
    );
  endif; ?>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1 class="sr-only"><?php the_title(); ?></h1>
    <div class="content-sect">
      <div class="page-title title-start text-bg">
        <svg width="187" height="249" viewBox="0 0 187 249" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M99.912 248.032C43.8 248.032 4.152 222.832 0.792002 173.104H28.68C32.04 208.048 58.584 224.848 99.576 224.848C133.848 224.848 159.048 208.384 159.048 179.488C159.048 158.32 146.616 146.224 115.368 140.176L69.672 131.104C29.016 123.712 8.52 103.888 8.52 68.944C8.52 28.96 43.128 0.0639742 92.184 0.0639742C142.92 0.0639742 177.528 21.904 182.232 65.584H154.344C150.312 38.704 126.456 23.248 92.52 23.248C58.248 23.248 36.744 42.064 36.744 67.936C36.744 90.448 48.504 99.856 79.416 105.904L126.456 115.648C167.448 124.048 186.936 143.2 186.936 178.144C186.936 219.472 150.648 248.032 99.912 248.032Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> S </span>
      </div>
      <div class="page-title title-start text-bg">
        <svg width="203" height="240" viewBox="0 0 203 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M85.256 240H0.248004V0.0959627H85.256C155.48 0.0959627 202.184 48.144 202.184 120.048C202.184 191.952 155.48 240 85.256 240ZM85.256 215.808C141.704 215.808 172.28 177.84 172.28 120.048C172.28 60.576 140.024 24.288 85.256 24.288H28.808V215.808H85.256Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> D </span>
      </div>
    </div>
    <div class="content-sect">
      <div class="page-title title-center text-bg">
        <svg width="209" height="240" viewBox="0 0 209 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M118.712 240H89.816V24.288H0.440002V0.0959627H208.424V24.288H118.712V240Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> T </span>
      </div>
      <div class="page-title title-center text-bg">
        <svg width="30" height="240" viewBox="0 0 30 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M29.144 240H0.248004V0.0959627H29.144V240Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> I </span>
      </div>
    </div>
    <div class="content-sect">
      <div class="page-title title-end text-bg">
        <svg width="195" height="245" viewBox="0 0 195 245" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> U </span>
      </div>
      <div class="page-title title-end text-bg">
        <svg width="220" height="249" viewBox="0 0 220 249" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
          <path d="M110 248.032C42.8 248.032 0.800002 195.952 0.800002 124.048C0.800002 51.136 44.144 0.0639742 110 0.0639742C175.856 0.0639742 219.2 51.136 219.2 124.048C219.2 195.952 177.2 248.032 110 248.032ZM110 223.504C161.408 223.504 189.296 183.856 189.296 124.048C189.296 65.248 162.08 24.592 110 24.592C58.256 24.592 30.368 65.248 30.368 124.048C30.368 183.184 57.248 223.504 110 223.504Z" fill="#fff"></path>
        </svg>
        <span class="hero-letter" aria-hidden="true"> O </span>
      </div>
    </div>
  </div>
</section>
<!-- End template-parts/components/hero/studio.php -->