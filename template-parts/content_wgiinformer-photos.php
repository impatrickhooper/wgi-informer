<?php
/**
 * The template part for displaying the Photos page.
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
   * Photos query arguments (for home page)
   *
   * 1. Photos post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. 5 posts per page
   */
  if (is_front_page()) {
    $args = array(
      'post_type'       => 'photos',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => 5,
    );
  }
  /**
   * Photos query arguments (for Photos page)
   *
   * 1. Photos post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   */
  else {
    $args = array(
      'post_type'       => 'photos',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => -1
    );
  }

  /* Execute the query with the provided arguments */
  $photos = new WP_Query($args);

  /* If there are photos, begin building the photos section */
  if($photos->have_posts()) :
?>

<div class="wrapper wrapper-photos">
  <div id="photos" class="grid-container">

    <?php
      /* If this is the front page, manually output the title */
      if (is_front_page()) {
        echo '<h1 class="entry-title">Photos</h1>';
      }
      $photos_count = 0; // Intialize the count of photos
      $photos_current_year = NULL; // Initialize the current year

      /* While the photos query still has posts, do stuff */
      while($photos->have_posts()) :
        $photos->the_post(); // Get the current post
        $photos_year = get_the_date('Y'); // Get the year of the photo albumn

        /* If the current year does not equal the year for this photo album, do stuff */
        if ($photos_current_year != $photos_year) {
          $photos_current_year = $photos_year; // Make current year the photo album year

          /* If this is the front page, output some html to open a container for cards of this year */
          if (is_front_page()) {
            echo '<div class="card-grid-container clearfix">';
          }
          /* Otherwise, do some stuff */
          else {

            /* If the photos count is not empty, output a div to close the card container */
            if ($photos_count != 0) {
              echo '</div>';
            }

            /* Output the year for this section of photos as a title */
            echo '<h2 class="section-title">' . $photos_current_year . '</h2><div class="card-grid-container clearfix">';
          }
        }
        $album_thumbnail = get_the_post_thumbnail(); // Get the featured image for this post
    ?>

    <div class="card-grid grid-20 tablet-grid-25 mobile-grid-50">
      <div class="card">

        <?php if($album_thumbnail) : ?>

        <a href="<?php the_field('photos_album_url') ?>" target="_blank">
          <div class="card-image waves-effect waves-light">

            <?php
              the_post_thumbnail('photo-album-thumbnail'); // Output the featured image
              the_title('<p class="card-title">', '</p>'); // Output the title
            ?>

          </div><!-- .card-image -->
        </a>

        <?php endif; ?>

      </div><!-- .card -->
    </div><!-- .card-grid -->

    <?php
        $photos_count++; // Increment the photos count
      endwhile;
      echo '</div>'; // Output final closing div for container
      wp_reset_postdata();
    ?>

  </div><!-- #photos -->
</div><!-- .wrapper.wrapper-photos -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
