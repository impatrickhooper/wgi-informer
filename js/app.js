/* ==========================================================================
   WGI Informer JavaScript / jQuery
   ========================================================================== */
(function($) {

  /* Navigation
  ========================================================================== */

  /* Initializes Spotlight icon in navigation to open Spotlight bottom modal */
  $('.spotlight-trigger').leanModal();

  /* Initializes Favorites icon in navigation to open Favorites dropdown */
  $('.dropdown-button').dropdown();

  /* Initializes menu icon in navigation to toggle side navigation */
  $('.button-collapse').sideNav({
    menuWidth: 280
  });

  /**
   * Favorites height
   *
   * 1. Checks if the height of the Favorites extends past the bottom of the window
   * 2. If yes, sets max height to space below header, automatically handles overflow
   */
  if($('#favorites').height() > ($(window).height() - $('#masthead').height())) {
    $('#favorites').css({
      'max-height': $(window).height() - $('#masthead').height(),
      'overflow-y': 'auto'
    });
  }

  /* Home
  ========================================================================== */

  /* Initializes the Announcements slider */
  $('.slider').slider({
    duration: 600,
    height: 600,
    interval: 6000
  });

  /* News
  ========================================================================== */

  /* As a News image finishes loading, update masonry layout */
  $('#news img').load(function() {
    $('#news .card-grid-container').masonry({
      itemSelector: '.card-grid',
      percentPosition: true
    })
  });

  /* Offices
  ========================================================================== */

  /* Initialize variables used to calculate Offices map height */
  var windowHeight = $(window).height(); // Height of the window
  var mastheadHeight = $('#masthead').height(); // Height of the header
  var titleHeight = $('.entry-title').outerHeight(true); // Height of the h1 title

  /* Set Offices map to take remaining space underneath header and title */
  $('#offices').height(windowHeight - (mastheadHeight + titleHeight));

  /* People
  ========================================================================== */

  /* Directories */

  /* Change the placeholder for the "Display Name" directory filter "Name" */
  $('.um-search-filter #display_name').attr('placeholder', 'Name');

  /**
   * Set member's division
   *
   * 1. Uses jQuery to pull all span -> strong tags containing a members division
   * 2. Gets the parent span of the strong tag
   * 3. Uses span html to build division name class:
   *    a. Replaces strong tag with nothing
   *    b. Replaces "&" with "-and"
   *    c. Replaces spaces with "-"
   *    d. Makes result all lowercase and saves to variable
   * 4. Finds the parent with the class "um-member" and adds the division class to it
   */
  var $divisionColorsProfile = $('.um-member-metaline span strong:contains("Division")');
  $divisionColorsProfile.each(function() {
    var division = $(this).parent().html().replace(/\s*<strong>.*<\/strong>\s*|/g, '').replace(/\s&amp;\s/g, '-and-').replace(/\s/g, '-').toLowerCase();
    $(this).parents('div.um-member').addClass(division);
  });

  /* Gets all directory "Years of Service" fields and removes " old" from "years old" */
  var $yearsServiceProfile = $('.um-member-metaline span strong:contains("Years of Service")').parent();
  $yearsServiceProfile.each(function() {
    $(this).html($(this).html().replace(/\sold/g, ''));
  });

  /* Gets all directory "Birthday" fields and removes year from them */
  var $birthdayProfile = $('.um-member-metaline span strong:contains("Birthday")').parent();
  $birthdayProfile.each(function() {
    $(this).html($(this).html().replace(/\s\d{4}/g, ''));
  });

  /* Profiles */

  /* Gets all profile "Years of Service" fields and removes " old" from "years old" */
  var $yearsServiceFields = $('.um-field-years_of_service .um-field-area .um-field-value');
  $yearsServiceFields.each(function() {
    $(this).text($(this).text().replace(/\sold/g, ''));
  });

  /* Gets all profile "Birthday" fields and removes year from them */
  var $birthdayFields = $('.um-field-birthday .um-field-area .um-field-value');
  $birthdayFields.each(function() {
    $(this).text($(this).text().replace(/\s\d{4}/g, ''));
  });

  /* Footer
  ========================================================================== */

  /* Spotlight */

  /* Set max height to the windows max height */
  $('#spotlight').css('max-height', $(window).height());

  /* Typeform */

  /* Code provided by Typeform to intialize a Typeform slide-in */
  (function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})()

})(jQuery);

