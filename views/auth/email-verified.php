<?php
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = $emailVerified ? "Email Vefiried":"Email Not Verified";
?>
<div class="d-flex justify-content-center register-page">
  <div style="max-width: 480px;" class="w-100">
    <div class="card mb-4">
      <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
      </div>
      <div class="card-body">
        <?php if ($emailVerified): ?>
        <div class="alert alert-success">Email successfully verified. Now you can <?php echo Html::a('sign in', Url::toRoute('/auth/sign-in'), ['class' => 'card-link']); ?> to create post.</div>
        <?php else: ?>
        <div class="alert alert-warning">Email was not successfully verified. Your verified link is expired or not valid.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>