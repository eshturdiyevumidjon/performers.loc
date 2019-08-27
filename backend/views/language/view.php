<?php

use yii\widgets\DetailView;
$adminka = Yii::$app->params['adminka'];

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
                    return "<img src='/admin".$data->image."'>";
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
