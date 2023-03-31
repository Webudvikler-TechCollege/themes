<?php
function example_enqueue_styles() {
	
	// enqueue parent styles
    // in this case we enqueue the parentstyle, which is called twentytwentytwo-style,
    // you can find the name in the functions.php in the parent theme
	wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() .'/style.css');
	
	// enqueue child styles
    // we enqueu the childtheme and set the parent style as a dependecy
    // we now inherit the styles from the parenttheme and overwrites the ones in our new childtheme
	wp_enqueue_style('child-theme', get_stylesheet_directory_uri() .'/style.css', array('twenty-twenty-one-style'));
	
}
add_action('wp_enqueue_scripts', 'example_enqueue_styles');

/*
get_stylesheet_uri()           = http://example.com/wp-content/themes/example-child/style.css
get_template_directory_uri()   = http://example.com/wp-content/themes/example-parent
get_stylesheet_directory_uri() = http://example.com/wp-content/themes/example-child
*/

// Our custom post type function
function create_posttype() {
  
    register_post_type( 'pets',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Pets' ),
                'singular_name' => __( 'Pet' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'pest'),
            'show_in_rest' => true,
  
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


// array of menus
$menus = array(

    'footer-menu' => __( 'Footer Menu', 'child-theme' ),	
    'pet-menu' => __( 'Pet Menu', 'child-theme' ),	
  );
  
  
  // This theme uses wp_nav_menu() in three locations.
  register_nav_menus($menus);

?>