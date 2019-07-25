<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Lang */
?>
<div class="lang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'format'=>'raw',
                'attribute'=>'image',
                'value'=>function($data){
                    return "<img src='".$data->image."'>";
                }
            ],
            'url:url',
            'local',
            'name',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->StatusName();
                }
            ],
        ],
    ]) ?>

</div>
