<?php 
/*
Template Name: Blog Page
*/

get_header(); 
?>
<?php
global $post;

?>
 
jjjjjjjjjjj
      <!-- banner section -->
      <section class="flex items-center retreat-banner relative" style="height:auto; padding: 75px 0; min-height:50vh;">
        <div class="container px-5">
          <div class="flex flex-col lg:flex-row lg:justify-between gap-y-5">
            <div
              class="banner-text w-full lg:w-1/2 flex flex-col gap-y-5 relative z-10"
            >
              <div class="event-title">
                <h1 class="text-6 font-serif text-white"><?php echo $post->post_title; ?></h1>
              </div>
              <div class="event-desc">
                <p class="text-2 text-white text-center">
                  <?php echo $post->post_content; ?>
                </p>
              </div>
            </div>
            <div
              class="z-10 self-end w-full flex justify-center items-end lg:w-1/4 banner-arrow"
            >
              <a href="#event"
                ><img
                  src="<?php bloginfo( 'template_url' ); ?>/assets/images/white-arrow.svg"
                  alt=""
                  class="w-1/3 sm:w-full"
              /></a>
            </div>
          </div>
        </div>
      </section>

      <!-- contact-us-form -->
      <section class="blogs-sect">
        <div class="container">
          <ul
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 py-20 gap-x-5 gap-y-20 masonry-grid"
          >
		  <li class="masonry-sizer"></li> <!-- Sizer to define column width -->
		<?php
    $category_slug = 'retreat-news';
	if(isset($_POST['page'])){
	 $paged = $_POST['page'] + 1;
	}else{
	  $paged =1;	
	}
	$the_query = get_posts(array(
//					'category_name' => $category_slug,
					'post_status' => 'publish',
					'posts_per_page' => get_option('posts_per_page'),
                    'paged' => $paged
				));

    foreach($the_query as $row_sub_menu){
		$post_id =  $row_sub_menu->ID;
		$featured_img = get_the_post_thumbnail_url($post_id, 'full');
		$permalink = get_permalink($post_id);
        $excerpt = get_the_excerpt($post_id);
		$date = strtotime($row_sub_menu->post_date);
		
    ?>
	  
            <li  class="masonry-item">
              <div class="blog-img">
                <img
                  src="<?php echo $featured_img; ?>"
                  class="w-full h-full"
                  alt=""
                />
              </div>
              <div class="blog-date mt-5">
                <p><?php  echo date('F j, Y', $date); ?></p>
              </div>
              <div class="blog-header mt-4 mb-5">
                <h3 class="font-serif text-2 mb-2"><?php echo $row_sub_menu->post_title;  ?></h3>
                <p>
                  <?php echo word_count($excerpt,20); ?><span>...</span>
                </p>
              </div>
              <div>
                <a
                  href="<?php echo $permalink; ?>"
                  class="font-serif border rounded-full py-2 px-3"
                  style="border-color: #707070"
                  >Read More</a
                >
              </div>
            </li>
          <?php 
		}

	  ?>  
            
          </ul>
		  <!-- Load More Button -->
<div class="load-more-wrapper">
    <button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Load More</button>
</div>
        </div>
      </section>
<?php get_footer(); ?>