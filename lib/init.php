<?php
/**
 * Initialization options for WGI Informer theme.
 *
 * @package WGI Informer
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 640; /* pixels */
}

if ( ! function_exists( 'wgiinformer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wgiinformer_setup() {

  /*
   * Make theme available for translation.
   * Translations can be filed in the /lang/ directory.
   * If you're building a theme based on WGI Informer, use a find and replace
   * to change 'wgiinformer' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'wgiinformer', get_template_directory() . '/lang' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  add_image_size('announcement-thumbnail', 1920, 600, true); // Announcement thumbnail size: 1920x600px
  add_image_size('event-thumbnail', 200, 150, true); // Event thumbnail size: 200x150px
  add_image_size('photo-album-thumbnail', 240, 180, true); // Photo Album thumbnail size: 240x180px
  add_image_size('news-article-thumbnail', 300, 225, true); // News Article and Spotlight thumbnail size: 300x225px

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'wgiinformer' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'wgiinformer_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // wgiinformer_setup
add_action( 'after_setup_theme', 'wgiinformer_setup' );

/* Hide admin bar */
add_filter('show_admin_bar', '__return_false');

/* Allow uploading of .svg and .eps files */
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
  $existing_mimes['svg'] = 'mime/type';
  return $existing_mimes;
}

/* Customize "more link" to say "Read More..." */
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
  return '<a class="more-link" href="' . get_permalink() . '">Read More...</a>';
}
