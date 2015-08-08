<?php
/**
 * The template part for displaying the spotlights page.
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
   * Spotlight query arguments (for spotlights page)
   *
   * 1. spotlights post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   */
  $args = array(
    'post_type'       => 'spotlights',
    'orderby'         => 'date',
    'order'           => 'DESC',
    'posts_per_page'  => -1
  );

  /* Execute the query with the provided arguments */
  $spotlights = new WP_Query($args);

  /* If there are spotlights, begin building the spotlights section */
  if($spotlights->have_posts()) :
?>

<div class="wrapper wrapper-spotlights">
  <div id="spotlights" class="grid-container">

    <?php
      $spotlights_count = 0; // Initialize the count of spotlight posts
      $spotlights_current_year = NULL; // Initialize the current year

      /* While the spotlights query still has posts, do stuff */
      while($spotlights->have_posts()) :
        $spotlights->the_post(); // Get the current post
        $spotlights_year = get_the_date('Y'); // Get the year of the spotlights post
        $spotlight_thumbnail = get_the_post_thumbnail(); // Get the featured image
        $spotlight_additional_field = get_field('spotlight_additional_content'); // Get the additional content checkbox
        $spotlight_additional = 'no'; // Set the additional content to no by default

        /* If the additional content checkbox is not empty, set additional content to its value */
        if (!empty($spotlight_additional_field)) {
          $spotlight_additional = $spotlight_additional_field[0];
        }
        $spotlight_tweet = get_field('spotlight_tweet'); // Get spotlight tweet/tagline

        /* If the current year does not equal the year for this spotlight post, do stuff */
        if ($spotlights_current_year != $spotlights_year) {
          $spotlights_current_year = $spotlights_year; // Make the current year the year of the post

          /* If the spotlights count is not empty, output a div to close the card container */
          if ($spotlights_count != 0) {
            echo '</div>';
          }

          /* Output the year for this section of spotlights as a title */
          echo '<h2 class="section-title">' . $spotlights_current_year . '</h2><div class="card-grid-container clearfix">';
        }
    ?>

    <div class="card-grid grid-25 tablet-grid-33 mobile-grid-100">
      <div class="card">

        <?php if($spotlight_thumbnail) : ?>

        <div class="card-image waves-effect">

          <?php the_post_thumbnail('news-article-thumbnail', array('class' => 'activator')); ?>

        </div><!-- .card-image -->

        <?php endif; ?>

        <div class="card-content">

          <?php
            the_title('<p class="card-title activator">', '</p>');

            /* If there is additional content, create the link to it */
            if($spotlight_additional == 'yes') :
          ?>

          <p><a href="<?php the_field('spotlight_link_url'); ?>" target="_blank"><i class="fa fa-arrow-circle-o-right"></i><?php the_field('spotlight_link_text'); ?></a></p>

          <?php endif; ?>

        </div><!-- .card-content -->

        <?php if($spotlight_tweet) : ?>

        <div class="card-reveal">
          <span class="card-title clearfix"><i class="waves-effect waves-circle mdi-navigation-close right"></i></span>

          <?php the_field('spotlight_tweet'); ?>

        </div><!-- .card-reveal -->

        <?php endif; ?>

      </div><!-- .card -->
    </div><!-- .card-grid -->

    <?php
        $spotlights_count++; // Incremement the spotlights count
      endwhile;
      echo '</div>'; // Output a final div to close the container
      wp_reset_postdata();
    ?>

  </div><!-- #spotlights -->
</div><!-- .wrapper.wrapper-spotlights -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
