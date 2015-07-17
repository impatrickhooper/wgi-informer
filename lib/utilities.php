<?php
/**
 * Utility functions for WGI Informer
 *
 * @package WGI Informer
 */

/**
 * Parse a date string into pieces
 *
 * 1. Converts the provided date string to a date/time object
 * 2. Builds an array with day, month, year pieces built from the date/time object
 * 3. Returns the array
 */
function makeDates($date_string) {
  $date_time = strtotime($date_string);
  $date_parts = array(
    "day"   => date('d', $date_time),
    "month" => date('M', $date_time),
    "year"  => date('Y', $date_time)
  );
  return $date_parts;
}

/**
 * Calculate number of years since a provided date
 *
 * 1. Sets the default time zone to the same one as WGI location
 * 2. Converts the provided date string to a date/time object
 * 3. Gets the date/time object representing the end of current month
 * 4. Calculates the difference between end of month and provided date, and converts to years
 * 5. Sets the default timezone back to server default
 * 6. Returns number of years + "year" if it's 1, or "years" if not 1
 */
function yearsAgo($timeAsString) {
  $default_tz = date_default_timezone_get();
  date_default_timezone_set('America/New_York');
  $time = strtotime($timeAsString);
  $endOfMonthTime = strtotime(date('Ymt'));
  $years = floor(($endOfMonthTime - $time) / 31536000);
  date_default_timezone_set($default_tz);
  return ($years != 1) ? $years . ' years' : $years . ' year';
}

add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function tgm_io_shortcode_empty_paragraph_fix( $content ) {
  $array = array(
    '<p>['    => '[',
    ']</p>'   => ']',
    ']<br />' => ']'
  );
  return strtr( $content, $array );
}

/* Pagination for custom queries */
function pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    $output = "<nav class='custom-pagination'>";
    $output .= $paginate_links;
    $output .= "</nav>";

    return $output;
  }
}
