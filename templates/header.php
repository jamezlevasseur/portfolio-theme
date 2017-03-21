<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img class="brand-logo" src="<?php echo IMAGES_URL.'p-logo.svg'; ?>" /></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        echo wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]);
      endif;
      ?>
    </nav>
  </div>
</header>
