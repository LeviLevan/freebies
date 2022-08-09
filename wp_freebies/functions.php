<?php
//custom logo
add_action( 'after_setup_theme', 'custom_logo_customizer' );
function custom_logo_customizer() {
    add_theme_support( 'custom-logo', [
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => '',
        'unlink-homepage-logo' => false,
    ] );
};

// custom menu support
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
            'header_menu' => __( 'Header Menu', 'wp_freebies' ),
        )
    );
}

// scripts adding
add_action('wp_enqueue_scripts', 'wp_freebies_main_style', 999);
function wp_freebies_main_style(){

    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/assets/css/bootstrap.css' );
    wp_enqueue_style( 'main-style',  get_stylesheet_directory_uri() .'/assets/css/main.css' );

    wp_enqueue_script('theme-core', get_stylesheet_directory_uri().'/assets/js/core.min.js', array('jquery'));
    wp_register_script('custom', get_stylesheet_directory_uri().'/assets/js/custom.js', array('jquery'));
    wp_enqueue_script( 'custom' );

}

add_filter('wp_nav_menu','new_submenu_class');
function new_submenu_class( $menu) {
    $menu = preg_replace('/current-menu-item/', 'active' ,$menu);

    return $menu;
}

add_filter( 'nav_menu_submenu_css_class', 'nav_menu_submenu_css_class_main_menu', 10, 2 );
function nav_menu_submenu_css_class_main_menu( $classes, $args ){

    if( $args->theme_location == 'primary' ) {
        $classes[] = 'rd-menu rd-navbar-dropdown';
    }

    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'nav_menu_link_attributes_main_menu', 10, 3 );
function nav_menu_link_attributes_main_menu( $atts, $item = null, $args = null ) {

    if( $args->theme_location == 'primary' ) {
        if( empty( $item->menu_item_parent ) ){
            $atts['class'] = 'rd-nav-link';
        }else {
            $atts['class'] = 'rd-dropdown-link';
        }
    }
    return $atts;
}

add_filter('nav_menu_css_class', 'nav_menu_css_class_main_menu' , 10 , 3);
function nav_menu_css_class_main_menu( $classes, $item, $args ){

    if( $args->theme_location == 'primary' ) {
        if( empty( $item->menu_item_parent ) ){
            $classes[] = 'rd-nav-item';
        }else {
            $classes[] = 'rd-dropdown-item';
        }
    }

    return $classes;
}

add_theme_support( 'post-thumbnails' );

function fix_avada_mime_types($mime){
    $mime['svg']='image/svg+xml';
    return $mime;
}
add_filter('upload_mimes', 'fix_avada_mime_types', 99);
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Team', 'Post Type General Name', 'wp_freebies' ),
        'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'wp_freebies' ),
        'menu_name'           => __( 'Team', 'wp_freebies' ),
        'parent_item_colon'   => __( 'Parent Team', 'wp_freebies' ),
        'all_items'           => __( 'All Team', 'wp_freebies' ),
        'view_item'           => __( 'View Team', 'wp_freebies' ),
        'add_new_item'        => __( 'Add New Team', 'wp_freebies' ),
        'add_new'             => __( 'Add New', 'wp_freebies' ),
        'edit_item'           => __( 'Edit Team', 'wp_freebies' ),
        'update_item'         => __( 'Update Team', 'wp_freebies' ),
        'search_items'        => __( 'Search Team', 'wp_freebies' ),
        'not_found'           => __( 'Not Found', 'wp_freebies' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'wp_freebies' ),
    );
    // Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'team', 'wp_freebies' ),
        'description'         => __( 'Team', 'wp_freebies' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        // This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category' ),
    );
    // Registering your Custom Post Type
    register_post_type( 'team', $args );
}
add_action( 'init', 'custom_post_type', 0 );

if ( ! function_exists( 'post_pagination' ) ) :
   function post_pagination() {
     global $wp_query;
     $pager = 999999999; // need an unlikely integer
 
        echo paginate_links( array(
             'base' => str_replace( $pager, '%#%', esc_url( get_pagenum_link( $pager ) ) ),
             'format' => '?paged=%#%',
             'current' => max( 1, get_query_var('paged') ),
             'total' => $wp_query->max_num_pages
        ) );
   }
endif;

if ( ! function_exists( 'custom_post_pagination' ) ) :
    function custom_post_pagination() {
        $args = array (
            'post_type'      => array( 'team' ),
            'posts_per_page' => 3,
            'paged'          => $paged,
        );

        // The Query
        $post_query = new WP_Query( $args );
        $total_pages = $post_query->max_num_pages;
        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));
                echo paginate_links(
                array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '/page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text'    => __('« prev'),
                    'next_text'    => __('next »'),
                ));
        } 
   }
endif; 