<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */
?>
<div class="request-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'task_id',
            'date_create',
            'price',
            'user_id',
            'car_id',
        ],
    ]) ?>

</div>
