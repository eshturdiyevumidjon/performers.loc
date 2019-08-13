<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Replies */
?>
<div class="replies-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
            'email:email',
            'message:ntext',
            'feedback_id',
            'date_cr',
        ],
    ]) ?>

</div>
