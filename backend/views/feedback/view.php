<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */
?>
<div class="feedback-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
            'email:email',
             [
                'attribute'=>'message',
                'value'=>$model->message,
                'contentOptions' => ['class' => 'bg-red','style'=>'word-break: break-all;'],
            ],
            [
                'attribute'=>'date_cr',
                'value'=>function($data){
                    return $data->getDateCreate();
                },
            ]
        ],
    ]) ?>

</div>
