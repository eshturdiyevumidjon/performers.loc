<?php
use yii\helpers\Url;
$session = Yii::$app->session;
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'image',
        'width'=>'60px',
        'visible' => ($session['User[image]'] === null || $session['User[image]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'content'=>function($data){
            return $data->getUserAvatar('_columns');
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'username',
        'visible' => ($session['User[username]'] === null || $session['User[username]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
        'visible' => ($session['User[email]'] === null || $session['User[email]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
        'visible' => ($session['User[phone]'] === null || $session['User[phone]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'birthday',
        'visible' => ($session['User[birthday]'] === null || $session['User[birthday]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'value'=>function($data){
            return $data->getTypeDescription($data->type);
        },
        'visible' => ($session['User[type]'] === null || $session['User[type]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'content'=>function($data){
            return $data->getStatusDescription();
        },
        'visible' => ($session['User[status]'] === null || $session['User[status]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'visible' => ($session['User[created_at]'] === null || $session['User[created_at]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'updated_at',
        'visible' => ($session['User[updated_at]'] === null || $session['User[updated_at]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   