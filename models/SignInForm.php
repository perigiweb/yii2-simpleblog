<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignInForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignInForm extends Model
{
  public $email;
  public $password;
  public $rememberMe = true;

  private $_user = false;


  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
      // username and password are both required
      [['email', 'password'], 'required'],
      // rememberMe must be a boolean value
      ['rememberMe', 'boolean'],
      // password is validated by validatePassword()
      ['email', 'validateEmailStatus'],
      ['password', 'validatePassword'],
    ];
  }

  /**
   * Validates email status, verified or not.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validateEmailStatus($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      if (!$user || $user->status == 0) {
        $this->addError($attribute, 'Email not verified. Please check your email address and click verify link.');
      }
    }
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Incorrect username or password.');
      }
    }
  }

  /**
   * Logs in a user using the provided username and password.
   * @return bool whether the user is logged in successfully
   */
  public function signIn()
  {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
    return false;
  }

  /**
   * Finds user by [[email]]
   *
   * @return User|null
   */
  public function getUser()
  {
    if ($this->_user === false) {
      $this->_user = User::findByEmail($this->email);
    }

    return $this->_user;
  }
}
