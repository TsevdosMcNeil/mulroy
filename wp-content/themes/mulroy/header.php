<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="preload"
      as="image"
      href="<?php echo get_template_directory_uri(); ?>/assets/media/home-hero.jpeg"
      type="image/jpeg"
    />
	<?php wp_head(); ?>
	
  </head>
<body>
	<div class="transition-overlay"></div>
<?php 
$company_name = get_field('company_name', 'option');
$building_address = get_field('building_address', 'option');
$street = get_field('street', 'option');
$city = get_field('city', 'option');
$pin_code = get_field('pin_code', 'option');
$country = get_field('country', 'option');
$phone = get_field('phone', 'option');
$email = get_field('email', 'option');
$instagram = get_field('instagram', 'option');
$linkedin = get_field('linkedin', 'option');
?>
    <header class="header">
      <button class="burger-menu menu-btn">
        <span class="menu-line"></span>
        <span class="menu-line"></span>
        <span class="menu-line"></span>
      </button>
	<div class="menu-animation">
        <div id="menu-animation-div"></div>
      </div>
		<script>
    var themePath = "<?php echo get_template_directory_uri(); ?>";
</script>
    </header>
    <nav>
      <div class="menu-container site-container">
        <div class="menu-content">
          <div class="menu-letter hidden">
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
                fill="#fff"
              />
            </svg>

            <span class="hero-letter"> M </span>
          </div>
          <div class="menu-letter hidden">
            <svg
              width="193"
              height="240"
              viewBox="0 0 193 240"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              class="menu-icon"
            >
              <path
                d="M192.44 240H165.56L29.144 35.376H28.472V240H0.248004V0.0959627H35.864L163.88 191.616H164.552V0.0959627H192.44V240Z"
                fill="white"
              />
            </svg>
            <span class="hero-letter"> N </span>
          </div>
        </div>
        <div
          class="site-container menu-items absolute flex lg:justify-between lg:pt-0  w-full sm:justify-center sm:pt-[8rem] sm:text-center"
        >
		<?php
            wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',  
                    'container'       => false,
                    'menu_class'      => '',             
					'items_wrap'      => '%3$s',
                    'walker' => new Custom_Walker_Nav_Menu()
                )
            );
        ?>
         
        </div>

        <div class="menu-content">
          <div class="menu-letter justify-end hidden">
            <svg
              width="163"
              height="240"
              viewBox="0 0 163 240"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              class="menu-icon"
            >
              <path
                d="M162.536 240H0.248004V0.0959627H162.2V24.288H28.808V107.952H147.416V132.48H28.808V215.808H162.536V240Z"
                fill="white"
              />
            </svg>
            <span class="hero-letter"> E </span>
          </div>
          <div class="menu-letter justify-end hidden">
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
                fill="#fff"
              />
            </svg>
            <span class="hero-letter"> U </span>
          </div>
        </div>
        <div class="menu-contact-content">
          <div class="menu-address letter__spacing__custom__-1px text-white">
            <?php echo $company_name; ?> <br /><?php echo $building_address; ?><br />
              <?php echo $street; ?><br />
              <?php echo $city; ?> <?php echo $pin_code; ?>
              <br />
             <?php echo $country; ?>
          </div>
          <div class="menu-social-content">
            <div class="flex flex-col">
              <a href="tel:<?php echo $phone; ?>" class="anchor-second letter__spacing__custom__-1px"><?php echo $phone; ?></a>
              <a href="mailto:<?php echo $email; ?>" class="anchor-second letter__spacing__custom__-1px"><?php echo $email; ?></a>
            </div>
            <div class="menu-social flex flex-col">
              <a href="<?php echo $instagram; ?>" class="anchor-second letter__spacing__custom__-1px" target="_blank">Instagram</a>
              <a href="<?php echo $linkedin; ?>" class="anchor-second letter__spacing__custom__-1px" target="_blank">LinkedIn</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
	<?php
	$slug = '';

	if (is_front_page()) {
		$slug = 'home';
	} elseif (is_single()) {
        $segment = get_query_var('post_type'); // For CPT
        if($segment=='peoples'){
        $slug = 'person';    
        }else{
		$slug = get_post_field('post_name', get_post());
        }
	} elseif (is_page()) {
		$slug = get_post_field('post_name', get_post());
	} elseif (is_tax('design_category')) {
		$slug = 'design-category';
	} elseif (is_archive()) {
		$slug = get_post_type();
	} elseif (is_search()) {
		$slug = 'search';
	} elseif (is_404()) {
		$slug = 'error404';
	}
	?>

    <main data-barba="wrapper">
      <div data-barba="container" data-barba-namespace="<?php echo esc_attr($slug); ?>">
        <div class="scroll-container">