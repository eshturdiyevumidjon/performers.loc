<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tasks */
?>
<div class="tasks-view">
 
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
            'shipping_house_type',
            'shipping_house_floor',
            'shipping_house_lift',
            'shipping_house_area',
            'delivery_house_type',
            'delivery_house_floor',
            'delivery_house_lift',
            'delivery_house_area',
            'item_description:ntext',
            'alert_email:email',
            'view_performers',
        ],
    ]) ?>

</div>
