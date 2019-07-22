<?php
use dosamigos\datepicker\DatePicker;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
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
        'filter'=>DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'birthday',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    ]
            ]),
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
        'filter' => User::getTip(),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'content'=>function($data){
            return $data->getStatusDescription();
        },
        'visible' => ($session['User[status]'] === null || $session['User[status]'] == 1) ? true : false,
        'filter'=>User::getStatus(),
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'visible' => ($session['User[created_at]'] === null || $session['User[created_at]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'filter'=>DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'created_at',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    ]
            ]),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'updated_at',
        'visible' => ($session['User[updated_at]'] === null || $session['User[updated_at]'] == 1) ? true : false,
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'filter'=>DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'updated_at',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    ]
            ]),
    ],

    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => '{view} {update}  {leadDelete}',
        'updateOptions'=>['role'=>'modal-remote','title'=>'Изменить', 'data-toggle'=>'tooltip'],
        'buttons'  => [

            'leadDelete' => function ($url, $model) {
                if($model->type == 3 || $model->type == 4){
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