<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WGI Informer
 */
?>

      </div><!-- #wrapper -->
    </div><!-- #content -->
    <footer id="colophon" class="site-footer" role="contentinfo">

      <?php
        /* If the user is loggged in, do stuff */
        if (is_user_logged_in()):

          /* Load the Spotlight section */
          get_template_part('template-parts/content_wgiinformer', 'spotlight');

          /* Load the floating Forms button */
          get_template_part('template-parts/content_wgiinformer', 'floating-buttons');
        endif;
      ?>

    </footer><!-- #colophon -->
  </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
