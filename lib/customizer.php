<?php
/**
 * WGI Informer Theme Customizer
 *
 * @package wgiinformer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wgiinformer_customize_register( $wp_customize ) {

  $sections_to_remove = array(
    "colors",
    "header_image",
    "background_image"
  );
  foreach ($sections_to_remove as $str) {
    $wp_customize->remove_section($str);
  }

  $controls_to_remove = array(
    "blogdescription",
    "display_header_text"
  );
  foreach ($controls_to_remove as $ctr) {
    $wp_customize->remove_control($ctr);
  }
}
add_action( 'customize_register', 'wgiinformer_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wgiinformer_customize_preview_js() {
  wp_enqueue_script( 'wgiinformer_customizer', get_template_directory_uri() . '/js/vendors/_s/customizer.js', array( 'customize-preview' ), '0.0.1', true );
}
add_action( 'customize_preview_init', 'wgiinformer_customize_preview_js' );
