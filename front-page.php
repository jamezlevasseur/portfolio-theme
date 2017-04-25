<section id="intro" class="fluid-container">
  <div class="col-md-8 col-md-offset-2">

    <img id="bighead" src="<?php echo IMAGES_URL.'bighead.png'; ?>" alt="a representation of my big head">

    <h1 class="white">Welcome, I'm James.</h1>
    <h1 class="white">I'm a developer.</h1>

  </div>
</section>
<section id="about">
  <div class="inner-content container">
    <div class="lefty">
      <h2>A little about me</h2>
      <p>
        I’m James, a young developer born in Massachusetts and raised in Maine.
        I graduated from the University of Maine in May of 2016 with a BA in new media
        minoring in film &amp; computer science.
      </p>
      <br>
      <p>
        I really love making things! From building apps to designing interfaces I
        just like attacking problems and figuring out the best way to solve them.
        I built this portfolio myself to demonstrate that!
      </p>
    </div>
    <div class="righty">
      <h2>Some Quick Facts</h2>
      <ul class="cute-list">
      </ul>
      <button style="display:none;" type="button" id="more-facts">More Facts?</button>
    </div>
  </div>
</section>
<section id="tags">
  <div class="inner-content container">
    <h2>Have a look at some of my best work.</h2>
    <?php
    // get sticky posts from DB
    $sticky = get_option('sticky_posts');
    // check if there are any
    if (!empty($sticky)) {
        // optional: sort the newest IDs first
        rsort($sticky);
        // override the query
        $args = array(
            'post__in' => $sticky
        );
        query_posts($args);
        // the loop
        $post_count = 1;
        while (have_posts() && $post_count<=3) {
          the_post();
          $post_count++;
          ?>
          <a href="<?php the_permalink(); ?>">
            <div class="sticky-project">
              <?php if ( has_post_thumbnail() ) : ?>
              <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" />
              <?php endif; ?>
              <div class="ribbon">
                <img src="<?php echo IMAGES_URL.'ribbon.png'; ?>" >
                <p class="ribbon-text">
                  <?php the_title(); ?>
                </p>
              </div>
            </div>
          </a>
          <?php
        }
    }
     ?>
     <div class="divider"></div>

    <h3>Or maybe you're looking for something specific?</h3>
    <div id="popular-tags">
      <?php
      $categories = ['php','wordpress','javascript','html','css','java','graphic-design','unity','python','ios','unix-servers','hardware'];

      for ($i=0; $i < count($categories); $i++) {
        echo '<a href="'.get_site_url().'/category/'.$categories[$i].'" class="categ">'.$categories[$i].'</a>';
      }
       ?>
    </div>
  </div>

</section>
