<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EditProfileForm extends Model {
  public $email;
  public $password;
  public $name;

  private $_user;

  public function rules()
  {
    return [
      [['name'], 'required'],
    ];
  }

  public function checkEmail($attribute){
    if (!$this->hasErrors() && $this->isAttributeChanged($attribute)) {
      $emailExist = User::findByEmail($this->email);

      if ($emailExist){
        $this->addError($attribute, 'Email is registered. Please use another email address.');
      }
    }
  }

  public function setUser($user){
    $this->_user = $user;

    $this->email = $user->email;
    $this->name = $user->name;
    $this->password = '';
  }

  public function updateProfile(array $post){
    if ( !isset($post[$this->formName()])){
      return false;
    }

    $this->setAttributes($post[$this->formName()], false);

    if ($this->validate()){
      $this->_user->name = $this->name;
      //$this->_user->email = $this->email;

      if($this->password != ''){
        $this->_user->setPassword($this->password);
      }

      if ($this->_user->save()){
        if ($this->_user->isAttributeChanged('email')){
          Yii::$app->mailer->compose('register', ['user' => $this->_user])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo([$this->_user->email => $this->_user->name])
            ->setSubject('Please Verify Your Email')
            ->send();
        }

        return true;
      }
    }

    return false;
  }
}