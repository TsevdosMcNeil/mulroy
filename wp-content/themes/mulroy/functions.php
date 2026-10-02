<?php
function mulroy_theme_support() {
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'mulroy_theme_support' );
function mulroy_styles() {
  $theme = wp_get_theme();

  wp_register_style(
    'mulroy-style',
    get_template_directory_uri() . '/assets/css/main.css',
    array(),
    $theme->get( 'Version' )
  );		

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'mulroy-style' );
	}

add_action( 'wp_enqueue_scripts', 'mulroy_styles' );

function mulroy_cdn_scripts() {
	wp_enqueue_script(
        'barba', // Unique handle for this script
        'https://cdn.jsdelivr.net/npm/@barba/core', 
        array(), 
        null, 
        true
    );
    wp_enqueue_script(
        'gsap', // Unique handle for this script
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', 
        array(), 
        '3.12.2', 
        true
    );
	
	wp_enqueue_script(
        'ScrollTrigger', 
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', 
        array(), 
        '3.12.5',
        true
    );
	wp_enqueue_script(
        'ScrollToPlugin', 
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js', 
        array(), 
        '3.12.5',
        true
    );
	wp_enqueue_script(
        'LottiePlayer', 
        'https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js', 
        array(), 
        '3.12.5',
        true
    );
}
add_action('wp_enqueue_scripts', 'mulroy_cdn_scripts');

function codecover_scripts() {
    //wp_enqueue_script('jquery');
    wp_localize_script('menu', 'menuParams', array(
        'themePath' => get_template_directory_uri()
    ));
    wp_enqueue_script('menu', get_template_directory_uri() . '/script/menu.js', array(), null, true);
    wp_enqueue_script('transitions', get_template_directory_uri() . '/script/transitions.js', array(), null, true);
	wp_enqueue_script('initalHomePageLoad', get_template_directory_uri() . '/script/initalHomePageLoad.js', array(), null, true);
	wp_enqueue_script('index', get_template_directory_uri() . '/script/index.js', array(), null, true);
// 	wp_enqueue_script('snap-scroll', get_template_directory_uri() . '/script/snap-scroll.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'codecover_scripts');

add_theme_support('post-thumbnails');
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start the menu (This will wrap the whole menu in the custom <div>)
    function start_lvl( &$output, $depth = 0, $args = null ) {
 
    }

    function end_lvl( &$output, $depth = 0, $args = null ) {
        
    }

    // Start the element (This will wrap each menu item in a custom <div> tag)
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
       
        $output .= '<a href="' . esc_url( $item->url ) . '" >' . esc_html( $item->title ) . '</a>';
    }


    function end_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        
    }
}

add_filter('wpcf7_form_elements', function($content) {
    // Remove all span tags with wpcf7-form-control-wrap class
    $pattern = '/<span class="wpcf7-form-control-wrap.*?>(.*?)<\/span>/s';
    $content = preg_replace($pattern, '$1', $content);
    
    // Remove p tags
    $content = str_replace(array('<p>', '</p>'), '', $content);
    
    // Remove line breaks
    $content = str_replace('<br />', '', $content);
    
    return $content;
});
add_filter('wpcf7_form_elements', function($content) {
    $button = '<button type="submit" class="wpcf7-form-control wpcf7-submit contact-form-submit self-center sm:col-start-2 sm:justify-self-end mt-4 md:mt-5 xl:mt-[1vw] w-[2.5vw]">
        <img src="' . get_template_directory_uri() . '/assets/media/arrow-right.svg" alt="" />
    </button>';
    
    return str_replace('[_site_url]', get_template_directory_uri(), $content);
});
function mulroy_register_widget_areas() {
    // Primary Sidebar
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 1', 'mulroy' ),
        'id'            => 'footer-widget-area1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">', // Use <div> for the widget wrapper
        'after_widget'  => '</div>', // Close the widget wrapper with </div>
        'description'   => __( 'Widgets in this area 1 will be shown in the footer.', 'mytheme' ),
    ) );

    // Footer Widget Area
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 2', 'mulroy' ),
        'id'            => 'footer-widget-area2',
        'description'   => __( 'Widgets in this area will be shown in the footer.', 'mulroy' ),
    ) );
	register_sidebar( array(
        'name'          => __( 'Footer Widget Area 3', 'mulroy' ),
        'id'            => 'footer-widget-area3',
        'description'   => __( 'Widgets in this area 3 will be shown in the footer.', 'mulroy' ),
    ) );
}
add_action( 'widgets_init', 'mulroy_register_widget_areas' );

add_post_type_support('retreats', 'editor');

function rename_posts_to_news() {
    global $menu, $submenu;

    // Rename "Posts" to "News" in the admin menu
    $menu[5][0] = 'News'; 

    // Rename "All Posts" to "All News"
    $submenu['edit.php'][5][0] = 'All News'; 

    // Rename "Add New" to "Add News"
    $submenu['edit.php'][10][0] = 'Add News';
}
add_action('admin_menu', 'rename_posts_to_news');
function load_more_posts_ajax_handler() {
    require get_template_directory() . '/inc/loadmore.php';
}
add_action('wp_ajax_load_more_posts', 'load_more_posts_ajax_handler'); // If called from admin
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_ajax_handler'); // If called from a visitor

function load_more_scripts() {
    wp_enqueue_script('jquery');  // Make sure jQuery is loaded
    wp_enqueue_script('load-more', get_template_directory_uri() . '/script/load-more.js', array('jquery'), null, true);
    
    // Localize the script to pass variables to JavaScript (admin-ajax.php URL and security nonce)
    wp_localize_script('load-more', 'load_more_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('load_more_nonce')  // Optional nonce for security
    ));
}
add_action('wp_enqueue_scripts', 'load_more_scripts');


function load_more_posts() {
    include get_template_directory() . '/inc/loadmore.php';
    wp_die(); 
}

add_action('wp_ajax_load_more', 'load_more_posts'); // For logged-in users
add_action('wp_ajax_nopriv_load_more', 'load_more_posts'); // For non-logged-in users



// Change the "Title" column for Designs CPT
add_filter('manage_edit-designs_columns', function($columns) {
    $new_columns = [];
	
	 foreach ($columns as $key => $label) {
        $new_columns[$key] = $label;

        // Insert our custom column *after* the Title column
        if ($key === 'title') {
            $new_columns['design_type'] = __('Subtitle', 'bhukman');
        }
    }

    return $new_columns;
});

// Show ACF field value in the custom column
add_action('manage_designs_posts_custom_column', function($column, $post_id) {
    if ($column === 'design_type') {
        $design_type = get_field('design_type', $post_id); // Get ACF field
        echo $design_type ? esc_html($design_type) : '<em>No Design Type</em>';
    }
}, 10, 2);




// Make column sortable
add_filter('manage_edit-designs_sortable_columns', function($columns) {
    $columns['design_type'] = 'design_type';
    return $columns;
});




add_action('acf/input/admin_footer', function() {
    ?>
    <script type="text/javascript">
        (function($){
            // Change the field key below to your field's key (not name)
            var fieldKey = 'field_67bf36f693ad6'; 

            acf.addAction('select2_init', function($select, args, settings, field){
                if (field.data.key === fieldKey) {
                    $select.on('select2:selecting', function(e){
                        var selected = $select.select2('data');
                        if (selected.length >= 3) {
                            e.preventDefault();
                            alert('You can only select up to 3 posts.');
                        }
                    });
                }
            });
        })(jQuery);
    </script>
    <?php
});



add_filter('acf/fields/wysiwyg/toolbars', 'acf_custom_minimal_toolbar');
function acf_custom_minimal_toolbar($toolbars) {

    // Remove all existing toolbars (optional but clean)
    $toolbars = [];

    // Create a new simplified toolbar
    $toolbars['OnlyLink'] = [];
    $toolbars['OnlyLink'][1] = ['link', 'unlink']; // Add link + unlink buttons

    return $toolbars;
}

// Remove Text/Visual tabs + remove HTML mode
add_filter('acf/fields/wysiwyg/settings', function($settings) {
    $settings['media_buttons'] = false;  // hide Add Media button
    $settings['quicktags'] = false;      // hide Text tab
    return $settings;
});




add_filter('acf/load_field/name=atrium_order', function($field) {
    $field['choices'] = [];

    for ($i = 1; $i <= 20; $i++) {
        $field['choices'][$i] = 'ATRIUM ' . str_pad($i, 2, '0', STR_PAD_LEFT);
    }

    return $field;
});













// 1️⃣ Add Atrium Order column and move it second-last
add_filter('manage_atriums_posts_columns', function($columns) {

    $atrium_order_column = ['atrium_order' => 'Atrium Order'];

    // Remove if already exists
    unset($columns['atrium_order']);

    $last_key = array_key_last($columns);

    $new_columns = [];
    foreach ($columns as $key => $value) {

        // Insert Atrium Order before last column
        if ($key === $last_key) {
            $new_columns = array_merge($new_columns, $atrium_order_column);
        }

        $new_columns[$key] = $value;
    }

    return $new_columns;
});

// 2️⃣ Display ACF select label in the column
add_action('manage_atriums_posts_custom_column', function($column, $post_id) {
    if ($column === 'atrium_order') {
        $value = get_field('atrium_order', $post_id);          // Get value
        $field = get_field_object('atrium_order', $post_id);   // Get full field

        if ($value && isset($field['choices'][$value])) {
            echo esc_html($field['choices'][$value]);          // Show label
        } else {
            echo '<em>No Order Selected</em>';
        }
    }
}, 10, 2);

// 3️⃣ Make the column sortable
add_filter('manage_edit_atriums_sortable_columns', function($columns) {
    $columns['atrium_order'] = 'atrium_order';
    return $columns;
});

// 4️⃣ Handle sorting in admin
add_action('pre_get_posts', function($query) {

    // Only affect admin main query for atriums
    if (!is_admin() || !$query->is_main_query()) return;

    $orderby = $query->get('orderby');

    if ($orderby === 'atrium_order') {

        $query->set('meta_key', 'atrium_order');       // ACF field name
        $query->set('orderby', 'meta_value');          // Sort by value
        $query->set('order', strtoupper($_GET['order'] ?? 'ASC')); // Respect ASC/DESC
    }
});


