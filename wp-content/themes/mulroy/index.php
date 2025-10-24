<?php 
get_header(); 

global $post;
$page_id = get_the_ID();
?>
 
      <!-- Latest Story Section -->
      <section class="pt-[15vh] pb-20 xl:pb-[20vh]" id="latest-news-sect">
        <div class="site-container mt-10">
          <div class="relative pt-10 gap-10">
            <div
              class="absolute top-0 left-0 bg-black h-[1px] page-border w-[0%]"
            ></div>
			<?php 
				$args = array(
					'posts_per_page' => 1,   // Only retrieve one post
					'orderby'        => 'date', // Order by the date (most recent)
					'order'          => 'DESC'  // Show the most recent post first
				);
			$latest_post_query = new WP_Query( $args );

			if ( $latest_post_query->have_posts() ) {
				while ( $latest_post_query->have_posts() ) {
					$latest_post_query->the_post();
			if ( have_rows( 'dynamic_block' ) ) :
			while ( have_rows( 'dynamic_block' ) ) : the_row();	
            if ( get_row_layout() == 'top_banner_block' ) {			
					$banner_image = get_sub_field( 'banner_image' );
                    $banner_text    = get_sub_field( 'banner_text' );

        ?>
            <article class="latest-news-article">
              <a
                href="<?php the_permalink(); ?>"
                class="grid grid-cols-1 md:grid-cols-6 gap-y-10"
              >
                <div
                  class="latest-article-meta col-span-2 md:col-span-3 lg:col-span-3 xl:col-span-2 flex flex-col justify-between gap-y-10"
                >
                  <div
                    class="latest-news-title main-heading font-light col-span-2 on-scroll-fade-in"
                    style="line-height: 0.7"
                  >
                    <h1>Latest Story</h1>
                  </div>
                  <div class="latest-article-headings-meta">
                    <div
                      class="post-title font-bold latest-article-heading on-scroll-fade-in"
                    >
                      <h2 class=""><?php the_title(); ?></h2>
                      <p class=""><?php the_time('j F Y'); ?></p>
                    </div>
                    <div
                      class="article-desc text-black main-text my-4 max-w-lg pr-5 on-scroll-fade-in"
                    >
                      <p>
                       <?php echo $banner_text; ?>
                      </p>
                    </div>
                    <div
                      class="text-green-600 font-bold main-text hover:underline article-link on-scroll-fade-in"
                    >
                      <span> 
              Read more</span>
                    </div>
                  </div>
                </div>
                <div
                  class="col-span-5 lg:col-span-3 xl:col-span-4 latest-news-img-sect on-scroll-fade-in"
                >
                  <div
                    class="w-full h-full bg-no-repeat aspect-video object-cover bg-center"
                    style="
                      background-image: url('<?php echo $banner_image; ?>');
                    "
                  ></div>
                </div>
              </a>
            </article>
			    <?php
				}
			
	     endwhile;
		endif; 
					}
					wp_reset_postdata();
				} else {
					echo 'No posts found.';
				}
				?>
          </div>
        </div>
      </section>
      <!-- All Articles Section -->
      <section class="w-full pb-20" id="articles-list-sect">
        <div class="site-container">
          <!-- heading section -->
          <div class="flex justify-between items-center mb-[13vh]">
            <div class="section-title main-heading font-light">
              <h2>All Articles</h2>
            </div>
            <div
              class="flex items-center space-x-4 border-b-2 border-green-600 custom-select-container"
            >
              <div class="select-button font-bold text-green w-full sub-text">
                Filter
              </div>
              <div class="options-container">
			  <?php 
			  $categories = get_categories();
              foreach ($categories as $category) {
			  ?>
                <div class="option" data-value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></div>
              <?php } ?>
              </div>
            </div>
          </div>
          <!-- Articles Grid -->
          <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-[2.6vw] gap-y-10 xl:gap-y-[12vh]"
            id="all-the-news-list"
          >
		  
		  <?php
		  if($_GET['category_slug']){
		   $category_slug = $_GET['category_slug'];
		  }
			if(isset($_POST['page'])){
			 $paged = $_POST['page'] + 1;
			}else{
			  $paged =1;	
			}
			if($_GET['category_slug']){
				
			$the_query = get_posts(array(
			                'category_name' => $category_slug,
							'post_status' => 'publish',
							'posts_per_page' => get_option('posts_per_page'),
							'paged' => $paged
						));
           }else{
			   $the_query = get_posts(array(
							'post_status' => 'publish',
							'posts_per_page' => get_option('posts_per_page'),
							'paged' => $paged
						));
		   }
		  
			foreach($the_query as $row_sub_menu){
				$post_id =  $row_sub_menu->ID;
				$post_title =  $row_sub_menu->post_title;
				$featured_img = get_the_post_thumbnail_url($post_id, 'full');
				$permalink = get_permalink($post_id);
				if ( have_rows( 'dynamic_block', $post_id  ) ) :
			while ( have_rows( 'dynamic_block',$post_id  ) ) : the_row();	
            if ( get_row_layout() == 'top_banner_block' ) {			
					$banner_image = get_sub_field( 'banner_image',$post_id  );
                    $banner_text    = get_sub_field( 'banner_text',$post_id  );
				
			?>
		  
            <article class="news-article on-scroll-fade-in">
              <!-- Article image placeholder -->
              <div
                class="bg-gray-200 mb-4 bg-center article-img h-[40vh]"
                style="background-image: url('<?php echo $featured_img; ?>')"
              ></div>
              <!-- article content -->
              <div
                class="post-title text-black font-bold article-heading mt-[3vh]"
                style="line-height: 1.1"
              >
                <h3 class=""><?php echo $post_title; ?></h3>
                <p class=""><?php the_time('j F Y'); ?></p>
              </div>
              <div
                class="article-desc main-text my-1 md:my-1 lg:my-[3vh] w-full xl:max-w-[20vw]"
              >
                <p>
                  <?php echo $banner_text; ?>
                </p>
              </div>
              <div
                class="article-link main-text font-bold text-green hover:underline"
              >
                <a href="<?php echo $permalink; ?>">Read more</a>
              </div>
            </article>
           
		     <?php 
			 }
	     endwhile;
		endif; 
			wp_reset_postdata();
		
		}

	  ?>   
           
   
          </div>
<?php 
if($_GET['category_slug']){
         $total_query = get_posts(array(
		                     'category_name' => $category_slug,
							'post_status' => 'publish',
							'posts_per_page' => -1,
						));
}else{
	  $total_query = get_posts(array(
							'post_status' => 'publish',
							'posts_per_page' => -1,
						));
}					
?>

          <!-- View More Button -->
		  <?php if(count($total_query) > get_option('posts_per_page')){ ?>
          <div
            class="text-center mt-[15vh] mb-[5vh] view-more-btn text-lg md:text-xl lg:text-2xl font-bold text-green underline load-more-wrapper"
          >
		  <button id="load-more" data-page="1"  data-url="<?php echo admin_url('admin-ajax.php'); ?>">Load More</button>

          </div>
		  <?php } ?>
        </div>
      </section>
	
     	  	  
<?php get_footer(); ?>