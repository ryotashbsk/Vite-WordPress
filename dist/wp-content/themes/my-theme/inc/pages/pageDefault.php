<?php
$contents = get_field('contents');
?>

<?php foreach($contents as $content): ?>
  <?php if ($content['acf_fc_layout'] === 'layout_heading'): ?>
  <h2><?php echo esc_html($content['heading']); ?></h2>
  <?php endif; ?>
  
  <?php if ($content['acf_fc_layout'] === 'layout_text'): ?>
    <?php echo wp_kses_post($content['text']); ?>
  <?php endif; ?>
<?php endforeach; ?>
