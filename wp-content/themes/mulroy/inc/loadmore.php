<?php
    $paged = isset($_POST['page']) ? $_POST['page'] : 1;
    
    $args = array(
    'post_type' => 'post',            
    'posts_per_page' => 3,           
    'category_name' => 'news',       
    'orderby' => 'date',              
    'order' => 'DESC', 
	'paged'          => $paged
);

$news_query = new WP_Query($args);

if ($news_query->have_posts()) :
    while ($news_query->have_posts()) : $news_query->the_post();
     $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');   
?>

              <?php get_template_part('template-parts/news/list-item'); ?>
   <?php
    endwhile;
    endif;
   ?>