<?php include_once 'FT/FT_scope.php'; FT_scope::init(); ?><?php
/**
 * web2feel functions and definitions
 *
 * @package web2feel
 */

include ( 'aq_resizer.php' );
include ( 'guide.php' );



/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 640; /* pixels */

if ( ! function_exists( 'web2feel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function web2feel_setup() {

    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on web2feel, use a find and replace
     * to change 'web2feel' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'web2feel', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails on posts and pages
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'web2feel' ),
    ) );


    /**
     * Setup the WordPress core custom background feature.
     */

    add_theme_support( 'custom-background', apply_filters( 'web2feel_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

}
endif; // web2feel_setup
add_action( 'after_setup_theme', 'web2feel_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function web2feel_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'web2feel' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'web2feel_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function web2feel_scripts() {
    wp_enqueue_style( 'web2feel-style', get_stylesheet_uri() );
    wp_enqueue_style( 'dashicons');
    wp_enqueue_style( 'pushy', get_template_directory_uri() . '/css/pushy.css');
    wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css');
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css');

    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'superslides', get_template_directory_uri() . '/js/jquery.superslides.js', array(), '20120206', true );
    wp_enqueue_script( 'web2feel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', array(), '20120206', true );
    wp_enqueue_script( 'pushy', get_template_directory_uri() . '/js/pushy.js', array(), '20120206', true );
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '20120206', true );


    wp_localize_script('custom', 'data', array(
      'delay' => ft_of_get_option('fabthemes_slide_delay','2000'),
      'effect' => ft_of_get_option('fabthemes_slide','fade')
    ));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'web2feel_scripts' );


/**
* Implement Metabox
*/
require get_template_directory() . '/metaboxes/meta_box.php';
require get_template_directory() . '/inc/metabox.php';

/**
* Implement CPT
*/
require get_template_directory() . '/inc/cpt.php';
/**
 * Implement pagination
 */
require get_template_directory() . '/inc/paginate.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// Additional Declaring Glory functions
require get_template_directory() . '/inc/dg-functions.php';

// Options fallback

if ( !function_exists( 'ft_of_get_option' ) ) {
    function ft_of_get_option($name, $default = false) {
        $optionsframework_settings = get_option('optionsframework');
        // Gets the unique option id
        $option_name = $optionsframework_settings['id'];
        if ( get_option($option_name) ) {
            $options = get_option($option_name);
        }
        if ( isset($options[$name]) ) {
            return $options[$name];
        } else {
            return $default;
        }
    }
}



/* Credits */

function selfURL() {
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
    $_SERVER['PHP_SELF'];
    $uri = parse_url($uri,PHP_URL_PATH);
    $protocol = $_SERVER['HTTPS'] ? 'https' : 'http';
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $server = ($_SERVER['SERVER_NAME'] == 'localhost') ?
    $_SERVER["SERVER_ADDR"] : $_SERVER['SERVER_NAME'];
    return $protocol."://".$server.$port.$uri;
}

function fflink() {
    global $wpdb, $wp_query;
    if (!is_page() && !is_front_page()) return;
    $contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts
        WHERE post_type = 'page' AND post_title LIKE 'contact%'");
    if (($contactid != $wp_query->post->ID) && ($contactid || !is_front_page())) return;

    echo 'Website by <a href="http://www.guahanweb.com">Guahan Web</a>';
}
