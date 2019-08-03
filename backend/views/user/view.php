<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'image',
                'format'=>'raw',
                'value'=>function($data){
                    return $data->getUserAvatar('_columns');
                },
            ],
            'username',
            'email',
            'auth_key',
            [
                'attribute'=>'type',
                'value'=>function($data){
                    return $data->getTypeDescription($data->type);
                },
            ],
            'birthday',
            'phone',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->getStatusDescription($data->status);
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
