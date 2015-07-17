<?php
/**
 * WGI Informer shortcodes
 *
 * @package WGI Informer
 */

/**
 * Grid system shortcode
 *
 * 1. Gets value of "classes" attribute used in shortcode
 * 2. Replaces the shortcode with a div with the classes provided
 * 3. Returns the html
 */
add_shortcode('grid', 'grid_shortcode');
function grid_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('classes' => ''), $atts);
  $output = '<div class="' . $values['classes'] . '">' . $content . '</div>';
  return $output;
}

/**
 * Collapsible shortcode
 *
 * 1. Begins building html for Materialize collapsible accordion
 * 2. Does the shortcode (if any, like a collapsible item) nested inside this one
 * 3. Returns the html
 */
add_shortcode( 'collapsible', 'collapsible_shortcode' );
function collapsible_shortcode($atts, $content, $tag) {
  $output = '<ul class="collapsible popout" data-collapsible="accordion">';
  $output .= do_shortcode($content);
  $output .= '</ul>';

  return $output;
}

/**
 * Collapsible item shortcode
 *
 * 1. Get the title provided for this item in the shortcode attributes
 * 2. Begins building html for Materialize collapsible item using title and content
 * 3. Returns the html
 */
add_shortcode( 'collapsible_item', 'collapsible_item_shortcode' );
function collapsible_item_shortcode($atts, $content, $tag) {
  $values = shortcode_atts(array('title' => ''), $atts);

  $output = '<li>';
  $output .= '<div class="collapsible-header"><i class="mdi-navigation-more-vert"></i>' . $values['title'] . '</div>';
  $output .= '<div class="collapsible-body">' . $content . '</div>';
  $output .= '</li>';

  return $output;
}
