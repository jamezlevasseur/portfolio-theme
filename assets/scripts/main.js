
/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */



(function($) {

  var formCanSubmit = false;

  var birthdayLI = function () {
    var bday =  moment([1993, 5, 12, 0, 0, 0]);
    bday = bday.tz('America/New_York');
    var now = moment();
    now = now.tz('America/New_York');

    var years = Math.floor( now.diff(bday, 'years', true) );
    var months = Math.floor( now.diff(bday, 'months', true) )%12;
    var weeks = Math.floor( now.diff(bday, 'weeks', true) )%4;
    var days = Math.floor( now.diff(bday, 'days', true) )%7;
    var hours = Math.floor( now.diff(bday, 'hours', true) )%24;
    var minutes = Math.floor( now.diff(bday, 'minutes', true) )%60;
    var seconds = Math.floor( now.diff(bday, 'seconds', true) )%60;

    months = months>1 ? months+' months' : months+' month';
    weeks = weeks>1 ? weeks+' weeks' : weeks+' week';
    days = days>1 ? days+' days' : days+' day';
    hours = hours>1 ? hours+' hours' : hours+' hour';
    minutes = minutes>1 ? minutes+' minutes' : minutes+' minute';
    seconds = seconds>1 ? seconds+' seconds' : seconds+' second';

    $('#bday').remove();

    $('.cute-list').append('<li id="bday">I am '+years+' years, '+months+', '+weeks+', '+days+', '+hours+', '+minutes+', and '+seconds+' old.</li>');
    setTimeout(function () {
        birthdayLI();
    }, 5000);
  };

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        jQuery('.ribbon-text').circleType({position: 'relative', radius: 500, dir: -1, fitText:true});
        $('#contact-form input[type=submit]').click(function (e) {
          if ('' == grecaptcha.getResponse()) {
            alert('fill out recaptcha.')
            return false;
          }

          if ($('#contact-form input[type=text][name=first-name]').val()==='' ||
              $('#contact-form input[type=text][name=last-name]').val()==='' ||
              $('#contact-form input[type=text][name=subject]').val()==='' ||
              $('#contact-form textarea[name=message]').val()===''
            )
            {
              alert('Please fill out all fields.');
              return false;
            }
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired

      }
    },
    // Home page
    'home': {
      init: function() {
        $('.cute-list').append('<li>I have most of my experience building things in Wordpress, JS, PHP, and Java. <a href="http://localhost:8888/portfolio/wp-content/uploads/2017/03/levasseur_resume.pdf" target="_blank">Click here for my Resume</a>, or <a href="http://localhost:8888/portfolio/wp-content/uploads/2017/03/monty-python-spanish-inquisition.png" target="_blank">here for something unexpected</a>.</li>');
        $('.cute-list').append('<li>I like mucking around on code fights. <a href="https://codefights.com/profile/james_guy_dude" target="_blank">Here\'s my profile</a>.');
        birthdayLI();
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
