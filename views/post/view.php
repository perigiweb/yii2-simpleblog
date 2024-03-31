<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $post->title . ' by ' . $post->author->name . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'][] = ['label' => 'All Posts', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = ['label' => $post->year, 'url' => ['post/index', 'y' => $post->year]];
$this->params['breadcrumbs'][] = ['label' => $post->month, 'url' => ['post/index', 'y' => $post->year, 'm' => $post->month]];
$this->params['breadcrumbs'][] = ['label' => $post->day, 'url' => ['post/index', 'y' => $post->year, 'm' => $post->month, 'd' => $post->day]];
?>
<h1 class="fw-bold"><?php echo Html::encode($post->title); ?></h1>
<div class="small text-secondary mb-4">Written by <?php
  echo Html::a($post->author->name, ['post/author', 'authorSlug' => $post->author->slug]);
  ?> on <?php
  echo Html::a($post->writtenAt, [
    'post/index',
    'y' => $post->year,
    'm' => $post->month,
    'd' => $post->day
  ], [
    'class' => 'text-secondary fw-semibold text-decoration-none'
  ]);
  ?>
</div>
<article><?php
echo HtmlPurifier::process($post->content, [
  'HTML.SafeIframe' => true,
  'URI.SafeIframeRegexp' => '%^https://(www.youtube.com/embed/|player.vimeo.com/video/|platform.twitter.com/embed/Tweet.html)%'
]); ?></article>