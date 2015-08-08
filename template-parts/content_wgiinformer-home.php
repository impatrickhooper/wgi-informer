<?php
/**
 * The template part for displaying the Home page.
 *
 * @package WGI Informer
 */
?>

<div id="home" class="clearfix">

  <?php
    /* If this is the home page, get the Announcements slider */
    if (is_front_page()):
      get_template_part('template-parts/content_wgiinformer', 'announcements');
    endif;
  ?>

  <?php get_template_part('template-parts/content_wgiinformer', 'events'); ?>

  <?php get_template_part('template-parts/content_wgiinformer', 'news'); ?>

  <div class="wrapper wrapper-new-employees">
    <div class="grid-container">

      <?php
        /* If the home page has content, get the New Employees section */
        if (get_the_content()):
          get_template_part('template-parts/content_wgiinformer', 'new-employees');
        endif;
      ?>

      <?php get_template_part('template-parts/content_wgiinformer', 'birthdays'); ?>

      <?php get_template_part('template-parts/content_wgiinformer', 'anniversaries'); ?>

    </div><!-- .grid-container -->
  </div><!-- .wrapper.wrapper-new-employees -->

  <?php get_template_part('template-parts/content_wgiinformer', 'photos'); ?>

</div><!-- #home -->
