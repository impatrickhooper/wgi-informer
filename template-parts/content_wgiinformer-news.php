<?php
/**
 * The template part for displaying the News page.
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
   * News query arguments (for home page)
   *
   * 1. News post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. 8 posts per page
   */
  if (is_front_page()) {
    $args = array(
      'post_type'       => 'news',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => 8
    );
  }
  /**
   * News query arguments (for News page)
   *
   * 1. News post type
   * 2. Use date to sort
   * 3. Descending dates (most recent first)
   * 4. Unlimited posts per page
   */
  else {
    $args = array(
      'post_type'       => 'news',
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => -1
    );
  }

  /* Execute the query with the provided arguments */
  $news = new WP_Query($args);

  /* If there is news, begin building the news section */
  if($news->have_posts()) :
?>

<div class="wrapper wrapper-news">
  <div id="news" class="grid-container">

    <?php
      /* If this is the front page, manually output the title */
      if (is_front_page()) {
        echo '<h1 class="entry-title">News</h1>';
      }
      $news_count = 0; // Initialize the count of news articles
      $news_current_year = NULL; // Initialize the current year

      /* While the news query still has posts, do stuff */
      while($news->have_posts()) :
        $news->the_post(); // Get the current post
        $news_year = get_the_date('Y'); // Get the year of the news article
        $news_other_content_field = get_field('news_article_link_to_other_content'); // Get the other content checkbox
        $news_other_content = 'no'; // Set the other content to no by default

        /* If the other content checkbox is not empty, set other content to its value */
        if (!empty($news_other_content_field)) {
          $news_other_content = $news_other_content_field[0];
        }

        /* If the current year does not equal the year for this news article, do stuff */
        if ($news_current_year != $news_year) {
          $news_current_year = $news_year; // Make the current year the year of the article

          /* If this is the front page, output some html to open a container for cards of this year */
          if (is_front_page()) {
            echo '<div class="card-grid-container clearfix">';
          }
          /* Otherwise, do some stuff */
          else {

            /* If the news count is not empty, output a div to close the card container */
            if ($news_count != 0) {
              echo '</div>';
            }

            /* Output the year for this section of news as a title */
            echo '<h2 class="section-title">' . $news_current_year . '</h2><div class="card-grid-container clearfix">';
          }
        }
        $article_thumbnail = get_the_post_thumbnail(); // Get the featured image
        $article_tweet = get_field('news_article_tweet'); // Get the article tweet/tagline
    ?>

    <div class="card-grid grid-25 tablet-grid-33 mobile-grid-100">
      <div class="card">

        <?php if($article_thumbnail) : ?>

        <div class="card-image waves-effect">

          <?php the_post_thumbnail('news-article-thumbnail', array('class' => 'activator')); ?>

        </div><!-- .card-image -->

        <?php endif; ?>

        <div class="card-content">

          <?php the_title('<p class="card-title activator">', '</p>'); ?>

          <p>

            <?php if($news_other_content == 'yes'): ?>

            <a href="<?php the_field('news_article_other_content_url'); ?>" target="_blank"><i class="fa fa-arrow-circle-o-right"></i><?php the_field('news_article_other_content_link_text'); ?></a>

            <?php else: ?>

            <a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-circle-o-right"></i>See more...</a>

            <?php endif; ?>

          </p>
        </div><!-- .card-content -->

        <?php if($article_tweet) : ?>

        <div class="card-reveal">
          <span class="card-title clearfix"><i class="waves-effect waves-circle mdi-navigation-close right"></i></span>

          <?php the_field('news_article_tweet'); ?>

        </div><!-- .card-reveal -->

        <?php endif; ?>

      </div><!-- .card -->
    </div><!-- .card-grid -->

    <?php
        $news_count++; // Incremement the news count
      endwhile;
      echo '</div>'; // Output a final div to close the container
      wp_reset_postdata();
    ?>

  </div><!-- #news -->
</div><!-- .wrapper.wrapper-news -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
