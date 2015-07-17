<?php
/**
 * The template part for displaying the Spotlight section.
 *
 * @package WGI Informer
 */
?>

<?php
  /**
   * Spotlight query arguments
   *
   * 1. Spotlights post type
   * 2. Use date to sort
   * 3. Descending (most recent first)
   * 4. 8 posts per page
   */
  $args = array(
    'post_type'      => 'spotlights',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'posts_per_page' => 8
  );

  /* Execute the query with the provided arguments */
  $spotlights = new WP_Query($args);

  /* If there are spotlights, begin building the spotlights modal */
  if($spotlights->have_posts()) :
?>

<div id="spotlight" class="modal bottom-sheet">
  <div class="spotlight_content grid-container">
    <h5><i class="modal-close waves-effect waves-circle mdi-navigation-close right"></i></h5>
    <h1 class="entry-title">Spotlight</h1>

    <?php
      /* While the spotlights query still has posts, do stuff */
      while($spotlights->have_posts()) :
        $spotlights->the_post(); // Get the current post
        $spotlight_thumbnail = get_the_post_thumbnail(); // Get the featured image
        $spotlight_additional_field = get_field('spotlight_additional_content'); // Get the additional content checkbox
        $spotlight_additional = 'no'; // Set the additional content to no by default

        /* If the additional content checkbox is not empty, set additional content to its value */
        if (!empty($spotlight_additional_field)) {
          $spotlight_additional = $spotlight_additional_field[0];
        }
        $spotlight_tweet = get_field('spotlight_tweet'); // Get spotlight tweet/tagline
    ?>

    <div class="card-grid grid-25 tablet-grid-33 hide-on-mobile">
      <div class="card">

        <?php if($spotlight_thumbnail) : ?>

        <div class="card-image waves-effect">

          <?php the_post_thumbnail('news-article-thumbnail', array('class' => 'activator no-lazy')); ?>

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

    <?php endwhile; ?>

  </div><!-- .spotlight-content -->
</div><!-- #spotlight -->

<?php endif; ?>
