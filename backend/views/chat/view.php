<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Chat */
?>
<div class="chat-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'chat_id',
            'date_cr',
            'from',
            'to',
            'title',
            'file',
            'text',
            'reply',
            'deleted',
        ],
    ]) ?>

</div>
