<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
?>
<div class="orders-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'task_id',
            'date_pay',
            'amount',
            'status',
        ],
    ]) ?>

</div>
