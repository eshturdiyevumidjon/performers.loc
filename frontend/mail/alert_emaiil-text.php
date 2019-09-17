<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['task/view', 'id' => $id]);
?>
Hello <?= $ispolnitel->username ?>,

Follow the link below to view to a new order:

<?= $verifyLink ?>
