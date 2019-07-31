<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
?>
<div class="tasks-view3">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'payed_sum',
            'status',
            'date_cr',
            'date_close',
            'position',
            'user_id',
            'shipping_address:ntext',
            'delivery_address:ntext',
            'shipping_coordinate_x',
            'shipping_coordinate_y',
            'delivery_coordinate_x',
            'delivery_coordinate_y',
            'date_begin',
            'offer_your_price',
            'promo_code',
            'comment:ntext',
            'image',
            'weight',
            'width',
            'length',
            'height',
            'classification',
            'loading_required_status',
            'floor',
            'lift',
           
        ],
    ]) ?>

</div>
