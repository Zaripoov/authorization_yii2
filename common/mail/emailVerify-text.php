<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['authorization/verify-email', 'token' => $user->verification_token]);
?>
Hello <?= $user_profile->surname ?> <?= $user_profile->name ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
