<?php
/**
 * The template part for displaying the Side Nav.
 *
 * @package WGI Informer
 */
?>

<div id="main-nav" class="menu nav-menu side-nav">

  <?php
    /* Load a few pieces of information for a user from their profile */
    $user_profile_id = get_current_user_id(); // Get the user ID
    $user_profile_division = strtolower(preg_replace('/&/i', 'and', preg_replace('/\s/i', '-', get_user_meta($user_profile_id, 'division', true)))); // Get the user division, replace "&" with "and", replace space with "-"
    $user_profile_photo = get_user_meta($user_profile_id, 'profile_photo', true); // Get link to photo
    $user_profile_data = get_userdata($user_profile_id); // Get user data
    $user_profile_name = $user_profile_data->display_name; // Get user's name
    $user_profile_email = $user_profile_data->user_email; // Get user's email
  ?>

  <div class="side-nav_top <?php echo $user_profile_division; ?>">
    <div class="side-nav_top-links">
      <a href="<?php echo site_url(); ?>/logout" class="user-profile_sign-out user-profile_link"><i class="fa fa-sign-out"></i><span>sign out</span></a>
      <a href="<?php echo site_url(); ?>/user" class="user-profile_account user-profile_link"><i class="fa fa-user"></i><span>profile</span></a>
    </div>

    <?php
      /* If there's a user photo, load it here */
      if ($user_profile_photo != '') {
        echo '<p class="user-profile_img clearfix"><img src="' . site_url() . '/wp-content/uploads/ultimatemember/' . $user_profile_id . '/profile_photo-100.jpg"></p>';
      }
      /* If no photo, use the default */
      else {
        echo '<p class="user-profile_img clearfix"><img src="' . get_stylesheet_directory_uri() . '/img/profile_photo-default.jpg"></p>';
      }
    ?>

    <p class="user-profile_name"><?php echo $user_profile_name; ?></p>
    <p class="user-profile_email"><?php echo $user_profile_email; ?></p>
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => '', 'menu_class' => 'side-nav_menu', 'container' => false ) ); ?>
</div>
