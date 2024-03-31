<?php

namespace app\controllers;

use app\models\EditProfileForm;
use app\models\Post;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class MeController extends Controller {

  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          ['allow' => true, 'roles' => ['@']]
        ]
      ]
    ];
  }

  public function actionIndex(){
    $model = new EditProfileForm();
    $model->setUser(Yii::$app->user->getIdentity());

    if ($model->updateProfile(Yii::$app->request->post())) {
      Yii::$app->session->setFlash('profileUpdated');
      return $this->refresh();
    }

    return $this->render('profile', compact('model'));
  }

  public function actionCreatePost(){
    $model = new Post();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $model->link('author', Yii::$app->user->getIdentity());
      Yii::$app->session->setFlash('postSaved');
      return $this->redirect(['post/view', 'author' => $model->author->slug, 'slug' => $model->slug]);
    }

    return $this->render('post-form', compact('model'));
  }
}