<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignUpForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignUpForm extends Model {
  public $email;
  public $password;
  public $name;

  public function rules()
  {
    return [
      [['email', 'password', 'name'], 'required'],
      [['email'], 'email'],
      [['email'], 'checkEmail'],
    ];
  }

  public function checkEmail($attribute){
    if (!$this->hasErrors()) {
      $emailExist = User::findByEmail($this->email);

      if ($emailExist){
        $this->addError($attribute, 'Email is registered. Please use another email address.');
      }
    }
  }

  public function signUp(){
    $user = new User();
    $user->email = $this->email;
    $user->name = $this->name;
    $user->setPassword($this->password);

    if ($this->validate() && $user->save()){
      Yii::$app->mailer->compose('register', ['user' => $user])
        ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
        ->setTo([$user->email => $user->name])
        ->setSubject('Please Verify Your Email')
        ->send();

      return true;
    }

    return false;
  }
}