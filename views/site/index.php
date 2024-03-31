<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Home of ' . Yii::$app->name;
?>
<div class="row row-cols-1 row-cols-md-2 site-index">
  <div class="col">
    <h2>Recent Posts</h2>
    <?php if (count($recentPosts)): ?>
      <?php foreach($recentPosts as $post): ?>
      <div class="mb-3 pb-2 border-bottom">
        <h3 class="fs-6 fw-bold mb-0"><?php echo Html::a($post->title, ['post/view', 'author' => $post->author->slug, 'slug' => $post->slug]); ?></h3>
        <div class="text-secondary small">
          <?php echo Html::a($post->writtenAt, [
            'post/index',
            'y' => $post->year,
            'm' => $post->month,
            'd' => $post->day
            ], [
              'class' => 'text-secondary fw-semibold text-decoration-none'
            ]);
          ?>
          <?php if ( !isset($author)): ?>
          by <?php echo Html::a($post->author->name, ['post/author', 'authorSlug' => $post->author->slug]); ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="col">
    <h2>Popular Posts</h2>
    <?php if (count($popularPosts)): ?>
      <?php foreach($popularPosts as $post): ?>
      <div class="mb-3 pb-2 border-bottom">
        <h3 class="fs-6 fw-bold mb-0"><?php echo Html::a($post->title, ['post/view', 'author' => $post->author->slug, 'slug' => $post->slug]); ?></h3>
        <div class="text-secondary small">
          <?php echo Html::a($post->writtenAt, [
            'post/index',
            'y' => $post->year,
            'm' => $post->month,
            'd' => $post->day
            ], [
              'class' => 'text-secondary fw-semibold text-decoration-none'
            ]);
          ?>
          <?php if ( !isset($author)): ?>
          by <?php echo Html::a($post->author->name, ['post/author', 'authorSlug' => $post->author->slug]); ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
