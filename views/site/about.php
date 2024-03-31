<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$pageTitle = "About";
$this->title = $pageTitle . ' | ' . Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($pageTitle) ?></h1>

    <p>
        This is a simple application made with Yii 2 framework. It's implement user registration, login dan post content for logged in user.
    </p>
    <p>Source code for this website can be found on <a href="https://github.com/perigidev/yii2-simpleblog">Github</a>.</p>
</div>
