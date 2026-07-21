<?php
$post_type = get_post_type();
$hero_image = get_sub_field( 'hero_image' );
$heading = get_sub_field( 'heading' );
?>
<!-- hero section -->
<?php
if ( is_front_page() || is_home() ) {
 ?>
          <section class="hero-section-height scroll-section site-container border-none home-page" id='top'>
			  <div class="custom-cursor" id="custom-cursor"></div>
            <div
              class="hero-background"
              style="background-image: url('<?php echo $hero_image; ?>')"
            ></div>
            <div class="hero-overlay"></div>
            <div class="hero-content home-hero">
              <div class="content-sect">
                <div class="page-title title-start">
                  <svg
                    width="237"
                    height="240"
                    viewBox="0 0 237 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M236.456 240H208.568V29.664H207.896L129.944 240H106.424L28.472 29.664H27.8V240H0.248004V0.0959627H44.936L118.856 202.368H119.528L193.448 0.0959627H236.456V240Z"
                    />
                  </svg>
                  <span class="hero-letter"> M </span>
                </div>
                <div class="page-desc home-page-desc letter__spacing__custom__-2px">
                  <?php echo $heading; ?>
                </div>
                <div class="page-title title-start">
                  <svg
                    width="188"
                    height="240"
                    viewBox="0 0 188 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M187.4 240H154.808L92.648 142.896H28.808V240H0.248004V0.0959627H92.648C147.08 0.0959627 176.984 25.632 176.984 71.328C176.984 106.944 153.464 131.136 121.544 138.528L187.4 240ZM90.968 118.704C126.248 118.704 147.752 103.248 147.752 71.328C147.752 40.752 126.584 24.288 90.968 24.288H28.808V118.704H90.968Z"
                    />
                  </svg>
                  <span class="hero-letter"> R </span>
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
                    class="menu-icon"
                  >
                    <path
                      d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z"
                    />
                  </svg>
                  <span class="hero-letter"> U </span>
                </div>
                <div class="page-title title-center">
                  <svg
                    width="220"
                    height="249"
                    viewBox="0 0 220 249"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M110 248.032C42.8 248.032 0.800002 195.952 0.800002 124.048C0.800002 51.136 44.144 0.0639742 110 0.0639742C175.856 0.0639742 219.2 51.136 219.2 124.048C219.2 195.952 177.2 248.032 110 248.032ZM110 223.504C161.408 223.504 189.296 183.856 189.296 124.048C189.296 65.248 162.08 24.592 110 24.592C58.256 24.592 30.368 65.248 30.368 124.048C30.368 183.184 57.248 223.504 110 223.504Z"
                    />
                  </svg>
                  <span class="hero-letter"> O </span>
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
                    class="menu-icon"
                  >
                    <path
                      d="M158.168 240H0.248004V0.0959627H29.144V215.808H158.168V240Z"
                    />
                  </svg>
                  <span class="hero-letter"> L </span>
                </div>
                <div class="page-title title-end">
                  <svg
                    width="213"
                    height="240"
                    viewBox="0 0 213 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M121 240H92.104V140.544L0.712001 0.0959627H32.632L107.56 114.672H108.232L180.808 0.0959627H212.728L121 140.544V240Z"
                    />
                  </svg>
                  <span class="hero-letter"> Y </span>
                </div>
              </div>
            </div>
          </section>
 <?php
}
?>
<?php if($post_type=='atriums'){ ?>
    <section class="scroll-section site-container hero-section-height" id="atrium-top">
		<div class="custom-cursor" id="custom-cursor">
				  
			  </div>
        <div
            class="hero-background"
            style="
                background-image: url('<?php echo $hero_image; ?>');
              "
            ></div>
            <div class="hero-overlay"></div>
            <div class="atrium-hero-content site-container">
              <h3 class="fs-lg uppercase "><?php echo $heading; ?></h3>
              <h2 class="fs-3xl lg:max-w-[35vw] mt-4 letter__spacing__custom__-3-25px">
                <?php the_title(); ?>
              </h2>
        </div>
    </section>
<?php } ?>

<?php if($post_type=='post'){ ?>
<?php
	 $published_date = get_the_date('Y-m-d'); 
	 $month_number = get_the_date('m');
     $year_last_two = get_the_date('y'); 
	 $years = str_split($year_last_two);
	 $months = str_split($month_number);
 ?>
              <section class="scroll-section site-container hero-section-height" id="news-top">
            <div
              class="hero-background"
              style="
                background-image: url('<?php echo $hero_image; ?>');
              "
            ></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
              <div class="content-sect">
                <div class="page-title title-start text-bg">
                  <!--<svg
                    width="191"
                    height="249"
                    viewBox="0 0 191 249"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M95.568 248.032C37.104 248.032 0.144002 195.952 0.144002 124.048C0.144002 52.144 37.104 0.0639742 95.568 0.0639742C154.704 0.0639742 190.992 52.48 190.992 124.048C190.992 195.616 154.704 248.032 95.568 248.032ZM95.568 223.168C138.576 223.168 161.76 184.192 161.76 124.048C161.76 63.904 138.576 24.928 95.568 24.928C51.888 24.928 29.712 64.912 29.712 124.048C29.712 183.184 51.888 223.168 95.568 223.168Z"
                      fill="#F7EDE5"
                    />
                  </svg>-->
                  <span class="hero-letter news-hero-letter"> <?php echo $months[0]; ?> </span>
                </div>
                <div class="page-title title-start text-bg">
                 <!-- <svg
                    width="166"
                    height="244"
                    viewBox="0 0 166 244"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M165.08 244H0.440002V230.896C0.440002 197.632 24.296 169.072 77.384 136.144C123.08 106.576 135.176 90.784 135.176 69.952C135.176 43.408 118.712 24.256 86.456 24.256C54.872 24.256 34.376 47.44 32.36 78.016H5.144C7.832 33.664 37.736 0.0639742 86.792 0.0639742C134.504 0.0639742 162.728 31.312 162.728 69.952C162.728 93.136 154.328 112.288 126.104 133.792C121.064 137.488 108.968 145.888 89.48 158.32C44.792 187.888 31.352 203.344 31.352 219.808H165.08V244Z"
                      fill="#F7EDE5"
                    />
                  </svg>-->
                  <span class="hero-letter news-hero-letter"> <?php echo $months[1]; ?> </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-end text-bg">
                 <!-- <svg
                    width="172"
                    height="249"
                    viewBox="0 0 172 249"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M88.144 248.032C36.4 248.032 3.808 219.136 0.112002 173.776H28.336C30.688 205.024 52.864 224.512 88.144 224.512C122.08 224.512 144.592 208.048 144.592 177.808C144.592 149.248 123.088 134.128 92.176 134.128H65.968V110.608H91.168C119.728 110.608 138.208 96.832 138.208 68.608C138.208 42.4 121.072 23.584 89.152 23.584C56.224 23.584 35.728 45.424 34.048 76H6.832C9.856 32.32 38.752 0.0639742 89.152 0.0639742C137.872 0.0639742 166.096 29.968 166.096 68.272C166.096 97.504 147.616 118.336 123.088 121.696C151.312 126.064 171.808 148.576 171.808 178.816C171.808 218.128 139.888 248.032 88.144 248.032Z"
                      fill="#F7EDE5"
                    />
                  </svg>-->
                  <span class="hero-letter news-hero-letter"> <?php echo $years[0]; ?> </span>
                </div>
                <div class="page-title title-end text-bg">
                  <!--<svg
                    width="199"
                    height="240"
                    viewBox="0 0 199 240"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="menu-icon"
                  >
                    <path
                      d="M147.6 240H119.376V174.144H0.432001V150.624L115.008 0.0959627H147.6V150.96H199.008V174.144H147.6V240ZM119.376 150.96V30L28.32 150.96H119.376Z"
                      fill="#F7EDE5"
                    />
                  </svg>-->
                  <span class="hero-letter news-hero-letter"> <?php echo $years[1]; ?> </span>
                </div>
              </div>
            </div>
            <div class="news-post-hero-content site-container">
              <h3 class="fs-lg"><?php echo $published_date = get_the_date('F j, Y'); ?></h3>
              <h2 class="fs-3xl lg:max-w-[35vw]">
				  
                <?php the_title(); ?>
              </h2>
            </div>
          </section>
<?php } ?>

<?php 
$page_slug = get_post_field('post_name', get_post()); 
if($page_slug=='studio'){
?>
<section class="scroll-section site-container hero-section-height section-2" id="studio-top">
	<div class="custom-cursor" id="custom-cursor">
				  
			  </div>
            <div class="hero-background" style="background-image: url('<?php echo $hero_image; ?>')"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
              <div class="content-sect">
                <div class="page-title title-start text-bg">
                  <svg width="187" height="249" viewBox="0 0 187 249" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M99.912 248.032C43.8 248.032 4.152 222.832 0.792002 173.104H28.68C32.04 208.048 58.584 224.848 99.576 224.848C133.848 224.848 159.048 208.384 159.048 179.488C159.048 158.32 146.616 146.224 115.368 140.176L69.672 131.104C29.016 123.712 8.52 103.888 8.52 68.944C8.52 28.96 43.128 0.0639742 92.184 0.0639742C142.92 0.0639742 177.528 21.904 182.232 65.584H154.344C150.312 38.704 126.456 23.248 92.52 23.248C58.248 23.248 36.744 42.064 36.744 67.936C36.744 90.448 48.504 99.856 79.416 105.904L126.456 115.648C167.448 124.048 186.936 143.2 186.936 178.144C186.936 219.472 150.648 248.032 99.912 248.032Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> S </span>
                </div>
                <div class="page-title title-start text-bg">
                  <svg width="203" height="240" viewBox="0 0 203 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M85.256 240H0.248004V0.0959627H85.256C155.48 0.0959627 202.184 48.144 202.184 120.048C202.184 191.952 155.48 240 85.256 240ZM85.256 215.808C141.704 215.808 172.28 177.84 172.28 120.048C172.28 60.576 140.024 24.288 85.256 24.288H28.808V215.808H85.256Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> D </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-center text-bg">
                  <svg width="209" height="240" viewBox="0 0 209 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M118.712 240H89.816V24.288H0.440002V0.0959627H208.424V24.288H118.712V240Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> T </span>
                </div>
                <div class="page-title title-center text-bg">
                  <svg width="30" height="240" viewBox="0 0 30 240" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M29.144 240H0.248004V0.0959627H29.144V240Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> I </span>
                </div>
              </div>
              <div class="content-sect">
                <div class="page-title title-end text-bg">
                  <svg width="195" height="245" viewBox="0 0 195 245" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M97.656 244.032C35.832 244.032 0.552003 207.072 0.552003 141.552V0.0959627H29.448V143.904C29.448 193.296 54.312 219.504 97.656 219.504C140.328 219.504 165.864 195.312 165.864 143.904V0.0959627H194.76V142.224C194.76 208.08 159.816 244.032 97.656 244.032Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> U </span>
                </div>
                <div class="page-title title-end text-bg">
                  <svg width="220" height="249" viewBox="0 0 220 249" fill="none" xmlns="http://www.w3.org/2000/svg" class="menu-icon">
                    <path d="M110 248.032C42.8 248.032 0.800002 195.952 0.800002 124.048C0.800002 51.136 44.144 0.0639742 110 0.0639742C175.856 0.0639742 219.2 51.136 219.2 124.048C219.2 195.952 177.2 248.032 110 248.032ZM110 223.504C161.408 223.504 189.296 183.856 189.296 124.048C189.296 65.248 162.08 24.592 110 24.592C58.256 24.592 30.368 65.248 30.368 124.048C30.368 183.184 57.248 223.504 110 223.504Z" fill="#fff"></path>
                  </svg>
                  <span class="hero-letter"> O </span>
                </div>
              </div>
            </div>
          </section>
<?php } ?>