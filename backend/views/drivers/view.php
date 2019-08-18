<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Drivers */
?>
<div class="drivers-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fio',
            'phone',
            'user_id',
        ],
    ]) ?>

</div>
