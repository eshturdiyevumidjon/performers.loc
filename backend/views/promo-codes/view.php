<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PromoCodes */
?>
<div class="promo-codes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'code',
            'count',
            'used_count',
        ],
    ]) ?>

</div>
