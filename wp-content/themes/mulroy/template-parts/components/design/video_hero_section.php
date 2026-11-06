<?php

/**
 * Design hero section: image / uploaded video / YouTube / Vimeo / direct video link
 * Controlled via ACF fields on the design_blocks flexible content layout.
 */

$image     = get_sub_field('image');
$image_id  = null;
$image_url = null;

// Support the new ACF Image Array format.
if (is_array($image) && !empty($image['ID'])) {
  $image_id  = $image['ID'];
  $image_url = $image['url'] ?? wp_get_attachment_image_url($image_id, 'full');

  // Backwards compatibility with the old ACF Image URL format.
} elseif (is_string($image) && $image) {
  $image_url = $image;
  $image_id  = attachment_url_to_postid($image);
}

$media_source = get_sub_field('media_source'); // image | upload_video | youtube | vimeo | video_link

$video_file  = get_sub_field('video_file');
$youtube_url = get_sub_field('youtube_url');
$vimeo_url   = get_sub_field('vimeo_url');
$video_link  = get_sub_field('video_link');

$autoplay = get_sub_field('video_autoplay');
$loop     = get_sub_field('video_loop');
$muted    = get_sub_field('video_muted');
$controls = get_sub_field('video_controls');

if (! $media_source) {
  $media_source = 'image';
}

// Sensible defaults if fields are empty/unset on older entries
if ($media_source !== 'image') {
  $autoplay = ($autoplay === '' || $autoplay === null) ? true : (bool) $autoplay;
  $loop     = ($loop === '' || $loop === null) ? true : (bool) $loop;
  $muted    = ($muted === '' || $muted === null) ? true : (bool) $muted;
  $controls = (bool) $controls;

  // Autoplay requires muted in every modern browser.
  if ($autoplay && ! $muted) {
    $muted = true;
  }
}

$youtube_id = '';
if ($media_source === 'youtube' && $youtube_url) {
  preg_match(
    '/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
    $youtube_url,
    $matches
  );
  $youtube_id = $matches[1] ?? '';
}

$vimeo_id = '';
if ($media_source === 'vimeo' && $vimeo_url) {
  preg_match('/vimeo\.com\/(?:.*\/)?(\d+)/', $vimeo_url, $matches);
  $vimeo_id = $matches[1] ?? '';
}

$native_src = '';
if ($media_source === 'upload_video') {
  $native_src = $video_file;
} elseif ($media_source === 'video_link') {
  $native_src = $video_link;
}

?>

<!-- template-parts/components/design/video_hero_section.php -->
<section class="scroll-section" id="news-top">

  <div class="hero-background"></div>
  <div class="hero-overlay z-20"></div>

  <div class="hero-content">
    <div class="video-player w-full h-full overflow-hidden design-hero-media-wrap">

      <?php if ($native_src): ?>

        <video
          class="top-0 relative z-[-1] md:left-0 xl:w-full bg-gray-400 bg-cover bg-center h-full xl:h-auto"
          <?php echo $autoplay ? 'autoplay' : ''; ?>
          <?php echo $loop ? 'loop' : ''; ?>
          <?php echo $muted ? 'muted' : ''; ?>
          <?php echo $controls ? 'controls' : ''; ?>
          playsinline
          preload="metadata"
          src="<?php echo esc_url($native_src); ?>">
        </video>

      <?php elseif ($youtube_id):

        $yt_params = [
          'autoplay'       => $autoplay ? 1 : 0,
          'mute'           => $muted ? 1 : 0,
          'loop'           => $loop ? 1 : 0,
          // YouTube's loop param only works when combined with playlist=<same id>
          'playlist'       => $loop ? $youtube_id : '',
          'controls'       => $controls ? 1 : 0,
          'modestbranding' => 1,
          'rel'            => 0,
          'iv_load_policy' => 3,
          'playsinline'    => 1,
          'disablekb'      => 1,
        ];
        $yt_src = 'https://www.youtube.com/embed/' . $youtube_id . '?' . http_build_query($yt_params);
      ?>

        <div class="design-hero-media--embed">
          <iframe
            src="<?php echo esc_url($yt_src); ?>"
            title="Hero video"
            frameborder="0"
            allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
            <?php echo $controls ? '' : 'tabindex="-1"'; ?>
            allowfullscreen></iframe>
        </div>

      <?php elseif ($vimeo_id):

        $vimeo_params = [
          'autoplay'    => $autoplay ? 1 : 0,
          'muted'       => $muted ? 1 : 0,
          'loop'        => $loop ? 1 : 0,
          'controls'    => $controls ? 1 : 0,
          'title'       => 0,
          'byline'      => 0,
          'portrait'    => 0,
          'transparent' => 0,
          'dnt'         => 1,
        ];
        $vimeo_src = 'https://player.vimeo.com/video/' . $vimeo_id . '?' . http_build_query($vimeo_params);
      ?>

        <div class="design-hero-media--embed">
          <iframe
            src="<?php echo esc_url($vimeo_src); ?>"
            title="Hero video"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            <?php echo $controls ? '' : 'tabindex="-1"'; ?>
            allowfullscreen></iframe>
        </div>

      <?php elseif ($image_id): ?>

        <?php
        echo wp_get_attachment_image(
          $image_id,
          'full',
          false,
          [
            'class' => 'w-full h-full object-cover',
          ]
        );
        ?>

      <?php elseif ($image_url): ?>

        <!-- Legacy fallback for an image URL that cannot be resolved
             to a WordPress Media Library attachment. -->
        <img
          src="<?php echo esc_url($image_url); ?>"
          alt=""
          class="w-full h-full object-cover" />

      <?php endif; ?>

    </div>
  </div>

  <div class="news-post-hero-content design-post-hero-content site-container z-20">

    <h3 class="fs-lg">
      <?php echo esc_html(get_the_date('F j, Y')); ?>
    </h3>

    <h2 class="fs-3xl lg:max-w-[35vw]">
      <?php the_title(); ?>
    </h2>

  </div>

</section>

<?php if ($youtube_id || $vimeo_id): ?>
  <style>
    /* Full-bleed cropping for iframe embeds (YouTube/Vimeo). */
    .design-hero-media-wrap {
      position: relative;
    }

    .design-hero-media--embed {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
      transform: translate(-50%, -50%);
      pointer-events: <?php echo $controls ? 'auto' : 'none'; ?>;
    }

    .design-hero-media--embed iframe {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100vw;
      height: 56.25vw;
      /* 16:9 */
      min-height: 100vh;
      min-width: 177.78vh;
      /* 16:9 */
      transform: translate(-50%, -50%);
    }
  </style>
<?php endif; ?>
<!-- template-parts/components/design/video_hero_section.php -->