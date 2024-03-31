<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.0.0/tinymce.min.js', ['position' => View::POS_END], 'tinymce7');
$this->registerJs("tinyMCE.init({
  selector: '#post-content',
  plugins: ['link', 'image', 'charmap', 'media'],
  toolbar: 'blocks bold italic underline strikethrough | alignleft aligncenter alignjustify alignright | link image media charmap',
  menubar: false,
  height: '360px',
  image_uploadtab: false,
  image_class_list: [
    { title: 'Image Fluid', value: 'img-fluid' },
    { title: 'Image Thumbnail', value: 'img-thumbnail' }
  ]
})");

$this->title = $model->id ? "Modify Post":"Create Post";
?>
<div class="d-flex justify-content-center register-page">
  <div style="max-width: 640px;" class="w-100 d-flex flex-column">
    <?php
    $form = ActiveForm::begin([
      'id' => 'post-form',
      'fieldConfig' => [
        'template' => "{input}\n{error}",
        'inputOptions' => ['class' => 'form-control'],
        'errorOptions' => ['class' => 'invalid-feedback'],
      ],
    ]);
    ?>
    <?= $form->field($model, 'title')->textInput(['tabIndex' => 1, 'placeholder' => 'Post Title', 'class' => 'form-control form-control-lg']) ?>
    <?= $form->field($model, 'content')->textarea(['id' => 'post-content', 'rows' => '6']) ?>
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'sign-up-button', 'tabIndex' => 4]) ?>
    <?php ActiveForm::end(); ?>
  </div>
</div>