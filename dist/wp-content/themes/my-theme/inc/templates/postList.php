<li class="postList-item">
  <a href="<?= esc_url(get_permalink()); ?>" class="postList-item-link">
    <time><?php esc_html(the_date('Y.m.d')); ?></time>
    <h3 class="postList-item-title"><?php the_title(); ?></h3>
  </a>
</li>