<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'attribute'=>'date_cr',
        'value'=>function($data){
            return $data->getDateCreate();
        },
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => '{view} {leadDelete} {reply}',
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','View'), 'data-toggle'=>'tooltip'],
        'buttons'  => [
            'reply'=>function($url, $model){
                if($model->is_reply == 0){
                    $reply = \backend\models\Feedback::find()->where(['is_reply'=>$model->id])->one();
                     return Html::a('<span class="glyphicon glyphicon-saved"></span>', ['view-reply','id'=>$reply->id], ['role'=>'modal-remote','title'=>Yii::t('app','View'), 'data-toggle'=>'tooltip']);
                }
            },
            'view' => function($url, $model){
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view','id'=>$model->id], ['role'=>'modal-remote','title'=>Yii::t('app','View'), 'data-toggle'=>'tooltip']);
            },
            'leadDelete' => function ($url, $model) {
                if($model->is_reply == 0){
                    $url = Url::to(['/user/delete', 'id' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                          'role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')
                    ]);
                }
            },
        ]
    ],
];   