<?php
/**
 * WGI Informer functions and definitions
 *
 * @package WGI Informer
 */

/* Array holding files to include from the library for this theme */
$wgiinformer_includes = [
  'lib/init.php', // Setup and initialization
  'lib/utilities.php', // Helper functions
  'lib/post-types.php', // Custom post types
  'lib/shortcodes.php', // Custom shortcodes
  'lib/assets.php', // Assets (scripts and stylesheets)
  'lib/custom-header.php',
  'lib/template-tags.php',
  'lib/extras.php',
  'lib/customizer.php'
];

/* Loop through each file in the array of files to include */
foreach ($wgiinformer_includes as $file) {

  /* If the file is not found, throw an error */
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'wgiinformer'), $file), E_USER_ERROR);
  }

  /* Otherwise, load the file */
  require_once $filepath;
}
unset($file, $filepath);
