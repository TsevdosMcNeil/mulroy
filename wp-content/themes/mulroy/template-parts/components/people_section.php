<?php
//$heading = get_sub_field( 'heading' );

?>

<?php 
	$args = array(
			'post_type'      => 'peoples',   
			'posts_per_page' => -1,           
			'post_status'    => 'publish', 
			'orderby' => 'date',              
            'order' => 'ASC',   
		);
    $atriums_query = new WP_Query($args);
	if ($atriums_query->have_posts()) : 
	    $i=1;
		while ($atriums_query->have_posts()) : $atriums_query->the_post();
		$position = get_field( 'position' );
		$hover_picture = get_field( 'hover_picture' );
		$picture = get_field( 'picture' );

?>
<?php if ($i == 1 || $i == 3 || $i == 5 || $i == 7 || $i == 9 || $i == 11) {  ?>
<section
            class="scroll-section site-container bg-site container-py no_min_height_mobile"
            id="people-most-left-sect"
          >
            <div class="section-inner-container">
<?php } ?>
             <?php if($i==1){ ?>
              <div class="col-span-3 pt-8">
             <?php } if($i==2){?>
               <div class="col-start-8 col-end-11 pt-[7vw] lg:pl-0">
              <?php } if($i==3){?> 
              <div class="col-start-3 col-end-6 lg:pt-[7vw]  lg:pl-[0]">
              <?php } if($i==4){?>
              <div class="col-start-10 col-end-13 pt-[10vw] lg:pt-8">
              <?php }  ?>
              
                <a
                  class="person-card relative w-full flex flex-col"
                  href="<?php echo get_permalink(); ?>"
                >
                  <div
                    class="img-1 w-full inset-0 absolute"
                    
                  >
					<img src='<?php echo $hover_picture; ?>'/>
					</div>
                  <div
                    class="img-2 w-full mb-4"
                   
                  >
				<img src='<?php echo $picture; ?>'/>
</div>
                  <h2 class="person-name fs-2xl">
                    <?php echo get_the_title(); ?>
                    <span>
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/media/Arrow.svg"
                        class="site__arrow person-icon"
                        alt=""
                      />
                    </span>
                  </h2>
                  <h3 class="person-position"><?php echo $position; ?></h3>
                </a>
              </div>

    <?php if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10 || $i == 12) {  ?>
        </div>

          </section>   
				  
      <?php } ?>      
<?php 
$i++;
	endwhile;
	endif;
?>

         

