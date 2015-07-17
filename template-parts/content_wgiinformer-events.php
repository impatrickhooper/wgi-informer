<?php
/**
 * The template part for displaying the Events page.
 *
 * @package WGI Informer
 */
?>

<?php
  /* Set default time zone to same as WGI location */
  $default_tz = date_default_timezone_get();
  date_default_timezone_set('America/New_York');
?>

<?php
  /**
   * Events query arguments (for home page)
   *
   * 1. Events post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   * 5. Query based on event start date
   * 6. Compare it to today
   * 7. If event starts today or after, include it in results
   */
  if (is_front_page()) {
    $args = array(
      'post_type'       => 'events',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => -1,
      'meta_key'        => 'event_start_date',
      'meta_value'      => date('Ymd'),
      'meta_compare'    => '>='
    );
  }
  /**
   * Events query arguments (for Events page)
   *
   * 1. Events post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   */
  else {
    $args = array(
      'post_type'       => 'events',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => -1
    );
  }

  /* Execute the query with the provided arguments */
  $events = new WP_Query($args);

  /* If there are events, begin building the events section */
  if ($events->have_posts()) :
?>

<div class="wrapper wrapper-events">
  <div id="events" class="clearfix grid-container">

    <?php
      /* If this is the front page, manually output the title */
      if (is_front_page()) {
        echo '<h1 class="entry-title">Events</h1>';
      }
      $events_count = 0; // Initialize the count of events
      $events_current_year = NULL; // Initialize the current year

      /* While the events query still has posts, do stuff */
      while ($events->have_posts()) :
        $events->the_post(); // Get the current post
        $event_start_date = get_field('event_start_date'); // Get the event start date
        $event_start_dates = makeDates($event_start_date); // Break the start date into pieces
        $event_start_day = $event_start_dates['day']; // Get the day the event starts
        $event_start_month = $event_start_dates['month']; // Get the month the event starts
        $event_start_year = $event_start_dates['year']; // Get the year the event starts
        $event_start_time = get_field('event_start_time'); // Get the time the event starts
        $event_show_end_field = get_field('event_show_end_date_time'); // Get the show end date checkbox
        $event_show_end = 'no'; // Set the show end date to no by defualt

        /* If the show end date checkbox is not empty, set the show end date to its value */
        if (!empty($event_show_end_field)) {
          $event_show_end = $event_show_end_field[0];
        }
        $event_category_field = get_the_category(); // Get the event category
        $event_category = ''; // Set the category to empty by default

        /* If the category is not empty, set the category to its value */
        if (!empty($event_category_field)) {
          $event_category = $event_category_field[0]->slug;
        }

        /* If the current year does not equal the start year for this event, do stuff */
        if ($events_current_year != $event_start_year) {
          $events_current_year = $event_start_year; // Make current the event start year

          /* If this is the front page, output some html to open a container for cards of this year */
          if (is_front_page()) {
            echo '<div class="card-grid-container clearfix">';
          }
          /* Otherwise, do some stuff */
          else {

            /* If the events count is not empty, output a div to close the card container */
            if ($events_count != 0) {
              echo '</div>';
            }

            /* Output the year for this section of events as a title */
            echo '<h2 class="section-title">' . $events_current_year . '</h2><div class="card-grid-container clearfix">';
          }
        }
    ?>

    <div class="card-grid grid-50 tablet-grid-100 mobile-grid-100">
      <a href="<?php the_permalink(); ?>" class="card <?php echo $event_category; ?>">
        <div class="card-left grid-15 tablet-grid-15 mobile-grid-100">
          <div class="card-date">
            <div class="day card-date_part"><?php echo $event_start_day; ?></div><!-- .card-date_part.day -->
            <div class="month card-date_part"><?php echo $event_start_month; ?></div><!-- .card-date_part.month -->
            <div class="year card-date_part"><?php echo $event_start_year; ?></div><!-- .card-date_part.year -->
          </div><!-- .card-date -->
        </div><!-- .card-top -->
        <div class="card-middle grid-60 tablet-grid-65 mobile-grid-100">

          <?php the_title('<p class="card-title">', '</p>'); ?>

           <p class="card-time">

            <?php
              $event_time_output = $event_start_month . ' ' . $event_start_day . ', ' . $event_start_year . ' | <em>' . $event_start_time . '</em>'; // Begin building the event time using the starting day, month, year

              /* If there is end date details, do stuff */
              if ($event_show_end == 'yes') {
                $event_end_date = get_field('event_end_date'); // Get the end date
                $event_end_dates = makeDates($event_end_date); // Break end date into parts
                $event_end_day = $event_end_dates['day']; // Get the end day
                $event_end_month = $event_end_dates['month']; // Get the end month
                $event_end_year = $event_end_dates['year']; // Get the end year
                $event_end_time = get_field('event_end_time'); // Get the end time
                $event_time_output .= ' - '; // Begin adding to the event time output

                /* If the end date is not equal to the start date, output the end month, day, and year */
                if ($event_end_date != $event_start_date) {
                  $event_time_output .= $event_end_month . ' ' . $event_end_day . ', ' . $event_end_year . ' | ';
                }

                /* Output the end time */
                $event_time_output .= '<em>' . $event_end_time . '</em>';
              }

              /* Output the event date and time details */
              echo $event_time_output;
            ?>

          </p><!-- .card-time -->
          <p class="card-location"><?php the_field('event_location'); ?></p><!-- .card-location -->
        </div><!-- .card-middle -->
        <div class="card-right grid-25 tablet-grid-20 mobile-grid-100">

          <?php the_post_thumbnail('event-thumbnail'); ?>

        </div><!-- .card-right -->
      </a><!-- .card -->
    </div><!-- .card-grid -->

    <?php
        $events_count++; // Increment the events count
      endwhile;
      echo '</div>'; // Output a final closing container div
      wp_reset_postdata();
    ?>

  </div><!-- #events -->
</div><!-- .wrapper.wrapper-events -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
