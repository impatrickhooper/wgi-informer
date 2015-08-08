<?php
/**
 * Load assets for WGI Informer theme.
 *
 * @package WGI Informer
 */

/* Load theme assets (scripts and stylesheets) */
add_action('wp_enqueue_scripts', 'wgiinformer_scripts');
function wgiinformer_scripts() {
  $asset_version = '2.0.1';

  /* Load the stylesheet: handle name, stylesheet path, dependencies, version, media types */
  wp_enqueue_style('wgiinformer-style', get_stylesheet_uri(), array(), $asset_version, 'all');

  /* Load the script (app.js): handle name, script path, dependencies, version, load in footer */
  wp_enqueue_script('wgiinformer-script', get_stylesheet_directory_uri() . '/app.js', array('jquery'), $asset_version, true);

  /* If this is the Offices page, load scripts necessary to run Mapbox */
  if (is_page(16)) {
    wp_enqueue_script('mapbox_js', esc_url_raw('https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.js'), array(), $asset_version, false);
    wp_enqueue_script('leaflet_markercluster_js', esc_url_raw('https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'), array(), $asset_version, false);
    wp_enqueue_style('mapbox_css', esc_url_raw('https://api.tiles.mapbox.com/mapbox.js/v2.1.9/mapbox.css'), array(), $asset_version, false);
    wp_enqueue_style('markercluster_css', esc_url_raw('https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css'), array(), $asset_version, false);
    wp_enqueue_style('markercluster_default_css', esc_url_raw('https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css'), array(), $asset_version, false);
  }
}
