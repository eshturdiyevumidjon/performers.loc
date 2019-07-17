<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Lang */
?>
<div class="lang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'image',
            'url:url',
            'local',
            'name',
            'date_update',
            'default',
            'status',
            'date_create',
        ],
    ]) ?>

</div>
