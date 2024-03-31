<?php

namespace app\controllers;

use app\models\SignInForm;
use app\models\SignUpForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller {

  /**
   * {@inheritdoc}
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  public function actionSignUp(){
    if ( !Yii::$app->user->isGuest){
      return $this->goHome();
    }

    $model = new SignUpForm();

    if ($model->load(Yii::$app->request->post()) && $model->signUp()) {
      Yii::$app->session->setFlash('signUpFormSubmited');
      return $this->refresh();
    }

    return $this->render('sign-up', compact('model'));
  }

  public function actionVerifyEmail(){
    if ( !Yii::$app->user->isGuest){
      return $this->goHome();
    }

    $emailVerified = false;
    $c = Yii::$app->request->get('c');
    if ($c && User::verifyEmail($c)){
      $emailVerified = true;
    }

    return $this->render('email-verified', compact('emailVerified'));
  }

  public function actionSignIn(){
    $model = new SignInForm();

    if ($model->load(Yii::$app->request->post()) && $model->signIn()) {
      return $this->goHome();
    }

    $model->password = '';
    return $this->render('sign-in', compact('model'));
  }

  public function actionSignOut(){
    Yii::$app->user->logout();

    return $this->goHome();
  }
}