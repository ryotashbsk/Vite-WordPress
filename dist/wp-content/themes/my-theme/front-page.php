<?php
get_header();
?>

<section>
  <ul class="postList">
    <?php
      $news_posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => [
          'meta_value_num' => 'DESC',
          'post_date' => 'DESC',
        ],
      ]); ?>
      <?php if ($news_posts) {
          foreach ($news_posts as $post) {
              setup_postdata($post);
              get_template_part('inc/templates/postList', null, $post);
          }
      } wp_reset_postdata(); ?>
  </ul>
</section>



<?php get_footer();
