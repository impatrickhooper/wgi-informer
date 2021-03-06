<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WGI Informer
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-admin-bar">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php
  /* If this is the Offices page, lock the viewport from zooming */
  if (is_page(16)){
     echo '<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />';
  }
  /* Otherwise, allow the user to zoom in and out */
  else {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
  }
?>

<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<?php wp_head(); ?>

</head>

<?php
  /* Load current user info */
  global $current_user;
  get_currentuserinfo();
?>

<body <?php body_class(); ?>>

  <div id="page" class="hfeed site">

    <?php
      /* If the user is logged in, load the slide-out side navigation */
      if (is_user_logged_in()) {
        get_template_part('template-parts/content_wgiinformer', 'side-nav');
      }
    ?>

    <header id="masthead" class="site-header navbar-fixed" role="banner">
        <nav id="site-navigation" class="main-navigation" role="navigation">
          <div class="nav-wrapper grid-container grid-container-full">

            <?php

              /* Get the logo */
              get_template_part('template-parts/content_wgiinformer', 'logo');

              /* If user is logged in, output the rest of the nav */
              if (is_user_logged_in()):
            ?>

            <ul class="right">
              <li class="nav_spotlight">
                <a href="#spotlight" class="spotlight-trigger waves-effect waves-circle" title="Spotlight"><i class="fa fa-lightbulb-o"></i></a>
              </li><!-- .nav_spotlight -->
              <li class="nav_favorites">
                <a href="#" class="dropdown-button waves-effect waves-circle" data-beloworigin="true" data-activates="favorites" title="Favorites"><i class="fa fa-star"></i></a>

                <?php get_template_part('template-parts/content_wgiinformer', 'favorites'); ?>

              </li><!-- .nav_favorites -->
              <li class="nav_navigation">
                <a href="#" data-activates="main-nav" class="button-collapse show-on-large waves-effect waves-circle"><i class="fa fa-bars" title="Navigation"></i></a>
              </li><!-- .nav_navigation -->
            </ul><!-- .right -->

            <?php endif; ?>

          </div><!-- .nav-wrapper -->
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
      <div id="wrapper">
