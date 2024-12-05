<?php
$contents = get_field('contents');
?>

<div class="post">
  <div class="inner">
   
    <h1 class="post-title"><?php the_title(); ?></h1>
    
    <div class="post-content">
      <?php if ($contents): ?>
        <?php foreach ($contents as $content): ?>
          <?php if ($content['acf_fc_layout'] === 'layout_heading'): ?>
          <h2><?= wp_kses_post($content['heading']); ?></h2>
          <?php endif; ?>
          
          <?php if ($content['acf_fc_layout'] === 'layout_text'): ?>
            <?= wp_kses_post($content['text']); ?>
          <?php endif; ?>
					
          <?php if ($content['acf_fc_layout'] === 'layout_img'): ?>
					<figure>
						<img src="<?= esc_url($content['img']); ?>" alt="">
						<?php if ($content['caption']): ?>
						<figcaption><?= wp_kses_post($content['caption']); ?></figcaption>
						<?php endif; ?>
					</figure>
					<?php endif; ?>
					
					<?php if ($content['acf_fc_layout'] === 'layout_video'): ?>
						<div class="video">
							<?= wp_kses_post($content['video']); ?>
						</div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      
    </div>
  </div>
</div>
