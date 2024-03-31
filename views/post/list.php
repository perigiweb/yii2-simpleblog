<?php

use yii\bootstrap5\LinkPager;
use yii\helpers\Html;

$this->title = $pageTitle . ' | ' . Yii::$app->name;

if ((isset($y) && $y) || (isset($m) && $m) || (isset($d) && $d)){
  $this->params['breadcrumbs'][] = ['label' => 'All Posts', 'url' => ['post/index']];
  if ($y && $m){
    $this->params['breadcrumbs'][] = ['label' => $y, 'url' => ['post/index', 'y' => $y]];
  }
  if ($m & $d){
    $this->params['breadcrumbs'][] = ['label' => $m, 'url' => ['post/index', 'y' => $y, 'm' => $m]];
  }
}

$this->params['breadcrumbs'][] = $pageTitle;
?>
<div>
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4"><?php echo Html::encode($pageTitle); ?></h1>
    <?php if (isset($viewAllLink) && $viewAllLink) Html::a('All Posts', ['post/index']) ?>
  </div>
  <?php if (count($posts)): ?>
    <?php foreach($posts as $post): ?>
    <div class="mb-3 pb-2 border-bottom">
      <h3 class="fs-6 mb-0"><?php echo Html::a($post->title, ['post/view', 'author' => $post->author->slug, 'slug' => $post->slug]); ?></h3>
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
  <?php echo LinkPager::widget(['pagination' => $pagination]); ?>
  <?php else: ?>
  <div class="alert alert-warning">No posts!</div>
  <?php endif; ?>
</div>