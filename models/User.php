<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\StringHelper;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
  const SCENARIO_LOGIN = 'login';
  const SCENARIO_REGISTER = 'register';
  const SCENARIO_EDIT = 'edit';

  /**
   * {@inheritdoc}
   */
  public static function findIdentity($id)
  {
    return static::findOne($id);
  }

  /**
   * {@inheritdoc}
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    return null;
  }

  /**
   * Finds user by email
   *
   * @param string $email
   * @return static|null
   */
  public static function findByEmail($email)
  {
    return static::findOne(['email' => $email]);
  }

  public static function verifyEmail($code){
    [$e, $c] = StringHelper::explode(StringHelper::base64UrlDecode($code), ':') + ['', ''];

    if ($e && $c){
      $user = static::findByEmail($e);
      if ($user && $user->verify_code == $c){
        $user->status = 1;
        $user->verify_code = null;

        return $user->update(false);
      }
    }

    return false;
  }

  /**
   * {@inheritdoc}
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  /**
   * {@inheritdoc}
   */
  public function validateAuthKey($authKey)
  {
    return $this->auth_key === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return ($this->status == 1 && password_verify($password, $this->password));
  }

  /*
  public function scenarios()
  {
    return [
        self::SCENARIO_LOGIN => ['email', 'password'],
        self::SCENARIO_REGISTER => ['email', '!password', 'name'],
        self::SCENARIO_EDIT => ['!password', 'name'],
    ];
  }
  */

  public function behaviors()
  {
    return [
      [
        'class' => SluggableBehavior::class,
        'attribute' => 'name',
        'ensureUnique' => true,
      ],
      [
        'class' => TimestampBehavior::class,
        'value' => new Expression('NOW()'),
      ]
    ];
  }

  public function fields()
  {
      $fields = parent::fields();

      // remove fields that contain sensitive information
      unset($fields['auth_key'], $fields['password'], $fields['verify_code']);

      return $fields;
  }

  public function beforeSave($insert)
  {
    if (parent::beforeSave($insert)) {
      if ($this->isNewRecord) {
        $this->auth_key = Yii::$app->security->generateRandomString();
        $this->verify_code = Yii::$app->security->generateRandomString(16);
        $this->status = 0;
      }

      return true;
    }
    return false;
  }

  public function setPassword($password){
    $this->setAttribute('password', password_hash($password, PASSWORD_BCRYPT));
  }

  public function getPosts(){
    return $this->hasMany(Post::class, ['user_id' => 'id']);
  }
}
