<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transports */
?>
<div class="transports-update">

    <?= $this->render('_form', [
        'model' => $model,
        'drivers'=>$drivers,
        'models'=>$models,
        'marks'=>$marks,
    ]) ?>

</div>
