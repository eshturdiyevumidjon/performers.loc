<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['task/view', 'id' => $id]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($ispolnitel->username) ?>,</p>

    <p>You have a new order from <?=$zakazchik->username?>:</p>
    <p>Phone : <?=$zakazchik->phone?>:</p>

    <p>Follow the link below to view to a new order:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
