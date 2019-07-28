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
            'adult_passengers',
            'child_count',
            'category_id',
            'flight_number_status',
            'flight_number',
            'meeting_with_sign_status',
            'meeting_with_sign',
            'car_model',
            'car_mark',
            'image',
            'car_on_the_go',
            'weight',
            'width',
            'length',
            'height',
            'classification',
            'loading_required_status',
            'floor',
            'lift',
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
