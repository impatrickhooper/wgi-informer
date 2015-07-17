<?php
/**
 * The template part for displaying the home page Anniveraries.
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
   * Anniversaries query arguments
   *
   * 1. Exclude the admin user
   * 2. Query the years of service
   * 3. Query ones with date in current month
   * 4. Query using regular expressions
   */
  $anniversary_args = array(
    'exclude'         => array(2),
    'meta_key'        => 'years_of_service',
    'meta_value'      => '[0-9]{4}\/' . date('m') . '\/[0-9]{2}',
    'meta_compare'    => 'REGEXP'
  );

  /* Execute the query with the provided arguments */
  $anniversaries = new WP_User_Query($anniversary_args);
  $anniversary_users_query = $anniversaries->get_results();

  /* Initialize empty array to hold users with anniversaries this month */
  $anniversary_users = array();

  /* If the anniversary users query is not empty, begin build anniversaries section */
  if (!empty($anniversary_users_query)) :
?>

<div id="anniversaries" class="grid-50 tablet-grid-50 mobile-grid-100">
  <h1 class="entry-title">Anniversaries</h1>
  <div class="anniversaries-grid clearfix">

    <?php
      /* For each anniversary user in the query, do stuff */
      foreach ($anniversary_users_query as $anniversary_user_query):
        $anniversary_user_id = $anniversary_user_query->ID; // Get the user ID
        $anniversary_user_info = get_userdata($anniversary_user_id); // Get the user data
        $anniversary_user_anniversary = $anniversary_user_info->years_of_service; // Get the hire date

        /**
         * Build an array of info for this user
         *
         * 1. Day of the anniversary
         * 2. Name
         * 3. Anniversary as MMM dd
         * 4. Photo url
         * 5. User ID
         * 6. Hire date converted to years of service
         * 7. Full name (firstname.lastname)
         */
        $anniversary_user_array = array(
          'dayAsID'        => date('d', strtotime($anniversary_user_anniversary)),
          'name'           => $anniversary_user_info->first_name . ' ' . $anniversary_user_info->last_name,
          'anniversary'    => date('M d', strtotime($anniversary_user_anniversary)),
          'photo'          => $anniversary_user_info->profile_photo,
          'userID'         => $anniversary_user_id,
          'years'          => yearsAgo($anniversary_user_anniversary),
          'nameID'         => $anniversary_user_info->full_name
        );

        /* Push the user into the users array */
        array_push($anniversary_users, $anniversary_user_array);
      endforeach;

      /**
       * Sort the anniversary users array
       *
       * 1. Based first on day of the month
       * 2. Based second on name
       */
      foreach ($anniversary_users as $key => $row) {
        $dayAsID[$key]  = $row['dayAsID'];
        $name[$key] = $row['name'];
      }
      array_multisort($dayAsID, SORT_ASC, $name, SORT_ASC, $anniversary_users);

      /* For each anniversary user in the array, do stuff if their years of service > 0 */
      foreach($anniversary_users as $anniversary_user):
        if ($anniversary_user['years'] != '0 years'):
    ?>

    <div class="anniversary-person grid-25 tablet-grid-33 mobile-grid-33">
      <a href="<?php echo site_url() . '/user/' . $anniversary_user['nameID']; ?>">

        <?php
          /* If a photo exists, output html for their profile picture */
          if ($anniversary_user['photo'] != '') {
            $anniversary_img_html = '<img src="' . site_url() . '/wp-content/uploads/ultimatemember/' . $anniversary_user['userID'] . '/profile_photo-100.jpg">';
            $anniversary_img_html = apply_filters('bj_lazy_load_html', $anniversary_img_html); // Lazy load it
          }
          /* If no photo, use the default */
          else {
            $anniversary_img_html = '<img src="' . get_stylesheet_directory_uri() . '/img/profile_photo-default.jpg">';
            $anniversary_img_html = apply_filters('bj_lazy_load_html', $anniversary_img_html); // Lazy load it
          }
        ?>

        <div class="anniversary-person_photo"><?php echo $anniversary_img_html ?></div>
        <div class="anniversary-person_name"><?php echo $anniversary_user['name']; ?></div>
        <div class="anniversary-person_day"><?php echo $anniversary_user['anniversary']; ?></div>
        <div class="anniversary-person_years"><?php echo $anniversary_user['years']; ?></div>
      </a>
    </div><!-- .anniversary-person -->

    <?php
        endif;
      endforeach;
    ?>

  </div><!-- .anniversaries-grid -->
</div><!-- #anniversaries -->

<?php endif; ?>

<?php date_default_timezone_set($default_tz); ?>
