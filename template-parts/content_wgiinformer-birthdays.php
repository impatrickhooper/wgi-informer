<?php
/**
 * The template part for displaying the home page Birthdays.
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
   * Birthdays query arguments
   *
   * 1. Exclude the admin user
   * 2. Query the birthday
   * 3. Query ones with date in current month
   * 4. Query using regular expressions
   */
  $birthday_args = array(
    'exclude'         => array(2),
    'meta_key'        => 'birthday',
    'meta_value'      => '[0-9]{4}\/' . date('m') . '\/[0-9]{2}',
    'meta_compare'    => 'REGEXP'
  );

  /* Execute the query with the provided arguments */
  $birthdays = new WP_User_Query($birthday_args);
  $birthday_users_query = $birthdays->get_results();

  /* Initialize empty array to hold users with birthdays this month */
  $birthday_users = array();

  /* If the birthdays users query is not empty, begin build birthdays section */
  if(!empty($birthday_users_query)) :
?>
<div id="birthdays" class="grid-50 tablet-grid-50 mobile-grid-100">
  <h1 class="entry-title">Birthdays</h1>
  <div class="birthdays-grid clearfix">

    <?php
      /* For each birhday user in the query, do stuff */
      foreach ($birthday_users_query as $birthday_user_query):
        $birthday_user_id = $birthday_user_query->ID; // Get the user ID
        $birthday_user_info = get_userdata($birthday_user_id); // Get the user data
        $birthday_user_birthday = $birthday_user_info->birthday; // Get the birthday

        /**
         * Build an array of info for this user
         *
         * 1. Day of the birthday
         * 2. Name
         * 3. Birthday as MMM dd
         * 4. Photo url
         * 5. User ID
         * 6. Full name (firstname.lastname)
         */
        $birthday_user_array = array(
          'dayAsID'   => date('d', strtotime($birthday_user_birthday)),
          'name'      => $birthday_user_info->first_name . ' ' . $birthday_user_info->last_name,
          'birthday'  => date('M d', strtotime($birthday_user_birthday)),
          'photo'     => $birthday_user_info->profile_photo,
          'userID'    => $birthday_user_id,
          'nameID'    => $birthday_user_info->full_name
        );

        /* Push the user into the users array */
        array_push($birthday_users, $birthday_user_array);
      endforeach;

      /**
       * Sort the birthday users array
       *
       * 1. Based first on day of the month
       * 2. Based second on name
       */
      foreach ($birthday_users as $key => $row) {
        $dayAsID[$key]  = $row['dayAsID'];
        $name[$key] = $row['name'];
      }
      array_multisort($dayAsID, SORT_ASC, $name, SORT_ASC, $birthday_users);

      /* For each birthday user in the array, do stuff */
      foreach($birthday_users as $birthday_user):
    ?>

    <div class="birthday-person grid-25 tablet-grid-33 mobile-grid-33">
      <a href="<?php echo site_url() . '/user/' . $birthday_user['nameID']; ?>">

         <?php
          /* If a photo exists, output html for their profile picture */
          if ($birthday_user['photo'] != '') {
            $birthday_img_html = '<img src="' . site_url() . '/wp-content/uploads/ultimatemember/' . $birthday_user['userID'] . '/profile_photo-100.jpg">';
            $birthday_img_html = apply_filters('bj_lazy_load_html', $birthday_img_html); // Lazy load it
          }
          /* If no photo, use the default */
          else {
            $birthday_img_html = '<img src="' . get_stylesheet_directory_uri() . '/img/profile_photo-default.jpg">';
            $birthday_img_html = apply_filters('bj_lazy_load_html', $birthday_img_html); // Lazy load it
          }
        ?>

        <div class="birthday-person_photo"><?php echo $birthday_img_html ?></div>
        <div class="birthday-person_name"><?php echo $birthday_user['name']; ?></div>
        <div class="birthday-person_day"><?php echo $birthday_user['birthday']; ?></div>
      </a>
    </div><!-- .birthday-person -->

    <?php endforeach; ?>

  </div><!-- .birthdays-grid -->
</div><!-- #birthdays -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
