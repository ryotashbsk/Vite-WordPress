</main>

<footer class="footer">
  <ul class="footer-nav"> 
    <?php foreach (NAV_ITEMS as $nav_item): ?>
      <li class="footer-nav-item">
        <a href="<?= esc_url($nav_item['link']); ?>" class="footer-nav-item"><?= esc_html($nav_item['label']); ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
  
  <div class="footer-copy">
    <small>&copy; COPYRIGHT</small>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>