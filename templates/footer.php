<footer class="content-info">
  <div class="container">
    <div class="row" id="main-footer-row">

      <div class="col-md-4">
        <h4>Contact Me</h4>
        <h5>Please fill out all fields.</h5>
        <form id="contact-form" action="" method="post">
          <input type="text" name="first-name" placeholder="First Name"><br>
          <input type="text" name="last-name" placeholder="Last Name"><br>
          <input type="text" name="subject" placeholder="Subject"><br>
          <textarea name="message" rows="4" cols="30" placeholder="You message..."></textarea><br>
          <div class="g-recaptcha" data-sitekey="6Le4oCgUAAAAAHrOA830WKDmLS0PGRKNeb8NHIRh"></div>
          <input type="reset">
          <input type="submit">
        </form>
      </div>
      <div class="col-md-4">
        <h4>Navigation</h4>
        <ul>
          <li><a href="<?php echo get_site_url() ?>">About</a></li>
          <li><a href="<?php echo get_site_url().'blog' ?>">Blog</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h4>Posts</h4>
        <ul id="recent-posts-list">
          <?php
          wp_reset_query();
          $posts = query_posts(['posts_per_page'=>10]);

          while (have_posts()) {
            the_post();
            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
          }

           ?>
        </ul>
      </div>

    </div>
  </div>
</footer>
<footer id="bottom-row">
  <div class="fluid-container">
    <div class="row" style="margin:0;">
      <div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0">
        <small id="small-left">©Copyright <?php echo date("Y"); ?>, James LeVasseur</small>
        <small id="small-right">or just email me at <a href="mailto:james.levasseur@maine.edu?Subject=I%20Saw%20Your%20Portfolio" target="_top" style="color:white!important;text-decoration:underline;">james.levasseur@maine.edu</a></small>
      </div>
    </div>
  </div>
</footer>

<script src='https://www.google.com/recaptcha/api.js'></script>
