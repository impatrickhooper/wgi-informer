<?php
/**
 * WGI Informer custom post types
 *
 * @package WGI Informer
 */

/*
 * Announcements post type
 *
 * Supports a title and featured image by default
 * Is not public (so no link to page created)
 */
add_action('init', 'announcements_post_type', 0);
function announcements_post_type() {
  $labels = array(
    'name'                => __('Announcements', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Announcement', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Announcements', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Announcement', 'twentyfifteen'),
    'all_items'           => __('All Announcements', 'twentyfifteen'),
    'view_item'           => __('View Announcement', 'twentyfifteen'),
    'add_new_item'        => __('Add New Announcement', 'twentyfifteen'),
    'add_new'             => __('Add New Announcement', 'twentyfifteen'),
    'edit_item'           => __('Edit Announcement', 'twentyfifteen'),
    'update_item'         => __('Update Announcement', 'twentyfifteen'),
    'search_items'        => __('Search Announcements', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'thumbnail'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 26,
    'menu_icon'           => 'dashicons-megaphone',
    'capability_type'     => array('announcement', 'announcements'),
    'map_meta_cap'        => true,
  );

  register_post_type('announcements', $args);
}

/*
 * Events post type
 *
 * Supports a title, the editor, and a featured image by default
 * Is public (so link to page created)
 */
add_action('init', 'events_post_type', 0);
function events_post_type() {
  $labels = array(
    'name'                => __('Events', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Event', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Events', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Event', 'twentyfifteen'),
    'all_items'           => __('All Events', 'twentyfifteen'),
    'view_item'           => __('View Event', 'twentyfifteen'),
    'add_new_item'        => __('Add New Event', 'twentyfifteen'),
    'add_new'             => __('Add New Event', 'twentyfifteen'),
    'edit_item'           => __('Edit Event', 'twentyfifteen'),
    'update_item'         => __('Update Event', 'twentyfifteen'),
    'search_items'        => __('Search Events', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'editor', 'thumbnail'),
    'taxonomies'          => array('category'),
    'public'              => true,
    'show_in_nav_menus'   => false,
    'menu_position'       => 27,
    'menu_icon'           => 'dashicons-calendar-alt',
    'capability_type'     => array('event', 'events'),
    'map_meta_cap'        => true,
  );

  register_post_type('events', $args);
}

/*
 * Favorites post type
 *
 * Supports a title and page attributes (like menu order) by default
 * Is not public (so link to not page created)
 */
add_action('init', 'favorites_post_type', 0);
function favorites_post_type() {
  $labels = array(
    'name'                => __('Favorites', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Favorite', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Favorites', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Favorite', 'twentyfifteen'),
    'all_items'           => __('All Favorites', 'twentyfifteen'),
    'view_item'           => __('View Favorite', 'twentyfifteen'),
    'add_new_item'        => __('Add New Favorite', 'twentyfifteen'),
    'add_new'             => __('Add New Favorite', 'twentyfifteen'),
    'edit_item'           => __('Edit Favorite', 'twentyfifteen'),
    'update_item'         => __('Update Favorite', 'twentyfifteen'),
    'search_items'        => __('Search Favorites', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'page-attributes'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 28,
    'menu_icon'           => 'dashicons-star-filled',
    'capability_type'     => array('favorite', 'favorites'),
    'map_meta_cap'        => true,
  );

  register_post_type('favorites', $args);
}

/*
 * News post type
 *
 * Supports a title, the editor, and a featured image by default
 * Is public (so link to page created)
 */
add_action('init', 'news_post_type', 0);
function news_post_type() {
  $labels = array(
    'name'                => __('News', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Article', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('News', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Article', 'twentyfifteen'),
    'all_items'           => __('All News', 'twentyfifteen'),
    'view_item'           => __('View Article', 'twentyfifteen'),
    'add_new_item'        => __('Add New Article', 'twentyfifteen'),
    'add_new'             => __('Add New Article', 'twentyfifteen'),
    'edit_item'           => __('Edit Article', 'twentyfifteen'),
    'update_item'         => __('Update Article', 'twentyfifteen'),
    'search_items'        => __('Search News', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'editor', 'thumbnail'),
    'public'              => true,
    'show_in_nav_menus'   => false,
    'menu_position'       => 29,
    'menu_icon'           => 'dashicons-pressthis',
    'capability_type'     => array('article', 'news'),
    'map_meta_cap'        => true,
  );

  register_post_type('news', $args);
}

/*
 * Photos post type
 *
 * Supports a title and featured image by default
 * Is not public (so no link to page created)
 */
add_action('init', 'photos_post_type', 0);
function photos_post_type() {
  $labels = array(
    'name'                => __('Photos', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Album', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Photos', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Album', 'twentyfifteen'),
    'all_items'           => __('All Photos', 'twentyfifteen'),
    'view_item'           => __('View Album', 'twentyfifteen'),
    'add_new_item'        => __('Add New Album', 'twentyfifteen'),
    'add_new'             => __('Add New Album', 'twentyfifteen'),
    'edit_item'           => __('Edit Album', 'twentyfifteen'),
    'update_item'         => __('Update Album', 'twentyfifteen'),
    'search_items'        => __('Search Photos', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'thumbnail'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 30,
    'menu_icon'           => 'dashicons-format-image',
    'capability_type'     => array('album', 'photos'),
    'map_meta_cap'        => true,
  );

  register_post_type('photos', $args);
}

/*
 * Spotlights post type
 *
 * Supports a title and featured image by default
 * Is not public (so no link to page created)
 */
add_action('init', 'spotlights_post_type', 0);
function spotlights_post_type() {
  $labels = array(
    'name'                => __('Spotlights', 'Post Type General Name', 'twentyfifteen'),
    'singular_name'       => __('Spotlight', 'Post Type Singular Name', 'twentyfifteen'),
    'menu_name'           => __('Spotlights', 'twentyfifteen'),
    'parent_item_colon'   => __('Parent Spotlight', 'twentyfifteen'),
    'all_items'           => __('All Spotlights', 'twentyfifteen'),
    'view_item'           => __('View Spotlight', 'twentyfifteen'),
    'add_new_item'        => __('Add New Spotlight', 'twentyfifteen'),
    'add_new'             => __('Add New Spotlight', 'twentyfifteen'),
    'edit_item'           => __('Edit Spotlight', 'twentyfifteen'),
    'update_item'         => __('Update Spotlight', 'twentyfifteen'),
    'search_items'        => __('Search Spotlights', 'twentyfifteen'),
    'not_found'           => __('Not Found', 'twentyfifteen'),
    'not_found_in_trash'  => __('Not found in Trash', 'twentyfifteen'),
  );

  $args = array(
    'labels'              => $labels,
    'supports'            => array('title', 'thumbnail'),
    'public'              => false,
    'show_ui'             => true,
    'menu_position'       => 31,
    'menu_icon'           => 'dashicons-lightbulb',
    'capability_type'     => array('spotlight', 'spotlights'),
    'map_meta_cap'        => true,
  );

  register_post_type('spotlights', $args);
}

/*
 * Content Manager role
 *
 * Can read, delete posts, manage files, manage categories
 */
add_action('init', 'register_custom_roles', 0);
function register_custom_roles() {
 add_role('content_manager',
          'Content Manager',
          array(
            'read'                => true,
            'edit_posts'          => false,
            'delete_others_posts' => true,
            'delete_posts'        => true,
            'publish_posts'       => false,
            'upload_files'        => true,
            'manage_categories'   => true,
          )
  );
}

/*
 * Content Manager capabilities
 *
 * Let Content Manager manage custom post types
 */
add_action('admin_init','register_custom_capabilities', 999);
function register_custom_capabilities() {

  /* Let administrator manage Favorites */
  $role = get_role('administrator');
  $role->add_cap('read');
  $role->add_cap('read_favorite');
  $role->add_cap('read_private_favorites');
  $role->add_cap('edit_favorite');
  $role->add_cap('edit_favorites');
  $role->add_cap('edit_others_favorites');
  $role->add_cap('edit_published_favorites');
  $role->add_cap('publish_favorites');
  $role->add_cap('delete_others_favorites');
  $role->add_cap('delete_private_favorites');
  $role->add_cap('delete_published_favorites');

  /* Let content manager, editor, and administrator manage all other CPT */
  $content_types = array(
    "announcement"  => "announcements",
    "event"         => "events",
    "article"       => "news",
    "album"         => "photos",
    "spotlight"     => "spotlights"
  );

  foreach ($content_types as $key => $value) {
    $roles = array('content_manager', 'editor', 'administrator');

    foreach($roles as $the_role) {
      $role = get_role($the_role);
      $role->add_cap('read');
      $role->add_cap('read_' . $key);
      $role->add_cap('read_private_' . $value);
      $role->add_cap('edit_' . $key);
      $role->add_cap('edit_' . $value);
      $role->add_cap('edit_others_' . $value);
      $role->add_cap('edit_published_' . $value);
      $role->add_cap('publish_' . $value);
      $role->add_cap('delete_others_' . $value);
      $role->add_cap('delete_private_' . $value);
      $role->add_cap('delete_published_' . $value);
    }
  }
}
