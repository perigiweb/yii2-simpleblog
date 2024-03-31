<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$pageTitle = "Edit Profile";
$this->title = $pageTitle . " | " . Yii::$app->name;
?>
<div class="d-flex justify-content-center register-page">
  <div style="max-width: 480px;" class="w-100">
    <div class="card mb-4">
      <div class="card-header">
        <h1><?= Html::encode($pageTitle) ?></h1>
      </div>
      <div class="card-body">
        <?php if (Yii::$app->session->hasFlash('profileUpdated')): ?>
        <div class="alert alert-success">Profile successfully updated.</div>
        <?php endif; ?>

        <?php
        $form = ActiveForm::begin([
          'id' => 'login-form',
          'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-label'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'invalid-feedback'],
          ],
        ]);
        ?>

        <?= $form->field($model, 'email')->textInput(['tabIndex' => 1, 'disabled' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['tabIndex' => 2]) ?>

        <?= $form->field($model, 'name')->textInput(['tabIndex' => 3]) ?>

        <?= Html::submitButton('Save Profile', ['class' => 'btn btn-primary', 'name' => 'edit-profile-button', 'tabIndex' => 4]) ?>

        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>