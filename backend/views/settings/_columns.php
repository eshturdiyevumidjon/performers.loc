<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
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
        'attribute'=>'key',
    ],
    [
        'contentOptions'=>[
            'class'=>'text-center',
       
        ],
        'headerOptions'=>['class'=>'text-center'],
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'value',
        'content'=>function($data){
            return ($data->name);
        },
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'vAlign'=>'middle',
        'template' => '{update}',
        'buttons'  => [
            'update' => function ($url, $model) {
               
                    $url = Url::to(['/settings/update', 'id' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,['role'=>'modal-remote','title'=>Yii::t('app','Edit'), 'data-toggle'=>'tooltip'] );
            },
        ]
    ],
];   