<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
<p class="byline author vcard" style="margin-bottom:0;"><?= __('By', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></p>
<p>Tags: <span class="tags-container">      <?php $c = get_the_category();
      foreach ($c as $e) {
        echo '<a href="'.get_site_url().'/category/'.$e->slug.'" class="categ">'.$e->name.'</a>';
      }

       ?></span></p>
