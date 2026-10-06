<?php
$post_type  = get_post_type();
$hero_image = get_sub_field( 'hero_image' );
$heading    = get_sub_field( 'heading' );
$page_slug  = get_post_field('post_name', get_post()); 
?>
<!-- template-parts/components/hero_section.php -->
<?php
if ( is_front_page() || is_home() ) {
  get_template_part(
    'template-parts/components/hero/main',
    null,
    [
      'hero_image' => $hero_image,
      'heading'    => $heading,
    ]
  );
}

if($post_type=='atriums'){ 
  get_template_part(
    'template-parts/components/hero/atriums',
    null,
    [
      'hero_image' => $hero_image,
      'heading'    => $heading,
    ]
  );
}
 
if($post_type=='post' ){ 
  get_template_part(
    'template-parts/components/hero/posts',
    null,
    [
      'hero_image' => $hero_image,
    ]
  );
}

if($page_slug=='studio'){
  get_template_part(
    'template-parts/components/hero/studio',
    null,
    [
      'hero_image' => $hero_image,
    ]
  );
} ?>