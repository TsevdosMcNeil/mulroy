<?php
$hero_image  = $args['hero_image'] ?? null;

$published_date = get_the_date('Y-m-d');
$month_number = get_the_date('m');
$year_last_two = get_the_date('y');
$years = str_split($year_last_two);
$months = str_split($month_number);
?>
<!-- template-parts/components/hero/posts.php -->
<section class="scroll-section site-container hero-section-height" id="news-top">
<?php if ($hero_image) : 
    get_template_part(
      'template-parts/components/hero/background',
      null,
      [
        'image' => $hero_image,
      ]
    );
  endif; ?>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="content-sect">
      <div class="page-title title-start text-bg">
        <span class="hero-letter news-hero-letter"> <?php echo $months[0]; ?> </span>
      </div>
      <div class="page-title title-start text-bg">
        <span class="hero-letter news-hero-letter"> <?php echo $months[1]; ?> </span>
      </div>
    </div>
    <div class="content-sect">
      <div class="page-title title-end text-bg">
        <span class="hero-letter news-hero-letter"> <?php echo $years[0]; ?> </span>
      </div>
      <div class="page-title title-end text-bg">
        <span class="hero-letter news-hero-letter"> <?php echo $years[1]; ?> </span>
      </div>
    </div>
  </div>
  <div class="news-post-hero-content site-container">
    <h2 class="fs-lg"><?php echo $published_date = get_the_date('F j, Y'); ?></h2>
    <h1 class="fs-3xl lg:max-w-[35vw]"><?php the_title(); ?></h1>
  </div>
</section>
<!-- End template-parts/components/hero/posts.php -->