<?php

namespace app\models;

use DateTime;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Post extends ActiveRecord {

  public function behaviors()
  {
    return [
      [
        'class' => SluggableBehavior::class,
        'attribute' => 'title',
        'ensureUnique' => true,
      ],
      [
        'class' => TimestampBehavior::class,
        'value' => new Expression('NOW()'),
      ]
    ];
  }

  public function rules()
  {
    return [
      [['title', 'content'], 'required'],
    ];
  }

  public function getAuthor(){
    return $this->hasOne(User::class, ['id' => 'user_id']);
  }

  public function getWrittenAt($format = 'm/d/Y H:i'){
    $dateTime = new DateTime($this->created_at);
    return $dateTime->format($format);
  }

  public function getYear(){
    $dateTime = new DateTime($this->created_at);
    return $dateTime->format('Y');
  }

  public function getMonth(){
    $dateTime = new DateTime($this->created_at);
    return $dateTime->format('m');
  }

  public function getDay(){
    $dateTime = new DateTime($this->created_at);
    return $dateTime->format('d');
  }
}