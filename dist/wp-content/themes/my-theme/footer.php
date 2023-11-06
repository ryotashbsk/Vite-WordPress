    <footer class="footer">
      <div class="footer-nav"> 
        <?php foreach (NAV_ITEMS as $nav_item): ?>
          <a href="<?php echo esc_url($nav_item['link']); ?>" class="footer-nav-item"><?php echo esc_html($nav_item['label']); ?></a>
        <?php endforeach; ?>
      </div>
      
      <div class="footer-copy">
        <small>&copy; COPYRIGHT</small>
      </div>
    </footer>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>