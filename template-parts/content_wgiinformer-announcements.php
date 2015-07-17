<?php
/**
 * The template part for displaying the home page Announcements.
 *
 * @package WGI Informer
 */
?>

<?php
  /**
   * Announcements query arguments
   *
   * 1. Announcements post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   */
  $args = array(
    'post_type'       => 'announcements',
    'orderby'         => 'date',
    'order'           => 'DESC',
    'posts_per_page'  => -1
  );

  /* Execute the query with the provided arguments */
  $announcements = new WP_Query($args);

  /* If there are announcements, begin building the announcements slider */
  if($announcements->have_posts()) :
?>

<div id="announcements" class="slider">
  <ul class="slides">

    <?php
      /* While the announcements query still has posts, do stuff */
      while($announcements->have_posts()) :
        $announcements->the_post(); // Get the current post
        $announcement_tagline = get_field('announcement_tagline'); // Get the post tagline
        $announcement_additional_content_field = get_field('announcement_additional_content'); // Get the additional content checkbox
        $announcement_additional_content = 'no'; // Set additional content to no by default

        /* If the additional content checkbnox is not empty, set the additional content to its value */
        if (!empty($announcement_additional_content_field)) {
          $announcement_additional_content = $announcement_additional_content_field[0];
        }
        $announcement_external_link_field = get_field('announcement_external_link'); // Get the external link checkbox
        $announcement_external_link = 'no'; // Set the external link to no by default

        /* If the external link checkbox is not empty, set the external link to its value */
        if (!empty($announcement_external_link_field)) {
          $announcement_external_link = $announcement_external_link_field[0];
        }
    ?>

    <li <?php if (get_field('announcement_background_color') != '') { echo 'style="background-color: ' . get_field('announcement_background_color') . '"'; } ?>>

      <?php the_post_thumbnail('announcement_thumbnail', array('class' => 'no-lazy')); ?>

       <div class="caption center-align">

        <?php
          the_title("<h3 class='caption_title'>", "</h3>");

          /* If there's an announcement tagline, output it */
          if ($announcement_tagline):
         ?>

        <h5 class="caption_tagline"><?php echo $announcement_tagline; ?></h5>

        <?php
          endif;

          /* If there's additional content, output the link to it */
          if ($announcement_additional_content == 'yes'):
         ?>

        <a class="caption_link" href="<?php the_field('announcement_link_url'); ?>" <?php if ($announcement_external_link == 'yes'){echo 'target="_blank"';}?>><?php the_field('announcement_link_text'); ?><i class="fa fa-angle-right"></i></a>

        <?php endif; ?>

      </div><!-- .caption -->
    </li>

    <?php
      endwhile;
      wp_reset_postdata();
    ?>

  </ul><!-- .slides -->
</div><!-- #announcements.slider -->

<?php endif; ?>
