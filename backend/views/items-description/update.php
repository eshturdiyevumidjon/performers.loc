<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TransportCategory */
?>
<div class="transport-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'names' => $names,
    ]) ?>

</div>
