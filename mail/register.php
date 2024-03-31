<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

?>
<p>Hi, <?php echo Html::encode($user->name); ?></p>
<h2>Please Verify Your Email</h2>
<p>Please click link below to verify your email.</p>
<p><?php echo Html::a('Verify Email', Url::toRoute(['/auth/verify-email/', 'c' => StringHelper::base64UrlEncode($user->email . ':' . $user->verify_code)], true)); ?></p>
<p>Thanks</p>