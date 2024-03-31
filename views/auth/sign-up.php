<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = "Sign Up";
?>
<div class="d-flex justify-content-center register-page">
  <div style="max-width: 480px;" class="w-100">
    <div class="card mb-4">
      <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
      </div>
      <div class="card-body">
        <?php if (Yii::$app->session->hasFlash('signUpFormSubmited')): ?>
        <div class="alert alert-success">Sign up success. Please check your email and click the verify link to verify your email. You can sign in to our site after your email is verified.</div>
        <?php else: ?>
        <p>Please fill out the following fields to sign up.</p>
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

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'tabIndex' => 1]) ?>

        <?= $form->field($model, 'password')->passwordInput(['tabIndex' => 2]) ?>

        <?= $form->field($model, 'name')->textInput(['tabIndex' => 3]) ?>

        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary', 'name' => 'sign-up-button', 'tabIndex' => 4]) ?>

        <?php ActiveForm::end(); ?>
        <?php endif; ?>
      </div>
    </div>
    <p class="text-center">Already have an account? <a href="/auth/sign-in">Sign In</a> here.</p>
  </div>
</div>