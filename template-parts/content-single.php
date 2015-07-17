<?php
/**
 * @package WGI Informer
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
  <header class="entry-header grid-container">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

  </header><!-- .entry-header -->
  <div class="entry-content grid-container">

    <?php the_post_thumbnail('full'); ?>

    <?php
      /* If this is the events post type, build date/time and location details */
      if (get_post_type() == 'events'):
        $event_start_date = get_field('event_start_date'); // Get the start date
        $event_start_dates = makeDates($event_start_date); // Break start date into pieces
        $event_start_day = $event_start_dates['day']; // Get the start day
        $event_start_month = $event_start_dates['month']; // Get the start month
        $event_start_year = $event_start_dates['year']; // Get the start year
        $event_start_time = get_field('event_start_time'); // Get the start time
        $event_show_end_field = get_field('event_show_end_date_time'); // Get the show end date checkbox
        $event_show_end = 'no'; // Set show end date to no by default

        /* If the show end date checkbox is not empty, set show end date to its value */
        if (!empty($event_show_end_field)) {
          $event_show_end = $event_show_end_field[0];
        }
        $event_end_date = NULL; // Initialize end date
        $event_end_time = NULL; // Initialize end time

        /* Begin building event date and time details with start month, day, year */
        $event_time_output = $event_start_month . ' ' . $event_start_day . ', ' . $event_start_year . ' | <em>' .           $event_start_time . '</em>';

        /* If event has an end date, do stuff */
        if ($event_show_end == 'yes') {
          $event_end_date = get_field('event_end_date'); // Get event end date
          $event_end_dates = makeDates($event_end_date); // Break end date into pieces
          $event_end_day = $event_end_dates['day']; // Get end day
          $event_end_month = $event_end_dates['month']; // Get end month
          $event_end_year = $event_end_dates['year']; // Get end year
          $event_end_time = get_field('event_end_time'); // Get end time
          $event_time_output .= ' - '; // Output hyphen to break up string

          /* If event end date is not equal to start date, output end month, day, year */
          if ($event_end_date != $event_start_date) {
            $event_time_output .= $event_end_month . ' ' . $event_end_day . ', ' . $event_end_year . ' | ';
          }

          /* Output end time */
          $event_time_output .= '<em>' . $event_end_time . '</em>';
        }
    ?>

    <div class="event_details">
      <div class="event_details-datetime"><strong>Date &amp; Time: </strong><?php echo $event_time_output; ?></div>
      <div class="event_details-location"><strong>Location: </strong><?php the_field('event_location'); ?></div>
    </div>

    <?php endif; ?>

    <?php if (get_the_content()): ?>

    <div class="article-content">

    <?php
      /* For all post types that aren't events, get the post date and output the month and year */
      if (get_post_type() != 'events'):
        $post_date = makeDates(get_the_date('Ymd'));
    ?>

    <div class="published-date">
      <div class="published-date_month"><?php echo $post_date['month']; ?></div>
      <div class="published-date_year"><?php echo $post_date['year']; ?></div>
    </div>

    <?php
      endif;
      the_content();
    ?>

    </div>

    <?php endif; ?>

    <?php
      /* Output previous and next page links */
      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'wgiinformer' ),
        'after'  => '</div>',
      ) );
    ?>

  </div><!-- .entry-content -->
</article><!-- #post-## -->
