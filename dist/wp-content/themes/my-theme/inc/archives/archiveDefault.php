<div class="inner">
  <ul class="newsList">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('inc/templates/postList'); ?>
    <?php endwhile; ?>
    <?php endif; ?>
  </ul>
  <?php
    if (function_exists('wp_pagenavi')) {
        wp_pagenavi();
    }
    wp_reset_postdata();
    ?>
</div>